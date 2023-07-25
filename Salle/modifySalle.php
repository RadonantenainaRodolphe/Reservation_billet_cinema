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

            function getData($dbName,$userName,$password,$id){
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT * FROM salles WHERE salle_id={$id}";
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

            $id = $_GET['id'];
            $res = getData($dbName,$userName,$password,$id);
            //var_dump($res);
        ?>
        <form action="<?php echo('updateSalle.php?id=' . $id) ?>" method="POST">
            <h1>Genre</h1>
            <div class="form-group">
                <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $res[0]['nom']?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="capacite" id="capacite" value="<?php echo $res[0]['capacite']?>">
            </div>
            <div class="form-group">
                <input class="form-control" name="equipement" id="equipement" value="<?php echo $res[0]['equipements']?>">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </body>
</html>
