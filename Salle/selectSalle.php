<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Salle</title>
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
                    $sql = "SELECT * FROM salles";
                    $result = $conn->query($sql);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }

            $res = getDataFromDb($dbName,$userName,$password);
            //print_r($res);
            //displayData($res);
        ?>

        <div class="container">
            <button type="submit" class="btn btn-success"><a href="salleForm.php">Ajouter</a></button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Capacité</th>
                        <th>Equipements</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($res as $value) {
                            $url_update = "modifySalle.php?id={$value['salle_id']}";
                            $url_delete = "deleteSalle.php?id={$value['salle_id']}";
                            echo("<tr>");
                            echo("<td>" . $value['salle_id'] . "</td>");
                            echo("<td>" . $value['nom'] . "</td>");
                            echo("<td>" . $value['capacite'] . "</td>");
                            echo("<td>" . $value['equipements'] . "</td>");
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