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
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }

    if(isset($_POST['nome'])){
        $nome = $_POST['nome'];
        $email = isset($_POST['email']) ? $_POST['email'] : NULL;
        $token = getToken(10);

        $statement = $link->prepare("INSERT INTO agenti (nome, email, token)
    VALUES(:nome, :email, :token)");
        $ritorno = $statement->execute(array(
            "nome" => "$nome",
            "email" => "$email",
            "token" => "$token"
        ));

        if($ritorno != 0){
            $result = 'Nominativo inserito correttamente<br><a href="index.php">Torna Indietro</a>';
        } else {
            $result = 'Errore nell\'inserimento dei dati<br><a href="index.php">Torna Indietro</a>';
        }
    }else{
        $result = 'Vista degli agenti<br><a href="index.php">Torna All\'inserimento</a>';
    }
?>
<!doctype html>
<html lang="it">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Mutate Tickets</title>
</head>
<body>

<div class="container" style="padding-top:50px">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <?php echo $result; ?>
        </div>
        <div class="col-md-3"></div>
    </div>

</div>

    <div class="container" style="padding-top:50px">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Token</th>
                <th scope="col">CSV</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $statement = $link->query("SELECT * FROM agenti");
            $count = 1;
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){

                    $stm = $link->query("SELECT COUNT(*) as cnt FROM tickets WHERE id_agente = ".$row['id']);
                    $csv_cnt = $stm->fetch(PDO::FETCH_ASSOC);

                    echo '<tr>';
                    echo '<th scope="row">'.$count++.'</th>';
                    echo '<td>'.$row['nome'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>www.mutateevents.com/mutate/token.php?token='.$row['token'].'</td>';
                    if($csv_cnt['cnt'] > 0) {
                        echo '<td><a href="csv.php?id=' . $row['id'] . '">Scarica il CSV</a></td>';
                    }else{
                        echo '<td>Ancora nessun record</td>';
                    }
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>