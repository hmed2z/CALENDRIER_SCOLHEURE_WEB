<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Déclaration de l'encodage des caractères -->
    <meta charset="UTF-8">
    <!-- Déclaration de la taille de la fenêtre et du niveau de zoom initial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>Accueil responsable</title>
    <link rel="stylesheet" href="accueil_responsable.css">
    <!-- Lien vers la bibliothèque jQuery pour la gestion des événements et des effets -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Lien vers le fichier JavaScript commun pour la logique partagée -->
    <script src="common.js"></script>
</head>
<body>
    <!-- Titre principal de la page -->
    <h1>Bienvenue Responsable</h1>
    <!-- Navigation principale de la page -->
    <nav>
        <ul>
            <!-- Lien vers la page du calendrier -->
            <li><a href="Calendrier.php?action=afficher_calendrier">Calendrier</a></li>
            <!-- Lien vers la page de gestion des salles -->
            <li><a href="gestion_salles.php">Gestion des salles</a></li>
            <!-- Lien vers la page de gestion des matières -->
            <li><a href="gestion_matieres.php">Gestion des matières</a></li>
            <!-- Lien vers la page de gestion des enseignants -->
            <li><a href="gestion_enseignants.php">Gestion des enseignants</a></li>
            <!-- Lien vers la page de gestion des cours -->
            <li><a href="gestion_cours.php">Gestion des cours</a></li>
        </ul>
    </nav>
</body>
</html>