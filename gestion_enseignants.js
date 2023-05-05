$(document).ready(function () {
    const enseignantsTable = $('#enseignantsTable tbody');
    const addEnseignantForm = $('#addEnseignantForm');

    function renderEnseignant(enseignant) {
        return `
            <tr>
                <td>${enseignant.id}</td>
                <td>${enseignant.nom}</td>
                <td>${enseignant.prenom}</td>
                <td>
                    <button class="edit">Modifier</button>
                    <button class="delete">Supprimer</button>
                </td>
            </tr>
        `;
    }

    function loadEnseignants() {
        loadList('enseignants.json', enseignantsTable, renderEnseignant);
    }

    loadEnseignants();

    enseignantsTable.on('click', '.delete', function () {
        const row = $(this).closest('tr');
        const id = row.find('td:first-child').text();
        deleteItem('enseignants.json', id, function () {
            row.remove();
        });
    });

    addEnseignantForm.submit(function (event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        $.ajax({
        url: 'enseignants.json',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
        loadEnseignants();
        addEnseignantForm.trigger('reset');
        },
        error: function (jqXHR, textStatus, errorThrown) {
        console.log('Raw server response:', jqXHR.responseText);
        console.error('Error data:', jqXHR, textStatus, errorThrown);
        },
        });
        });
        });