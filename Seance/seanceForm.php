<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Seance</title>
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

        ?>
        <form action="insertSeance.php" method="POST" encrypt="multipart/form-data"> 
            <h1>Seance</h1>
            
            <div class="input-group">
                <select name="film" id="film">
                    <option value="">Film</option>
                    <?php 
                    foreach ($films as $id => $film) {
                        echo("<option value=" . $film['film_id'] . ">" . $film['titre'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div class="input-group">
                <select name="salle">
                    <option value="">Salle</option>
                    <?php 
                    foreach ($salles as $id => $salle) {
                        echo("<option value=" . $salle['salle_id'] . ">" . $salle['nom'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" name="date" id="date" placeholder="Entrer la date du film ...">
            </div>
            <div class="form-group">
                <input class="form-control" name="heure" id="heure" placeholder="Entrer l'heure du film ...">
            </div>
            <div class="form-group">
                <input type="integer" class="form-control" name="prix" id="prix" placeholder="Entrer le prix ...">
            </div>
            <div class="form-group">
                <input type="integer" class="form-control" name="placeRestantes" id="placeRestantes" placeholder="Places restantes ...">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </body>
</html>