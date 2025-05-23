from flask import Flask, render_template, request, jsonify
from flask_caching import Cache
import requests
from config import Config
import logging
from datetime import datetime
from typing import Optional, Dict, Any

app = Flask(__name__)
app.config.from_object(Config)
cache = Cache(app)

# Configuration du logging
logging.basicConfig(
    level=getattr(logging, Config.LOG_LEVEL),
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s'
)
logger = logging.getLogger(__name__)

class APIError(Exception):
    """Exception personnalisée pour les erreurs d'API"""
    pass

def get_standings(league_code: str) -> Optional[Dict[str, Any]]:
    """
    Récupère les classements pour une ligue donnée.
    
    Args:
        league_code: Code de la ligue (ex: 'FL1', 'PL', etc.)
        
    Returns:
        Dict contenant les données du classement ou None en cas d'erreur
    """
    cache_key = f'standings_{league_code}'
    cached_data = cache.get(cache_key)
    
    if cached_data:
        logger.debug(f"Données récupérées du cache pour {league_code}")
        return cached_data

    if league_code not in Config.COMPETITIONS:
        logger.warning(f"Code de ligue invalide: {league_code}")
        return None

    headers = {'X-Auth-Token': Config.API_KEY}
    url = Config.COMPETITIONS[league_code]['endpoint']

    try:
        logger.info(f"Récupération des données pour {league_code}")
        response = requests.get(url, headers=headers, timeout=10)
        response.raise_for_status()
        data = response.json()
        
        # Ajout de la date de mise à jour
        data['lastUpdated'] = datetime.now().isoformat()
        
        cache.set(cache_key, data)
        return data
    except requests.Timeout:
        logger.error(f"Timeout lors de la récupération des données pour {league_code}")
        raise APIError("Le serveur met trop de temps à répondre")
    except requests.RequestException as e:
        logger.error(f"Erreur lors de la récupération des données pour {league_code}: {str(e)}")
        raise APIError(f"Erreur lors de la récupération des données: {str(e)}")

@app.route('/')
def index():
    """Page d'accueil affichant la liste des ligues disponibles."""
    return render_template('index.html', competitions=Config.COMPETITIONS)

@app.route('/standings/<league_code>')
def standings(league_code):
    """Page affichant le classement d'une ligue spécifique."""
    try:
        data = get_standings(league_code)
        league_info = Config.COMPETITIONS.get(league_code)
        
        if not data or not league_info:
            logger.warning(f"Données non trouvées pour {league_code}")
            return render_template('error.html', 
                                message="Impossible de charger les données du classement.")
        
        return render_template('standings.html', 
                             data=data,
                             league_name=league_info['name'],
                             league_flag=league_info['flag'],
                             last_updated=datetime.fromisoformat(data['lastUpdated']))
    except APIError as e:
        logger.error(f"Erreur API pour {league_code}: {str(e)}")
        return render_template('error.html', message=str(e))
    except Exception as e:
        logger.exception(f"Erreur inattendue pour {league_code}")
        return render_template('error.html', 
                             message="Une erreur inattendue s'est produite")

@app.route('/api/standings/<league_code>')
def api_standings(league_code):
    """API endpoint pour récupérer les données en JSON."""
    try:
        data = get_standings(league_code)
        if not data:
            return jsonify({'error': 'Données non trouvées'}), 404
        return jsonify(data)
    except APIError as e:
        return jsonify({'error': str(e)}), 503
    except Exception as e:
        return jsonify({'error': 'Erreur serveur interne'}), 500

@app.errorhandler(404)
def page_not_found(e):
    return render_template('error.html', message="Page non trouvée"), 404

@app.errorhandler(500)
def server_error(e):
    return render_template('error.html', message="Erreur serveur interne"), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000) 