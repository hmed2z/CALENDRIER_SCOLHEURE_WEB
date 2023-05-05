<?php
/*
header('Content-Type: application/json');

// Charger le fichier JSON
$matieres = json_decode(file_get_contents('matieres.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupérer toutes les matières
    echo json_encode($matieres);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajouter une nouvelle matière
    $id = count($matieres) + 1;
    $nom = $_POST['nom'];
    $couleur = $_POST['couleur'];

    $newMatiere = [
        'id' => $id,
        'nom' => $nom,
        'couleur' => $couleur
    ];

    array_push($matieres, $newMatiere);

    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents('matieres.json', json_encode($matieres, JSON_PRETTY_PRINT));

    http_response_code(201);
    echo json_encode($newMatiere);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'delete') {
    // Supprimer une matière
    $id = $_POST['id'];

    foreach ($matieres as $index => $matiere) {
        if ($matiere['id'] == $id) {
            array_splice($matieres, $index, 1);
            break;
        }
    }

    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents('matieres.json', json_encode($matieres, JSON_PRETTY_PRINT));

    http_response_code(200);
    echo json_encode(['message' => 'Matière supprimée']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Mettre à jour une matière
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_GET['id'];
    $nom = $_PUT['nom'];
    $couleur = $_PUT['couleur'];

    foreach ($matieres as $index => $matiere) {
        if ($matiere['id'] == $id) {
            $matieres[$index]['nom'] = $nom;
            $matieres[$index]['couleur'] = $couleur;
            break;
        }
    }

    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents('matieres.json', json_encode($matieres, JSON_PRETTY_PRINT));

    http_response_code(200);
    echo json_encode(['id' => $id, 'nom' => $nom, 'couleur' => $couleur]);
}
*/
header('Content-Type: application/json');

// Charger le fichier JSON
$matieres = json_decode(file_get_contents('matieres.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //Récupérer toutes les matières
echo json_encode($matieres);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Ajouter une nouvelle matière
$id = count($matieres) + 1;
$nom = $_POST['nom'];
$couleur = $_POST['couleur'];
$newMatiere = [
    'id' => $id,
    'nom' => $nom,
    'couleur' => $couleur
];

array_push($matieres, $newMatiere);

// Sauvegarder les modifications dans le fichier JSON
file_put_contents('matieres.json', json_encode($matieres, JSON_PRETTY_PRINT));

http_response_code(201);
echo json_encode($newMatiere);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'delete') {
    // Supprimer une matière
    $id = $_POST['id'];
    foreach ($matieres as $index => $matiere) {
        if ($matiere['id'] == $id) {
            array_splice($matieres, $index, 1);
            break;
        }
    }
    
    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents('matieres.json', json_encode($matieres, JSON_PRETTY_PRINT));
    
    http_response_code(200);
    echo json_encode(['message' => 'Matière supprimée']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Mettre à jour une matière
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_GET['id'];
    $nom = $_PUT['nom'];
    $couleur = $_PUT['couleur'];
    foreach ($matieres as $index => $matiere) {
        if ($matiere['id'] == $id) {
            $matieres[$index]['nom'] = $nom;
            $matieres[$index]['couleur'] = $couleur;
            break;
        }
    }
    
    // Sauvegarder les modifications dans le fichier JSON
    file_put_contents('matieres.json', json_encode($matieres, JSON_PRETTY_PRINT));
    
    http_response_code(200);
    echo json_encode(['id' => $id, 'nom' => $nom, 'couleur' => $couleur]);
}    
?>