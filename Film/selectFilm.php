<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Films</title>
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
                    $sql = "SELECT f.film_id,f.titre,f.description,f.affiche AS affiche,a.prenom AS nom_acteur, r.prenom AS nom_realisateur, g.nom AS nom_genre FROM films f LEFT JOIN acteur a ON f.acteur_id = a.acteur_id LEFT JOIN realisateur r ON f.realisateur_id = r.realisateur_id LEFT JOIN genre g ON f.genre_id = g.genre_id";
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
            //print_r($res);
        ?>

        <div class="container">
            <button type="submit" class="btn btn-success"><a href="filmForm.php">Ajouter</a></button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Affiche</th>
                        <th>Genre</th>
                        <th>Acteur</th>
                        <th>Realisateur</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($res as $value) {
                            $url_update = "modifyFilm.php?id={$value['film_id']}";
                            $url_delete = "deleteFilm.php?id={$value['film_id']}";
                            echo("<tr>");
                            echo("<td>" . $value['film_id'] . "</td>");
                            echo("<td>" . $value['titre'] . "</td>");
                            echo("<td>" . $value['description'] . "</td>");
                            echo("<td><img src='../Img/". $value['affiche'] . "' style='width:100px;height:100px'/></td>");
                            echo("<td>" . $value['nom_genre'] . "</td>");
                            echo("<td>" . $value['nom_acteur'] . "</td>");
                            echo("<td>" . $value['nom_realisateur'] . "</td>");
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