<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des matières</title>
    <link rel="stylesheet" href="style-gestion.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="common.js"></script>
</head>
<body>
    <h1>Gestion des matières</h1>
    <div class="container">
        <form id="addMatiereForm">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
            <label for="couleur">Couleur:</label>
            <input type="color" id="couleur" name="couleur" required>
            <input type="submit" value="Ajouter">
            <button type="button" id="saveEdit" style="display: none;">Enregistrer</button>
        </form>
        <table id="matieresTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Code Couleur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les matières seront ajoutées ici dynamiquement -->
            </tbody>
        </table>
    </div>
    <script src="gestion_matieres.js"></script>
</body>
</html>