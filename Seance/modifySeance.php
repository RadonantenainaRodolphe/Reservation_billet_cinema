<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Seance</title>
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
                    $sql = "SELECT * FROM seances WHERE seance_id={$id}";
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
            function getSalle($dbName,$userName,$password){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM salles";
                    $result = $conn->query($sql);
                    $salle_data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $salle_data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }
            function getFilm($dbName,$userName,$password){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM films";
                    $result = $conn->query($sql);
                    $salle_data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $salle_data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }
            $salles = getSalle($dbName,$userName,$password);
            $films = getFilm($dbName,$userName,$password);


            $id = $_GET['id'];
            $res = getData($dbName,$userName,$password,$id);
        ?>
        <form action="<?php echo('updateSeance.php?id=' . $id) ?>" method="POST">
            <h1>Seances</h1>
            <div class="input-group">
                <select name="film" id="film">
                    <?php
                    foreach ($films as $id => $film) {
                        if ($res[0]['film_id'] == $film['film_id'] ){
                           echo("<option value=" . $film['film_id'] . " selected = 'selected'>" . $film['titre'] . "</option>");
                        }
                        else
                        {
                            echo("<option value=" . $film['film_id'] . ">" . $film['titre'] . "</option>");
                        }
                    }
                    ?>  
                </select>
            </div>
            <div class="input-group">
                <select name="salle">
                    <?php 
                    foreach ($salles as $id => $salle) {
                        if ($salle['salle_id'] == $res[0]['salle_id'] )
                            echo("<option value=" . $salle['salle_id'] . " selected = 'selected'>" . $salle['prenom'] ." ".$salle['nom'] . "</option>");
                        else
                            echo("<option value=" . $salle['salle_id'] . ">".$salle['nom'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            
            <div class="form-group">
                <input class="form-control" name="date" id="date" value="<?php echo $res[0]['date']?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="heure" id="heure" value="<?php echo $res[0]['heure']?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="prix" id="prix" value="<?php echo $res[0]['prix']?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="placeRestantes" id="placeRestantes" value="<?php echo $res[0]['place_restantes']?>">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </body>
</html>