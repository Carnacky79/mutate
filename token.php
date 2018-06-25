<?php
    include_once ('includes/db.php');

    $link = new PDO("mysql:host=$host;dbname=$db", $username, $password);

    if(isset($_GET['token'])) {
        $token = $_GET['token'];
        $statement = $link->query("SELECT id FROM agenti WHERE token = '" . $token."'");

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row['id'] == NULL) die("Nessun utente trovato");
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

            <form id="inserimento_tickets" action="table_token.php" method="POST">
                <input type="hidden" id="id_agente" name="id_agente" value="<?php echo $row['id'] ?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Inserire Nome">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="Company">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="Guest">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary" id="inserisci">Inserisci</button>
            </form>

    </div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>