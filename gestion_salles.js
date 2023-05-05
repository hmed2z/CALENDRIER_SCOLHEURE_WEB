$(document).ready(function () {
    const sallesTable = $('#sallesTable tbody');
    const addSalleForm = $('#addSalleForm');

    function renderSalle(salle) {
        return `
            <tr>
                <td>${salle.id}</td>
                <td>${salle.nom}</td>
                <td>
                    <button class="edit">Modifier</button>
                    <button class="delete">Supprimer</button>
                </td>
            </tr>
        `;
    }

    function loadSalles() {
        loadList('salles.php', sallesTable, renderSalle);
    }

    loadSalles();

    sallesTable.on('click', '.delete', function () {
        const row = $(this).closest('tr');
        const id = row.find('td:first-child').text();
        deleteItem('salles.php', id, function () {
            row.remove();
        });
    });
    
    addSalleForm.submit(function (event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        $.ajax({
            url: 'salles.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                loadSalles();
                addSalleForm.trigger('reset');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Raw server response:', jqXHR.responseText);
                console.error('Error data:', jqXHR, textStatus, errorThrown);
            },
        });
    });
});