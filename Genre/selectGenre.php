<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index</title>
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
                    /*
                    //Requete preparée pour inserer dans la table
                    $sql =$conn->prepare("SELECT * FROM genre"); 
                    $sql->execute();
                    $resultat = $sql->setFetchMode(PDO::FETCH_ASSOC);
                    return $resultat;
                    */
                    $sql = "SELECT * FROM genre";
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

            function displayData($tab){
                foreach($tab as $values){
                    echo($values['nom'] . "\n");
                }
            }
            $res = getDataFromDb($dbName,$userName,$password);
            //print_r($res);
            //displayData($res);
        ?>

        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($res as $value) {
                            $url_update = "modifyGenre.php?id={$value['genre_id']}";
                            $url_delete = "deleteGenre.php?id={$value['genre_id']}";
                            echo("<tr>");
                            echo("<td>" . $value['genre_id'] . "</td>");
                            echo("<td>" . $value['nom'] . "</td>");
                            echo('<td><button class="btn btn-primary"><a href=' . $url_update  . '>Changer ' .$value["genre_id"].'</a></button></td>');
                            echo('<td><button type="submit" class="btn btn-danger"><a href=' . $url_delete  . '>Effacer ' .$value["genre_id"].'</a></button></td>');
                            echo("</tr>");
                        }
                    ?>   
                </tbody>
            </table>
        </div>
    </body>
</html>