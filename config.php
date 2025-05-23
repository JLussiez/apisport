<?php
// Configuration de l'API Football-Data
define('API_KEY', '008a92b3206d4d95bef815a2c46d9420');
define('API_BASE_URL', 'https://api.football-data.org/v4/competitions/');

// Configuration des URLs des compétitions
define('COMPETITIONS', [
    'FL1' => [
        'name' => 'Ligue 1',
        'endpoint' => API_BASE_URL . 'FL1/standings',
        'flag' => '🇫🇷'
    ],
    'PL' => [
        'name' => 'Premier League',
        'endpoint' => API_BASE_URL . 'PL/standings',
        'flag' => '🇬🇧'
    ],
    'SA' => [
        'name' => 'Serie A',
        'endpoint' => API_BASE_URL . 'SA/standings',
        'flag' => '🇮🇹'
    ],
    'PD' => [
        'name' => 'La Liga',
        'endpoint' => API_BASE_URL . 'PD/standings',
        'flag' => '🇪🇸'
    ],
    'BL1' => [
        'name' => 'Bundesliga',
        'endpoint' => API_BASE_URL . 'BL1/standings',
        'flag' => '🇩🇪'
    ],
    'DED' => [
        'name' => 'Eredivisie',
        'endpoint' => API_BASE_URL . 'DED/standings',
        'flag' => '🇳🇱'
    ],
    'PPL' => [
        'name' => 'Primeira Liga',
        'endpoint' => API_BASE_URL . 'PPL/standings',
        'flag' => '🇵🇹'
    ]
]);

// Configuration de la saison
define('CURRENT_SEASON', '2025');

// Configuration des options de l'API
define('API_OPTIONS', [
    'http' => [
        'method' => 'GET',
        'header' => 'X-Auth-Token: ' . API_KEY
    ]
]);
?> 