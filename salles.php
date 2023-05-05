<?php
header('Content-Type: application/json');

// Charger le fichier JSON
$salles = json_decode(file_get_contents('salles.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupérer toutes les salles
    echo json_encode($salles);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajouter une nouvelle salle
    $id = count($salles) + 1;
    $nom = $_POST['nom'];

    $newSalle = [
        'id' => $id,
        'nom' => $nom
    ];

    array_push($salles, $newSalle);

    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents('salles.json', json_encode($salles, JSON_PRETTY_PRINT));

    http_response_code(201);
    echo json_encode($newSalle);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'delete') {
    // Supprimer une salle
    $id = $_POST['id'];

    foreach ($salles as $index => $salle) {
        if ($salle['id'] == $id) {
            array_splice($salles, $index, 1);
            break;
        }
    }

    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents('salles.json', json_encode($salles, JSON_PRETTY_PRINT));

    http_response_code(200);
    echo json_encode(['message' => 'Salle supprimée']);
}
?>