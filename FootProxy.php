<?php

require_once ('config.php');

// Vérifie si les paramètres d'URL sont définis
if (isset($_GET['url']) && isset($_GET['key'])) {
    // Récupère les paramètres d'URL
    $apiUrl = $_GET['url'];
    $apiKey = $_GET['key'];

    // Configuration de la requête
    $options = array(
        'http' => array(
            'header' => "X-Auth-Token: $apiKey",
            'method' => 'GET'
        )
    );

    // Créer un contexte pour la requête
    $context = stream_context_create($options);

    // Faire la requête à l'API
    $response = file_get_contents($apiUrl, false, $context);

    // Vérifier si la réponse est réussie
    if ($response === false) {
        // Gérer les erreurs de requête
        http_response_code(500);
        echo json_encode(array('error' => 'Une erreur s\'est produite lors de la récupération des données'));
    } else {
        // Envoyer la réponse JSON
        echo $response;
    }
} else {
    // Si les paramètres d'URL ne sont pas définis, renvoyer une erreur
    http_response_code(400);
    echo json_encode(array('error' => 'Paramètres d\'URL manquants'));
}