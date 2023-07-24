<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Film</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <?php

            $dbName = "reservation";
            $userName = "root";
            $password = "";

            include_once('../baseDeDonnee.php');

            function getData($dbName,$userName,$password,$id){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM films WHERE film_id={$id}";
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
            function getGender($dbName,$userName,$password){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM genre";
                    $result = $conn->query($sql);
                    $genre_data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $genre_data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }

            function getRealisator($dbName,$userName,$password){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM realisateur";
                    $result = $conn->query($sql);
                    $realisator_data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $realisator_data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }

            function getActor($dbName,$userName,$password){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM acteur";
                    $result = $conn->query($sql);
                    $actor_data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $actor_data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }
            $genders = getGender($dbName,$userName,$password);
            $realisators = getRealisator($dbName,$userName,$password);
            $actors = getActor($dbName,$userName,$password);

            $id = $_GET['id'];
            $res = getData($dbName,$userName,$password,$id);
            //var_dump($genders);
            //select nom from genre where $res[0]['genre_id']=genre.id
        ?>
        <form action="<?php echo('updateFilm.php?id=' . $id) ?>" method="POST">
            <h1>Film</h1>
            <div class="form-group">
                <input class="form-control" name="titre" id="titre" value="<?php echo $res[0]['titre']?>">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" id="description" value="<?php echo $res[0]['description']?>"></textarea>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="affiche" id="affiche" value="<?php echo $res[0]['affiche']?>">
            </div>
        
            <div class="input-group">
                <select name="genre" id="genre">
                    <?php
                    foreach ($genders as $id => $gender) {
                        if ($res[0]['genre_id'] == $gender['genre_id'] ){
                           echo("<option value=" . $gender['genre_id'] . " selected = 'selected'>" . $gender['nom'] . "</option>");
                        }
                        else
                        {
                            echo("<option value=" . $gender['genre_id'] . ">" . $gender['nom'] . "</option>");
                        }
                    }
                    ?>  
                </select>
            </div>
            <div class="input-group">
                <select name="acteur">
                    <?php 
                    foreach ($actors as $id => $actor) {
                        if ($actor['acteur_id'] == $res[0]['acteur_id'] )
                            echo("<option value=" . $actor['acteur_id'] . " selected = 'selected'>" . $actor['prenom'] ." ".$actor['nom'] . "</option>");
                        else
                            echo("<option value=" . $actor['acteur_id'] . ">" . $actor['prenom'] ." ".$actor['nom'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div class="input-group">
                <select name="realisateur">
                    <?php 
                    foreach ($realisators as $id => $realisator) {
                        if($realisator['realisateur_id'] == $res[0]['realisateur_id'])
                            echo("<option value=" . $realisator['realisateur_id'] . " selected = 'selected'>" . $realisator['prenom'] ." ". $realisator['nom'] . "</option>");
                        else
                            echo("<option value=" . $realisator['realisateur_id'] . ">" . $realisator['prenom'] ." ". $realisator['nom'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </body>
</html>