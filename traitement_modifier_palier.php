<?php
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

$id = $_POST['id_palier'];
$nom = $_POST['nom_palier'];
$nbr_pts_minimum_palier = $_POST['nbr_pts_minimum_palier'];

// Mettre à jour le palier
$sql = $pdo->prepare("UPDATE palier SET nom_palier = ?, nbr_pts_minimum_palier = ? WHERE id_palier = ?");
$sql->execute([$nom, $nbr_pts_minimum_palier, $id]);

echo "Palier modifié avec succès ! <a href='gestion_palier.php'>Retour</a>";
