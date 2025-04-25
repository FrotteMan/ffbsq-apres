<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'menu.php';
?>

<div class="container mt-4">
    <h2 class="text-center">Gestion des Paliers</h2>

    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

    $sql = $pdo->query("SELECT * FROM palier ORDER BY nbr_pts_minimum_palier ASC");
    $paliers = $sql->fetchAll();
    ?>

    <table class="table table-hover">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nom du Palier</th>
            <th>Points minimum</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($paliers as $palier) { ?>
            <tr>
                <td><?= htmlspecialchars($palier['id_palier']) ?></td>
                <td><?= htmlspecialchars($palier['nom_palier']) ?></td>
                <td><?= htmlspecialchars($palier['nbr_pts_minimum_palier']) ?></td>
                <td>
                    <a href="modifier_palier.php?id=<?= $palier['id_palier'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="supprimer_palier.php?id=<?= $palier['id_palier'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce palier ?')">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="ajouter_palier.php" class="btn btn-primary mt-3">➕ Ajouter un Palier</a>
</div>
