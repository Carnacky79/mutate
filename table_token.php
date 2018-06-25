<?php
    include_once ('includes/db.php');

    $link = new PDO("mysql:host=$host;dbname=$db", $username, $password);

    if(isset($_POST['nome'])){
        $nome = $_POST['nome'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $qty = $_POST['quantity'];
        $type = $_POST['type'];
        $id_agente = $_POST['id_agente'];

        $stm = $link->query("SELECT token FROM agenti WHERE id = ".$id_agente);

        $rw = $stm->fetch(PDO::FETCH_ASSOC);

        $statement = $link->prepare("INSERT INTO tickets (name, company, email, quantity, type, id_agente)
    VALUES(:name, :company, :email, :quantity, :type, :id_agente)");
        $ritorno = $statement->execute(array(
            "name" => "$nome",
            "company" => "$company",
            "email" => "$email",
            "quantity" => "$qty",
            "type" => "$type",
            "id_agente" => "$id_agente"
        ));

        if($ritorno != 0){
            $result = 'Nominativo inserito correttamente<br><a href="token.php?token='.$rw['token'].'">Torna Indietro</a>';
        } else {
            $result = 'Errore nell\'inserimento dei dati<br>Controllare che tutti i campi siano corretti<br><a href="token.php?token='.$rw['token'].'">Torna Indietro</a>';
        }
    }else{
        $result = 'Vista degli Ospiti<br><a href="token.php?token='.$rw['token'].'">Torna All\'inserimento</a>';
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
                <th scope="col">Company</th>
                <th scope="col">Email</th>
                <th scope="col">Quantity</th>
                <th scope="col">Type</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $statement = $link->query("SELECT * FROM tickets WHERE id_agente = ".$id_agente);
            $count = 1;
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<th scope="row">'.$count++.'</th>';
                    echo '<td>'.$row['name'].'</td>';
                    echo '<td>'.$row['company'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>'.$row['quantity'].'</td>';
                    echo '<td>'.$row['type'].'</td>';
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