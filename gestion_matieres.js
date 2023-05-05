$(document).ready(function () {
    const matieresTable = $('#matieresTable tbody');
    const addMatiereForm = $('#addMatiereForm');

    function renderMatiere(matiere) {
        return `
            <tr>
                <td>${matiere.id}</td>
                <td>${matiere.nom}</td>
                <td style="background-color: ${matiere.couleur};"></td>
                <td>${matiere.couleur}</td>
                <td>
                    <button class="edit">Modifier</button>
                    <button class="delete">Supprimer</button>
                </td>
            </tr>
        `;
    }

    function loadMatieres() {
        loadList('matieres.php', matieresTable, renderMatiere);
    }

    loadMatieres();

    let editingRow = null;
    let editingId = null;

    matieresTable.on('click', '.edit', function () {
        const row = $(this).closest('tr');
        const id = row.find('td:first-child').text();
        const nom = row.find('td:nth-child(2)').text();
        const couleur = row.find('td:nth-child(4)').text();

        // Remplir le formulaire avec les données de la matière à modifier
        addMatiereForm.find('#nom').val(nom);
        addMatiereForm.find('#couleur').val(couleur);

        // Afficher le bouton "Enregistrer" et masquer le bouton "Ajouter"
        addMatiereForm.find('input[type="submit"]').hide();
        addMatiereForm.find('#saveEdit').show();

        // Sauvegarder les informations de la ligne en cours de modification
        editingRow = row;
        editingId = id;
    });

    addMatiereForm.find('#saveEdit').on('click', function () {
        const nom = addMatiereForm.find('#nom').val();
        const couleur = addMatiereForm.find('#couleur').val();

        updateItem('matieres.php', editingId, { nom, couleur }, function (updatedMatiere) {
            // Mettre à jour la ligne modifiée
            editingRow.find('td:nth-child(2)').text(updatedMatiere.nom);
            editingRow.find('td:nth-child(3)').css('background-color', updatedMatiere.couleur);
            editingRow.find('td:nth-child(4)').text(updatedMatiere.couleur);

            // Réinitialiser le formulaire et afficher le bouton "Ajouter"
            addMatiereForm.trigger('reset');
            addMatiereForm.find('input[type="submit"]').show();
            addMatiereForm.find('#saveEdit').hide();

            // Réinitialiser les variables d'édition
            editingRow = null;
            editingId = null;
        });
    });

    matieresTable.on('click', '.delete', function () {
        const id = $(this).data('id');
        const row = $(this).closest('tr');
        deleteItem('matieres.php', id, function () {
            row.remove();
        });
    });
});