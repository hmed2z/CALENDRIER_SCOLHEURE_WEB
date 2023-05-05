<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des enseignants</title>
    <link rel="stylesheet" href="style-gestion.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="common.js"></script>
</head>
<body>
    <h1>Gestion des enseignants</h1>
    <div class="container">
        <form id="addEnseignantForm">
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
            <input type="submit" value="Ajouter">
        </form>
        <table id="enseignantsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les enseignants seront ajoutés ici dynamiquement -->
            </tbody>
        </table>
    </div>
    <script src="gestion_enseignants.js"></script>
</body>
</html>