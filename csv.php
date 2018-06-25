<?php
// output headers so that the file is downloaded rather than displayed
$id_agente = $_GET['id'];

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=csv_by_id_'.$id_agente.'.csv');

$id_agente = $_GET['id'];
include_once ('includes/db.php');

$link = new PDO("mysql:host=$host;dbname=$db", $username, $password);

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Name', 'Company', 'Email', 'Quantity', 'Type'));

// fetch the data
$statement = $link->query("SELECT * FROM tickets WHERE id_agente = ".$id_agente);
while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, array($row['name'], $row['company'], $row['email'], $row['quantity'], $row['type'] ));
}
?>