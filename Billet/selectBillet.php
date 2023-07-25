<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Billet</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <?php

            $dbName = "reservation";
            $userName = "root";
            $password = "";
            
            include_once('../baseDeDonnee.php');

            function getDataFromDb($dbName,$userName,$password){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //$sql = "SELECT * FROM films";
                    $sql = "SELECT b.billet_id,b.prix,u.nom AS nom,f.titre AS titre,s.date,b.numero_siege FROM billets b LEFT JOIN utilisateurs u ON b.utilisateur_id = u.utilisateur_id LEFT JOIN seances s ON b.seance_id = s.seance_id LEFT JOIN films f ON s.film_id = f.film_id";
                    $result = $conn->query($sql);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                   // $genre = $conn->query("SELECT ")

                    return $data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }

            $res = getDataFromDb($dbName,$userName,$password);
           // print_r($res);
        ?>

        <div class="container">
            <button type="submit" class="btn btn-success"><a href="billetForm.php">Ajouter</a></button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Utilisateur</th>
                        <th>Seance</th>
                        <th>Numero du Siège</th>
                        <th>Prix</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($res as $value) {
                            $url_update = "modifyBillet.php?id={$value['billet_id']}";
                            $url_delete = "deleteBillet.php?id={$value['billet_id']}";
                            echo("<tr>");
                            echo("<td>" . $value['billet_id'] . "</td>");
                            echo("<td>" . $value['nom'] . "</td>");
                            echo("<td>" . $value['titre'] . "</td>");
                            echo("<td>" . $value['date'] . "</td>");
                            echo("<td>" . $value['prix'] . "</td>");
                            echo("<td>" . $value['numero_siege'] . "</td>");
                            echo('<td><button class="btn btn-info"><a href=' . $url_update  . '>Changer</a></button></td>');
                            echo('<td><button type="submit" class="btn btn-danger"><a href=' . $url_delete  . '>Effacer</a></button></td>');
                            echo("</tr>");
                        }
                    ?>   
                </tbody>
            </table>
        </div>
    </body>
</html>