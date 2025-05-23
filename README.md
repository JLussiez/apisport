# Application de Classements Football

Cette application web permet de visualiser les classements des principales ligues de football européennes en utilisant l'API football-data.org.

## Fonctionnalités

- Affichage des classements de 7 ligues majeures européennes
- Mise en cache des données pour optimiser les performances
- Interface responsive et moderne
- Mise en évidence des positions importantes (champion, Ligue des Champions, relégation)

## Prérequis

- Python 3.8 ou supérieur
- pip (gestionnaire de paquets Python)

## Installation

1. Clonez ce dépôt :
```bash
git clone <votre-repo>
cd <votre-repo>
```

2. Créez un environnement virtuel et activez-le :
```bash
python -m venv venv
# Sur Windows :
venv\Scripts\activate
# Sur Unix ou MacOS :
source venv/bin/activate
```

3. Installez les dépendances :
```bash
pip install -r requirements.txt
```

4. Créez un fichier `.env` à la racine du projet avec votre clé API :
```
FOOTBALL_API_KEY=votre_clé_api
```

## Utilisation

1. Lancez l'application :
```bash
python app.py
```

2. Ouvrez votre navigateur et accédez à :
```
http://localhost:5000
```

## Structure du Projet

```
├── app.py              # Application principale Flask
├── config.py           # Configuration de l'application
├── requirements.txt    # Dépendances Python
├── templates/         # Templates Jinja2
│   ├── base.html     # Template de base
│   ├── index.html    # Page d'accueil
│   ├── standings.html # Page de classement
│   └── error.html    # Page d'erreur
└── .env              # Variables d'environnement (non versionné)
```

## Personnalisation

Vous pouvez modifier les paramètres suivants dans `config.py` :
- La liste des compétitions
- La saison en cours
- Les paramètres de cache

## Contribution

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou à soumettre une pull request.

## Licence

MIT 