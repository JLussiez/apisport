<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classements Football</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .league-card {
            transition: transform 0.2s;
            cursor: pointer;
        }
        .league-card:hover {
            transform: translateY(-5px);
        }
        .league-flag {
            font-size: 2em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-light">
    <?php 
    include 'functions.php';
    $leagues = getAllLeagues();
    ?>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-futbol me-2"></i>Classements Football
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <?php foreach ($leagues as $code => $league): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card league-card" onclick="window.location.href='standings.php?league=<?php echo $code; ?>'">
                        <div class="card-body text-center">
                            <div class="league-flag"><?php echo $league['flag']; ?></div>
                            <h3 class="card-title"><?php echo $league['name']; ?></h3>
                            <button class="btn btn-primary mt-2">
                                <i class="fas fa-table-list me-2"></i>Voir le classement
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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