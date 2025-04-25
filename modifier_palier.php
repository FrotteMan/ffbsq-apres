<?php
include 'menu.php';

	$id = $_GET['id']; // Récupération de l'ID passé en URL
    $palier = null;

    // Récupérer les informations de la compétition via l'API
    if (isset($id)) {
        $json = file_get_contents('http://localhost/mon-api/api-modifier-palier.php?id=' . $id);
        $palier = json_decode($json, true);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire POST
        $id_palier = $_POST['id_palier'];
        $nom_palier = $_POST['nom_palier'];
        $nbr_pts_minimum_palier = $_POST['nbr_pts_minimum_palier'];

        // Préparer les données pour l'API
        $data = [
            'id_palier' => $id_palier,
            'nom_palier' => $nom_palier,
            'nbr_pts_minimum_palier' => $nbr_pts_minimum_palier
        ];

        // Créer un contexte de stream pour envoyer la requête POST
        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data)
            ]
        ]);

        // Envoyer les données à l'API pour mettre à jour la compétition
        file_get_contents('http://localhost/mon-api/api-modifier-palier.php', false, $context);

        // Rediriger après la modification
        header('Location: gestion_palier.php'); // Redirige vers la page de gestion des compétitions
        exit;
    }
?>

<div class="container mt-4">
    <h2 class="text-center">Modifier le Palier</h2>
    <form method="POST" action="modifier_palier.php?id=<?= $id ?>" class="needs-validation" novalidate>
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
	