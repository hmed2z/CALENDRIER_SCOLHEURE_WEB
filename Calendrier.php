<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScolHeure</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="style-calendrier.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="js/common.js"></script>
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <!-- FullCalendar JavaScript et dépendances -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>

<body>
    <h1>Calendrier</h1>
    <p id="weekInfo"></p>
    <div class="week-controls">
        <!-- <button onclick="changeWeek(-1)"><i class="fas fa-chevron-left fa-lg"></i></button>
        <button onclick="changeWeek(1)"><i class="fas fa-chevron-right fa-lg"></i></button> -->
        <button id="prevWeek" onclick="navigateWeek(-1)">&larr;</button>
        <button id="nextWeek" onclick="navigateWeek(1)">&rarr;</button>
    </div>
    
    <?php
    $role = $_SESSION['role'];
    $jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];

    $horaires = [];
    for ($i = 8; $i <= 18; $i++) {
        for ($j = 0; $j < 60; $j += 15) {
            $horaires[] = str_pad($i, 2, '0', STR_PAD_LEFT) . 'h' . str_pad($j, 2, '0', STR_PAD_LEFT);
        }
    }

    $slots = json_decode(file_get_contents('slots.json'), true);
    $matieres = json_decode(file_get_contents('matieres.json'), true);
    $enseignants = json_decode(file_get_contents('enseignants.json'), true);
    $salles = json_decode(file_get_contents('salles.json'), true);

    function getMatiereById($matieres, $id) {
        foreach ($matieres as $matiere) {
            if ($matiere["id"] == $id) {
                return $matiere;
            }
        }
        return null;
    }

    function getEnseignantById($enseignants, $id) {
        foreach ($enseignants as $enseignant) {
            if ($enseignant["id"] == $id) {
                return $enseignant;
            }
        }
        return null;
    }

    function getSalleById($salles, $id) {
        foreach ($salles as $salle) {
            if ($salle["id"] == $id) {
                return $salle;
            }
        }
        return null;
    }

    echo "<table>";
    echo "<tr>";
    echo "<th></th>";
    foreach ($jours as $jour) {
        echo "<th>{$jour}</th>";
    }
    echo "</tr>";

    foreach ($horaires as $horaire) {
        echo "<tr>";
        echo "<td>{$horaire}</td>";
    
        for ($i = 0; $i < count($jours); $i++) {
            $slotHtml = "";
            foreach ($slots as $slot) {
                if ($slot["horaire_debut"] === $horaire && $jours[$i] === date('l', strtotime($slot["date"]))) {
                    $matiere = getMatiereById($matieres, $slot["matiere"]);
                    $enseignant = getEnseignantById($enseignants, $slot["enseignant"]);
                    $salle = getSalleById($salles, $slot["salle"]);
    
                    $slotHtml = "<strong>{$slot["type"]}</strong><br>" .
                                "{$matiere["nom"]}<br>" .
                                "{$enseignant["prenom"]} {$enseignant["nom"]}<br>" .
                                "Salle: {$salle["nom"]}";
                    break;
                }
            }
            echo "<td>{$slotHtml}</td>";
        }
    
        echo "</tr>";
    }
    
    
echo "<td>{$slotHtml}</td>";


echo "</tr>";


echo "</table>";
?>

<script>
let currentWeek = <?php echo date('W'); ?>;

function changeWeek(delta) {
currentWeek += delta;
$("span[data-week]").text(currentWeek);

$.ajax({
url: "calendrier_ajax.php",
type: "GET",
data: {
   action: "get_slots",
   week: currentWeek
},
dataType: "json",
success: function (slots) {
   updateCalendar(slots);
},
error: function () {
   alert("Erreur lors du chargement des créneaux.");
}
});
}

function updateCalendar(slots) {
const table = $("table");
table.find("td:not(:first-child)").empty();

slots.forEach((slot) => {
const horaireDebut = slot.horaire_debut;
const horaireFin = slot.horaire_fin;
const slotDuration = calculateSlotDuration(horaireDebut, horaireFin);
const rowIndex = horaires.indexOf(horaireDebut);
const columnIndex = (new Date(slot.date).getDay() + 5) % 7; // Lundi = 1, Dimanche = 7

const slotElement = $("<div></div>")
   .addClass("slot")
   .css("background-color", slot.matiere.couleur)
   .attr("data-id", slot.id)
   .attr("rowspan", slotDuration / 15)
   .html(`
       <strong>${slot.type}</strong><br>
       ${slot.matiere.nom}<br>
       ${slot.enseignant.nom}<br>
       Salle: ${slot.salle.nom}<br>
       Groupe: ${slot.groupe}
   `);

table.find(`tr:eq(${rowIndex + 1}) td:eq(${columnIndex})`).append(slotElement);
});
}

function calculateSlotDuration(horaireDebut, horaireFin) {
const [hourDebut, minutesDebut] = horaireDebut.split("h").map(Number);
const [hourFin, minutesFin] = horaireFin.split("h").map(Number);
return (hourFin - hourDebut) * 60 + (minutesFin - minutesDebut);
}

function updateWeekInfo(date) {
  const startOfWeek = getStartOfWeek(date);
  const endOfWeek = new Date(startOfWeek);
  endOfWeek.setDate(endOfWeek.getDate() + 6);
  const weekInfo = document.getElementById('weekInfo');
  weekInfo.textContent = 'Semaine du ' + formatDate(startOfWeek) + ' au ' + formatDate(endOfWeek);
}

function getStartOfWeek(date) {
  const dayOfWeek = date.getDay();
  const startOfWeek = new Date(date);
  startOfWeek.setDate(startOfWeek.getDate() - dayOfWeek + (dayOfWeek === 0 ? -6 : 1));
  return startOfWeek;
}

function formatDate(date) {
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();
  return day + '/' + month + '/' + year;
}

const currentDate = new Date();

function navigateWeek(direction) {
  currentDate.setDate(currentDate.getDate() + direction * 7);
  updateWeekInfo(currentDate);
}

document.addEventListener('DOMContentLoaded', function() {
  updateWeekInfo(currentDate);
  function fetchCours() {
  return $.ajax({
    url: 'slots.json',
    dataType: 'json',
  });
}

function initCalendar(cours) {
  $('#calendar').fullCalendar({
    events: cours.map(function (cours) {
      return {
        title: cours.matiere + ' - ' + cours.enseignant,
        start: cours.date_debut,
        end: cours.date_fin,
      };
    }),
  });
}

fetchCours().done(initCalendar);

});

</script>
</body>
</html>