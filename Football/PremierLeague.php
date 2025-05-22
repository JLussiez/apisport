<?php
require_once ('../config.php');
require_once ('../menu.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premier League Page">
    <title>Résultats de la Premier League</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/europe.css">
</head>

<body>
    <h1>Premier League</h1>
    <div id="standings">
        <!-- Tableau des résultats de la Premier League -->
        <table border="1">
            <tr>
                <th>Club</th>
                <th></th>
                <th>MJ</th>
                <th>G</th>
                <th>N</th>
                <th>P</th>
                <th>BP</th>
                <th>BC</th>
                <th>DB</th>
                <th>Pts</th>
                <th>5 derniers</th>
            </tr>
            <!-- Lignes du tableau générées dynamiquement ici -->
        </table>
    </div>

    <script>
        // URL de l'API à interroger (utilisation du proxy.php)
        const apiUrl = '../FootProxy.php?url=<?php echo urlencode($PLapiUrl); ?>&key=<?php echo urlencode($apiKey); ?>';

        // Récupérer les données de l'API via le proxy PHP
        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`La requête a échoué avec le statut ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Générer le tableau HTML à partir des données de l'API
                let tableHtml = '';
                data.standings[0].table.forEach((team, index) => {
                    tableHtml += `<tr>`;
                    if (index < 4) {
                        // Les 4 premiers en LDC-Group
                        tableHtml += `<td class="LDC-Group">${team.position}</td>`;
                    } else if (index === 4) {
                        // Le 5ème en EL-Group
                        tableHtml += `<td class="EL-Group">${team.position}</td>`;
                    } else if (index >= data.standings[0].table.length - 3) {
                        // Les 3 derniers en Relegation
                        tableHtml += `<td class="Relegation">${team.position}</td>`;
                    } else {
                        tableHtml += `<td>${team.position}</td>`;
                    }
                    tableHtml += `<td class="name"><img src="${team.team.crest}" alt="${team.team.crest}" style="max-width: 40px; margin-right: 10px;">${team.team.name}</td>`;
                    tableHtml += `<td>${team.playedGames}</td>`;
                    tableHtml += `<td>${team.won}</td>`;
                    tableHtml += `<td>${team.draw}</td>`;
                    tableHtml += `<td>${team.lost}</td>`;
                    tableHtml += `<td>${team.goalsFor}</td>`;
                    tableHtml += `<td>${team.goalsAgainst}</td>`;
                    tableHtml += `<td>${team.goalDifference}</td>`;
                    tableHtml += `<td class="pts">${team.points}</td>`;
                    tableHtml += `<td>`;
                    // Générer les images pour les 5 derniers matchs
                    team.form.split('').forEach(result => {
                        switch (result) {
                            case 'W':
                                tableHtml += '<img src="../img/win.svg" alt="Win" style="width: 20px; margin-right: 5px;">';
                                break;
                            case 'D':
                                tableHtml += '<img src="../img/draw.svg" alt="Draw" style="width: 20px; margin-right: 5px;">';
                                break;
                            case 'L':
                                tableHtml += '<img src="../img/loose.svg" alt="Loose" style="width: 20px; margin-right: 5px;">';
                                break;
                        }
                    });
                    tableHtml += `</td>`;
                    tableHtml += `</tr>`;
                });
                document.getElementById('standings').querySelector('table').innerHTML += tableHtml;
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des données:', error);
            });
    </script>
    <div class="legende">
        <div>
            <div class="L-LDC-Group" style="display: inline-block;">‎</div>
            <span style="display: inline-block; vertical-align: top;">LDC-Group</span>
        </div>
        <div>
            <div class="L-EL-Group" style="display: inline-block;">‎</div>
            <span style="display: inline-block; vertical-align: top;">EL-Group</span>
        </div>
        <div>
            <div class="L-Relegation" style="display: inline-block;">‎</div>
            <span style="display: inline-block; vertical-align: top;">Relegation</span>
        </div>
    </div>
</body>

</html>