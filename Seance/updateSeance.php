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

           
            function updateData($dbName,$userName,$password){
                if (isset($_POST['film'])) {
                    $film = $_POST['film'];
                }
                if (isset($_POST['salle'])) {
                    $salle = $_POST['salle'];
                }
                if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                }
                if (isset($_POST['heure'])) {
                    $heure = $_POST['heure'];
                }
                if (isset($_POST['prix'])) {
                    $prix = $_POST['prix'];
                }
                if (isset($_POST['placeRestantes'])) {
                    $placeRestantes = $_POST['placeRestantes'];
                }
                $id = $_GET['id'];
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    
                    //$sql = "UPDATE seances SET film_id=:film,salle_id=:salle,date=:date,heure=:heure,prix=:prix,place_restantes:=place_restantes WHERE seance_id=:id";
                    $sql = "UPDATE seances SET film_id=:film,salle_id=:salle,date=:date,heure=:heure,prix=:prix,place_restantes=:place_restantes WHERE seance_id=:id";
                    $stmt =$conn->prepare($sql); 
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':film', $film);
                    $stmt->bindParam(':salle', $salle);
                    $stmt->bindParam(':date', $date);
                    $stmt->bindParam(':heure', $heure);
                    $stmt->bindParam(':prix', $prix);
                    $stmt->bindParam(':place_restantes', $placeRestantes);
                    if($stmt->execute()){
                        echo("Mis à jour avec succés");
                    }

                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }
            updateData($dbName,$userName,$password);
            header("Location:selectSeance.php");
        ?>
    </body>
</html>