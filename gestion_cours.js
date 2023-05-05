$(document).ready(function () {
    const coursTable = $('#coursTable tbody');
    const addCoursForm = $('#addCoursForm');

    function renderCours(cours) {
        return `
          <tr>
            <td>${cours.id}</td>
            <td>${cours.matiere}</td>
            <td>${cours.enseignant}</td>
            <td>${cours.salle}</td>
            <td>${cours.groupe}</td>
            <td>${cours.date_debut}</td>
            <td>${cours.date_fin}</td>
            <td>
              <button class="edit">Modifier</button>
              <button class="delete">Supprimer</button>
            </td>
          </tr>
        `;
      }
      
      function loadCours() {
        fetchCours().done(function (cours) {
          const coursTable = $('#coursTable tbody');
          coursTable.empty();
          cours.forEach(function (cours) {
            coursTable.append(renderCours(cours));
          });
        });
      }
      
      loadCours();      

    coursTable.on('click', '.delete', function () {
        const row = $(this).closest('tr');
        const id = row.find('td:first-child').text();
        deleteItem('cours.json', { id }, function () {
            row.remove();
            });
            });
            coursTable.on('click', '.edit', function () {
                const row = $(this).closest('tr');
                const id = row.find('td:first-child').text();
                const matiere = row.find('td:nth-child(2)').text();
                const enseignant = row.find('td:nth-child(3)').text();
                const salle = row.find('td:nth-child(4)').text();
                const groupe = row.find('td:nth-child(5)').text();
                const date_debut = row.find('td:nth-child(6)').text();
                const date_fin = row.find('td:nth-child(7)').text();
            
                addCoursForm.find('input[name=matiere]').val(matiere);
                addCoursForm.find('input[name=enseignant]').val(enseignant);
                addCoursForm.find('input[name=salle]').val(salle);
                addCoursForm.find('input[name=groupe]').val(groupe);
                addCoursForm.find('input[name=date_debut]').val(date_debut);
                addCoursForm.find('input[name=date_fin]').val(date_fin);
                addCoursForm.data('coursId', id);
            });
            
            addCoursForm.submit(function (event) {
                event.preventDefault();
                const form = $(this);
                const data = form.serializeArray();
                const id = form.data('coursId');
                if (id) {
                    data.push({ name: 'id', value: id });
                }
                saveItem('cours.json', data, function (response) {
                    if (id) {
                        const row = coursTable.find(`tr:has(td:first-child:contains(${id}))`);
                        row.replaceWith(renderCours(response));
                    } else {
                        coursTable.append(renderCours(response));
                    }
                    form[0].reset();
                    form.removeData('coursId');
                });
            });
        });            