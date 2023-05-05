<?php
session_start();

function get_week_start_end($week, $year) {
    $dto = new DateTime();
    $dto->setISODate($year, $week);
    $start = $dto->format('Y-m-d');
    $dto->modify('+6 days');
    $end = $dto->format('Y-m-d');
    return [$start, $end];
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'get_slots') {
    $week = isset($_GET['week'])
    ? intval($_GET['week']) : intval(date('W'));
    $year = isset($_GET['year']) ? intval($_GET['year']) : intval(date('Y'));

    list($start_date, $end_date) = get_week_start_end($week, $year);

header('Content-Type: application/json');
echo json_encode($slots);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/common.css">
    <script src="js/common.js"></script>
</head>
<body>
</body>
</html>