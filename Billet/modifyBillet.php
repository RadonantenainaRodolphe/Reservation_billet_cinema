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

            function getData($dbName,$userName,$password,$id){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM billets WHERE billet_id={$id}";
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

            $id = $_GET['id'];
            $res = getData($dbName,$userName,$password,$id);
        ?>
        <form action="<?php echo('updatebillet.php?id=' . $id) ?>" method="POST">
            <h1>billets</h1>
            <div class="input-group">
                <select name="utilisateur" id="utilisateur">
                    <?php
                    foreach ($utilisateurs as $id => $utilisateur) {
                        if ($res[0]['utilisateur_id'] == $utilisateur['utilisateur_id'] ){
                           echo("<option value=" . $utilisateur['utilisateur_id'] . " selected = 'selected'>" . $utilisateur['nom'] . "</option>");
                        }
                        else
                        {
                            echo("<option value=" . $utilisateur['utilisateur_id'] . ">" . $utilisateur['nom'] . "</option>");
                        }
                    }
                    ?>  
                </select>
            </div>
            <div class="input-group">
                <select name="seance">
                    <?php 
                    foreach ($seances as $id => $seance) {
                        if ($seance['seance_id'] == $res[0]['seance_id'] )
                            echo("<option value=" . $seance['seance_id'] . " selected = 'selected'>" . $seance['titre'] ." ".$seance['date'] ."  " . $seance['date'] ."</option>");
                        else
                            echo("<option value=" . $seance['seance_id'] . ">".$seance['titre'] . "</option>");
                    }
                    ?>  
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" name="numeroSiege" id="numeroSiege" value="<?php echo $res[0]['numero_siege']?>">
            </div>

            <div class="form-group">
                <input type="integer" class="form-control" name="prix" id="prix" value="<?php echo $res[0]['prix']?>">
            </div>
            <div class="form-group">
                <input type="date" class="form-control" name="date" id="date" value="<?php echo $res[0]['date']?>">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </body>
</html>