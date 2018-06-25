<?php
    include_once ('includes/db.php');

    $link = new PDO("mysql:host=$host;dbname=$db", $username, $password);

    $id = $_GET['id'];

    $statement = $link->prepare("DELETE FROM agenti WHERE id = :id;");

    $ritorno = $statement->execute(array(
        "id" => "$id",
    ));

    $statement_2 = $link->prepare("DELETE FROM tickets WHERE id_agente = :id;");

    $ritorno = $statement_2->execute(array(
        "id" => "$id",
    ));


