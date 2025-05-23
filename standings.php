<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement - Football</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .team-logo {
            height: 25px;
            width: 25px;
            object-fit: contain;
            margin-right: 10px;
        }
        .league-flag {
            font-size: 1.5em;
            margin-right: 10px;
        }
        .position-1 { background-color: rgba(0, 255, 0, 0.1); }
        .position-2, .position-3, .position-4 { background-color: rgba(0, 200, 0, 0.05); }
        .position-relegation { background-color: rgba(255, 0, 0, 0.05); }
    </style>
</head>
<body class="bg-light">
    <?php 
    include 'functions.php';
    
    $league = isset($_GET['league']) ? $_GET['league'] : 'FL1';
    $data = getStandings($league);
    $leagueName = getLeagueName($league);
    $leagueFlag = getLeagueFlag($league);
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-futbol me-2"></i>Classements Football
            </a>
            <h2 class="text-white mb-0">
                <span class="league-flag"><?php echo $leagueFlag; ?></span>
                <?php echo $leagueName; ?>
            </h2>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if ($data && isset($data['standings'][0]['table'])): ?>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Pos</th>
                                    <th>Club</th>
                                    <th class="text-center">MJ</th>
                                    <th class="text-center">V</th>
                                    <th class="text-center">N</th>
                                    <th class="text-center">D</th>
                                    <th class="text-center">BP</th>
                                    <th class="text-center">BC</th>
                                    <th class="text-center">DB</th>
                                    <th class="text-center">Pts</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $table = $data['standings'][0]['table'];
                                $total_teams = count($table);
                                foreach ($table as $team): 
                                    $position_class = '';
                                    if ($team['position'] === 1) {
                                        $position_class = 'position-1';
                                    } elseif ($team['position'] <= 4) {
                                        $position_class = 'position-2';
                                    } elseif ($team['position'] > ($total_teams - 3)) {
                                        $position_class = 'position-relegation';
                                    }
                                ?>
                                <tr class="<?php echo $position_class; ?>">
                                    <td class="text-center"><?php echo $team['position']; ?></td>
                                    <td>
                                        <img src="<?php echo $team['team']['crest']; ?>" alt="<?php echo $team['team']['name']; ?>" class="team-logo">
                                        <?php echo $team['team']['name']; ?>
                                    </td>
                                    <td class="text-center"><?php echo $team['playedGames']; ?></td>
                                    <td class="text-center"><?php echo $team['won']; ?></td>
                                    <td class="text-center"><?php echo $team['draw']; ?></td>
                                    <td class="text-center"><?php echo $team['lost']; ?></td>
                                    <td class="text-center"><?php echo $team['goalsFor']; ?></td>
                                    <td class="text-center"><?php echo $team['goalsAgainst']; ?></td>
                                    <td class="text-center"><?php echo $team['goalDifference']; ?></td>
                                    <td class="text-center"><strong><?php echo $team['points']; ?></strong></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Légende</h5>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="position-1 px-3 py-2 rounded">
                            <i class="fas fa-trophy text-warning me-2"></i>Champion
                        </div>
                        <div class="position-2 px-3 py-2 rounded">
                            <i class="fas fa-star text-primary me-2"></i>Ligue des Champions
                        </div>
                        <div class="position-relegation px-3 py-2 rounded">
                            <i class="fas fa-arrow-down text-danger me-2"></i>Relégation
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Impossible de charger les données du classement. Veuillez réessayer plus tard.
            </div>
        <?php endif; ?>

        <div class="mt-3 mb-5">
            <a href="index.php" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Retour aux ligues
            </a>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">Données fournies par <a href="https://www.football-data.org" class="text-white" target="_blank">football-data.org</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 