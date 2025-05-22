<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../menu.css">
    <meta name="description" content="Menu">
</head>

<body>
    <div class="header">
        <div class="header__logo">
            <a class="menu-title" href="IndexFootball.php"><strong>Sports Results</strong></a>
        </div>
        <nav class="navbar">
            <select class="navbar_football" id="football-select" onchange="redirectToPage(this)">
                <option value="">Classement Football</option>
                <option value="../Football/Bundesliga.php">Bundesliga</option>
                <option value="../Football/Eredivisie.php">Eredivisie</option>
                <option value="../Football/Liga.php">Liga</option>
                <option value="../Football/Ligue1.php">Ligue 1</option>
                <option value="../Football/PrimeiraLiga.php">Premeira Liga</option>
                <option value="../Football/PremierLeague.php">Premier League</option>
                <option value="../Football/SerieA.php">Serie A</option>
            </select>
        </nav>
    </div>

    <script>
        function redirectToPage(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            if (selectedOption.value !== "") {
                window.location.href = selectedOption.value;
            }
        }
    </script>
</body>

</html>