<?php
    include_once ('includes/db.php');

    $link = new PDO("mysql:host=$host;dbname=$db", $username, $password);

    function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[mt_rand(0, $max-1)];
        }

        return $token;
    }



    if($_GET['nome'] != '' ){
        $nome = $_GET['nome'];
        $email = $_GET['email'] != '' ? $_GET['email'] : NULL;
        $token = getToken(10);

        $statement = $link->prepare("INSERT INTO agenti (nome, email, token)
        VALUES(:nome, :email, :token)");
        $ritorno = $statement->execute(array(
            "nome" => "$nome",
            "email" => "$email",
            "token" => "$token"
        ));

        if($ritorno != 0){
            $result = 'Nominativo inserito correttamente';
        } else {
            $result = 'Errore nell\'inserimento dei dati';
        }

    }else{
        $result = 'Tutti i campi devono essere correttamente compilati';
    }
    echo $result;
