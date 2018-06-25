<!doctype html>
<html lang="it">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Mutate Tickets</title>

    <style>
        #tabella tr td, #tabella tr th {
            vertical-align: middle;
        }

        #tabella {
            border-bottom: 1px solid darkgrey;
        }

    </style>
</head>
<body>

<div class="container" style="padding-top:50px">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">

        </div>
        <div class="col-md-3"></div>
    </div>

</div>

    <div class="container" style="padding-top:50px">

            <form id="inserimento_nomi" >
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Inserire Nome">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>

                    <button type="submit" class="btn btn-primary" id="inserisci">Inserisci</button>
                </div>
            </form>

    </div>

<div class="container" style="padding-top:50px; padding-bottom:100px;">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Azioni</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Token</th>
            <th scope="col">CSV</th>
        </tr>
        </thead>
        <tbody id="tabella">

        </tbody>
    </table>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script>
    function inserimento(){
        var values = $('#inserimento_nomi').serializeArray();

        var data = JSON.stringify( values );

        $.ajax({
            url: "table_2.php",
            data: values
        }).done(function (data) {
            alert(data);
        })
            .fail(function (data) {
                alert(data);
            });

    }

    function popolamento(){
        $.ajax({
            url: "table_3.php",
        }).done(function (data) {
            $('#tabella').html('');
            $('#tabella').append(data);
        })
            .fail(function (data) {
                alert('Problema nel recuperare i dati');
            });
    }

    $("#inserisci").click(function() {
        inserimento();
        popolamento();
    });

    $.ready(

            popolamento()

    );

    function del(span) {
        var id = $(span).attr("id-user");
        var riga = $(span).closest('tr');

        var result = window.confirm('Sicuro di volerlo cancellare?');

        if (result == true) {
            $.ajax({
                url: "delete.php",
                data: 'id='+ id
            }).done(function (data) {
                riga.css("background-color","red");
                riga.fadeOut("normal", function() {
                    $(this).remove();
                });
            })
                .fail(function (data) {
                    alert('Problema nel recuperare i dati');
                });
        };
    };

</script>
</body>
</html>