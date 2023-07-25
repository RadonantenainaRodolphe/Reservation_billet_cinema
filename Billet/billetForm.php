<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Billet</title>
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
            function getUtilisateur($dbName,$userName,$password){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM utilisateurs";
                    $result = $conn->query($sql);
                    $utilisateur_data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $utilisateur_data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }
            function getSeance($dbName,$userName,$password){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT s.seance_id,s.date,s.heure,f.titre FROM seances s LEFT JOIN films f ON s.film_id = f.film_id";
                    $result = $conn->query($sql);
                    $seance_data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $seance_data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }
            $utilisateurs = getUtilisateur($dbName,$userName,$password);
            $seances = getSeance($dbName,$userName,$password);
        ?>
        <form action="insertBillet.php" method="POST" encrypt="multipart/form-data"> 
            <h1>Billet</h1>
            <div class="input-group">
                <select name="utilisateur" id="utilisateur">
                    <option value="">Utilisateur</option>
                    <?php 
                    foreach ($utilisateurs as $id => $utilisateur) {
                        echo("<option value=" . $utilisateur['utilisateur_id'] . ">" . $utilisateur['nom'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div class="input-group">
                <select name="seance">
                    <option value="">Seance</option>
                    <?php 
                    foreach ($seances as $id => $seance) {
                        echo("<option value=" . $seance['seance_id'] . ">" . $seance['titre'] ." " .$seance['date'] . " " . $seance['heure'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" name="numeroSiege" id="numeroSiege" placeholder="Entrer le numeroSiege">
            </div>

            <div class="form-group">
                <input type="integer" class="form-control" name="prix" id="prix" placeholder="Entrer le prix ...">
            </div>
            <div class="form-group">
                <input type="date" class="form-control" name="date" id="date" placeholder="Date du seance ...">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </body>
</html>