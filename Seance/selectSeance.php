<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Seances</title>
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
                    $sql = "SELECT s.seance_id,s.date,s.heure,s.prix,s.place_restantes,f.titre AS film,sa.nom AS salle FROM seances s LEFT JOIN films f ON s.film_id = f.film_id LEFT JOIN salles sa ON s.salle_id = sa.salle_id";
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
            <button type="submit" class="btn btn-success"><a href="seanceForm.php">Ajouter</a></button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Film</th>
                        <th>Salle</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Prix</th>
                        <th>Place disponible</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($res as $value) {
                            $url_update = "modifySeance.php?id={$value['seance_id']}";
                            $url_delete = "deleteSeance.php?id={$value['seance_id']}";
                            echo("<tr>");
                            echo("<td>" . $value['seance_id'] . "</td>");
                            echo("<td>" . $value['film'] . "</td>");
                            echo("<td>" . $value['salle'] . "</td>");
                            echo("<td>" . $value['date'] . "</td>");
                            echo("<td>" . $value['heure'] . "</td>");
                            echo("<td>" . $value['prix'] . "</td>");
                            echo("<td>" . $value['place_restantes'] . "</td>");
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