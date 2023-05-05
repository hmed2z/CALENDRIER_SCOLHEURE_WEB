<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('log_errors', 1);
ini_set('error_log', 'php-error.log');

header('Content-Type: application/json');

$usersFile = 'utilisateurs.json';

if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = json_decode(file_get_contents($usersFile), true);
    $userFound = false;
    $foundUser = null;

    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $userFound = true;
            $foundUser = $user;
            break;
        }
    }

    if ($userFound) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $foundUser['role'];

        if ($foundUser['role'] == 'responsable') {
            echo json_encode(['success' => true, 'redirect' => 'accueil_responsable.php']);
        } else {
            echo json_encode(['success' => true, 'redirect' => 'Calendrier.php']);
        }
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'error' => "Erreur : email ou mot de passe incorrect."
        ]);
        exit();
    }

} elseif (isset($_POST['action']) && $_POST['action'] === 'signup') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['experience'];

    $newUser = [
        'email' => $email,
        'password' => $password,
        'role' => $role
    ];

    $users = json_decode(file_get_contents($usersFile), true);

    // Vérification si l'utilisateur existe déjà
    $userExists = false;
    foreach ($users as $existingUser) {
        if ($existingUser['email'] === $email) {
            $userExists = true;
            break;
        }
    }

    if ($userExists) {
        echo json_encode(['success' => false, 'error' => "Erreur : un utilisateur avec cet email existe déjà."]);
        exit();
    }

    // Ajout du nouvel utilisateur
    $users[] = $newUser;
    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));

    // Stockage des informations de l'utilisateur dans la session et redirection vers Calendrier.php
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;
    echo json_encode(['success' => true]);
} else {
    echo json_encode([
        'success' => false,
        'error' => "Aucune action n'a été effectuée."
    ]);
    exit();
}
?>