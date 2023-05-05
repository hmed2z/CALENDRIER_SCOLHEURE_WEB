<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des cours</title>
    <link rel="stylesheet" href="common.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Gestion des cours</h1>
    <table id="coursTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Matière</th>
                <th>Enseignant</th>
                <th>Salle</th>
                <th>Groupe</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <form id="addCoursForm">
        <h2>Ajouter un cours</h2>
        <label for="matiere">Matière :</label>
        <input type="text" name="matiere" required>
        <label for="enseignant">Enseignant :</label>
        <input type="text" name="enseignant" required>
        <label for="salle">Salle :</label>
        <input type="text" name="salle" required>
        <label for="groupe">Groupe :</label>
        <input type="text" name="groupe" required>
        <label for="date_debut">Date début :</label>
        <input type="datetime-local" name="date_debut" required>
        <label for="date_fin">Date fin :</label>
        <input type="datetime-local" name="date_fin" required>
        <button type="submit">Ajouter le cours</button>
    </form>
    <script src="common.js"></script>
    <script src="gestion_cours.js"></script>
</body>
</html>