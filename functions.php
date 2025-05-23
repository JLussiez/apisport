<?php
require_once 'config.php';

function getStandings($league) {
    if (!array_key_exists($league, COMPETITIONS)) {
        return null;
    }

    $apiUrl = COMPETITIONS[$league]['endpoint'] . '?season=' . CURRENT_SEASON;
    $context = stream_context_create(API_OPTIONS);
    
    try {
        $response = file_get_contents($apiUrl, false, $context);
        return json_decode($response, true);
    } catch (Exception $e) {
        error_log("Erreur lors de la récupération des données pour la ligue $league: " . $e->getMessage());
        return null;
    }
}

function getLeagueName($code) {
    return array_key_exists($code, COMPETITIONS) ? COMPETITIONS[$code]['name'] : $code;
}

function getLeagueFlag($code) {
    return array_key_exists($code, COMPETITIONS) ? COMPETITIONS[$code]['flag'] : '';
}

function getAllLeagues() {
    $leagues = [];
    foreach (COMPETITIONS as $code => $data) {
        $leagues[$code] = [
            'name' => $data['name'],
            'flag' => $data['flag']
        ];
    }
    return $leagues;
}
?> 