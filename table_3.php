<?php
    include_once ('includes/db.php');

    $link = new PDO("mysql:host=$host;dbname=$db", $username, $password);


            $statement = $link->query("SELECT * FROM agenti");
                while($row = $statement->fetch(PDO::FETCH_ASSOC)){

                    $stm = $link->query("SELECT COUNT(*) as cnt FROM tickets WHERE id_agente = ".$row['id']);
                    $csv_cnt = $stm->fetch(PDO::FETCH_ASSOC);

                    echo '<tr>';
                    echo '<th scope="row">'.$row['id'].'</th>';
                    echo '<td style="text-align:center; "><span id="delete" id-user="'.$row['id']. '" onclick="del(this)" style="cursor:pointer;font-weight: 900;color: indianred;">X</span></td>';
                    echo '<td>'.$row['nome'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td><a href="'.(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/mutate/".'token.php?token='.$row['token'].'">'.(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/mutate/".'token.php?token='.$row['token'].'</a></td>';
                    if($csv_cnt['cnt'] > 0) {
                        echo '<td><a data-placement="right" data-toggle="tooltip" title="Scarica il CSV" href="csv.php?id=' . $row['id'] . '">Scarica il CSV</a></td>';
                    }else{
                        echo '<td>Ancora nessun record</td>';
                    }
                    echo '</tr>';
                }

