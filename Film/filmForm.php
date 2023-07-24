<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Film</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
        <script src="../bootstrap/dist/jquery/jquery.min.js"></script>
        <script src="../bootstrap/dist/tether/tether.min.js"></script>
        <script type="text/javascript" src="../bootstrap/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php

            $dbName = "reservation";
            $userName = "root";
            $password = "";

            include_once('../baseDeDonnee.php');
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

        ?>
        <form action="insertFilm.php" method="POST" encrypt="multipart/form-data"> 
            <h1>Film</h1>
            <div class="form-group">
                <input class="form-control" name="titre" id="titre" placeholder="Entrer le titre du film ...">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" id="description" placeholder="Entrer le description du film ..."></textarea>
            </div>
            <div class="form-group">
                <input type="file" class="form-control" name="affiche" id="affiche">
            </div>
            <!--
            <div class="input-group">
                <div class="input-group-prepend mb-3">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Genre</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="">A</a>
                        <a class="dropdown-item" href="">B</a>
                        <a class="dropdown-item" href="">C</a>
                    </div>
                </div>
            </div>
        -->

            <div class="input-group">
                <select name="genre" id="genre">
                    <option value="">Genre du film</option>
                    <?php 
                    foreach ($genders as $id => $gender) {
                        echo("<option value=" . $gender['genre_id'] . ">" . $gender['nom'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div class="input-group">
                <select name="acteur">
                    <option value="">Acteur du film</option>
                    <?php 
                    foreach ($actors as $id => $actor) {
                        echo("<option value=" . $actor['acteur_id'] . ">" . $actor['prenom'] ." ".$actor['nom'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div class="input-group">
                <select name="realisateur">
                    <option value="">Realisateur du film</option>
                    <?php 
                    foreach ($realisators as $id => $realisator) {
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