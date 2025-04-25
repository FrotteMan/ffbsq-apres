<?php
include 'menu.php';

$saison = 0;

// Récupération des données depuis l’API
$json = file_get_contents("http://localhost/mon-api/api-saison.php?saison=$saison");
$clubs = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement des Clubs - Saison <?= $saison ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">🏆 Classement des Clubs – Saison <?= $saison ?></h2>

    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
            <tr><th>Position</th><th>Club</th><th>Points</th></tr>
        </thead>
        <tbody>
            <?php
            if (is_array($clubs)) {
                $position = 1;
                foreach ($clubs as $club) {
                    echo "<tr>
                            <td>{$position}</td>
                            <td>" . htmlspecialchars($club['nom_club']) . "</td>
                            <td>" . htmlspecialchars($club['total_points']) . "</td>
                        </tr>";
                    $position++;
                }
            } else {
                echo "<tr><td colspan='3' class='text-center text-danger'>Aucune donnée disponible.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-primary">⬅ Retour Accueil</a>
</div>
</body>
</html>
