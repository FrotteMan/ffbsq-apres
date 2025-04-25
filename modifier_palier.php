<?php
include 'menu.php';
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', 'root');

// Vérification de l'ID
if (!isset($_GET['id'])) {
    die("ID du palier manquant.");
}

$id = $_GET['id'];
$sql = $pdo->prepare("SELECT * FROM palier WHERE id_palier = ?");
$sql->execute([$id]);
$palier = $sql->fetch();

if (!$palier) {
    die("Palier non trouvé.");
}
?>

<div class="container mt-4">
    <h2 class="text-center">Modifier le Palier</h2>
    <form method="POST" action="traitement_modifier_palier.php" class="needs-validation" novalidate>
        <input type="hidden" name="id_palier" value="<?= $palier['id_palier'] ?>">

        <div class="mb-3">
            <label class="form-label">Nom du Palier</label>
            <input type="text" name="nom_palier" class="form-control" value="<?= htmlspecialchars($palier['nom_palier']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre de Points Minimum</label>
            <input type="number" name="nbr_pts_minimum_palier" class="form-control" value="<?= htmlspecialchars($palier['nbr_pts_minimum_palier']) ?>" required>
        </div>

        <button type="submit" class="btn btn-warning w-100">Modifier</button>
    </form>
</div>
	