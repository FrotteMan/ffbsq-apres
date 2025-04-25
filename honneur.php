<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Honneur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Honneur</h2>
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
        <tr><th>Position</th><th>Nom</th><th>Prénom</th><th>Points</th></tr>
        </thead>
        <tbody>
        <?php
		$json = file_get_contents('http://localhost/mon-api/api-honneur.php');
		$joueurs = json_decode($json, true);
		
        $position = 1;
        foreach ($joueurs as $joueur): ?>
            <tr>
                <td><?= $position++ ?></td>
                <td><?= htmlspecialchars($joueur['nom_joueur']) ?></td>
                <td><?= htmlspecialchars($joueur['prenom_joueur']) ?></td>
                <td><?= htmlspecialchars($joueur['points_joueur']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-primary">⬅ Retour Accueil</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
