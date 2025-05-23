from typing import Dict, Any
import os
from dotenv import load_dotenv

load_dotenv()

class Config:
    # Configuration de l'API Football-Data
    API_KEY = os.getenv('FOOTBALL_API_KEY')
    if not API_KEY:
        raise ValueError("La clé API est requise. Définissez FOOTBALL_API_KEY dans le fichier .env")
    
    API_BASE_URL = 'https://api.football-data.org/v4/competitions/'

    # Configuration des compétitions
    COMPETITIONS: Dict[str, Dict[str, str]] = {
        'FL1': {
            'name': 'Ligue 1',
            'endpoint': f'{API_BASE_URL}FL1/standings',
            'flag': '🇫🇷',
            'logo': 'https://crests.football-data.org/FL1.png'
        },
        'PL': {
            'name': 'Premier League',
            'endpoint': f'{API_BASE_URL}PL/standings',
            'flag': '🇬🇧',
            'logo': 'https://crests.football-data.org/PL.png'
        },
        'SA': {
            'name': 'Serie A',
            'endpoint': f'{API_BASE_URL}SA/standings',
            'flag': '🇮🇹',
            'logo': 'https://crests.football-data.org/SA.png'
        },
        'PD': {
            'name': 'La Liga',
            'endpoint': f'{API_BASE_URL}PD/standings',
            'flag': '🇪🇸',
            'logo': 'https://crests.football-data.org/PD.png'
        },
        'BL1': {
            'name': 'Bundesliga',
            'endpoint': f'{API_BASE_URL}BL1/standings',
            'flag': '🇩🇪',
            'logo': 'https://crests.football-data.org/BL1.png'
        },
        'DED': {
            'name': 'Eredivisie',
            'endpoint': f'{API_BASE_URL}DED/standings',
            'flag': '🇳🇱',
            'logo': 'https://crests.football-data.org/DED.png'
        },
        'PPL': {
            'name': 'Primeira Liga',
            'endpoint': f'{API_BASE_URL}PPL/standings',
            'flag': '🇵🇹',
            'logo': 'https://crests.football-data.org/PPL.png'
        }
    }

    # Configuration du cache
    CACHE_CONFIG = {
        'CACHE_TYPE': 'SimpleCache',
        'CACHE_DEFAULT_TIMEOUT': 300  # 5 minutes
    }

    # Configuration de l'application Flask
    DEBUG = os.getenv('FLASK_DEBUG', 'False').lower() == 'true'
    SECRET_KEY = os.getenv('FLASK_SECRET_KEY', os.urandom(24))
    
    # Configuration du logging
    LOG_LEVEL = os.getenv('LOG_LEVEL', 'INFO') 