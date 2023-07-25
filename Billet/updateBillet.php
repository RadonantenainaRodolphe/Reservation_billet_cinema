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

           
            function updateData($dbName,$userName,$password){
                if (isset($_POST['utilisateur'])) {
                    $utilisateur = $_POST['utilisateur'];
                }
                if (isset($_POST['seance'])) {
                    $seance = $_POST['seance'];
                }
                if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                }
                if (isset($_POST['numeroSiege'])) {
                    $numeroSiege = $_POST['numeroSiege'];
                }
                if (isset($_POST['prix'])) {
                    $prix = $_POST['prix'];
                }
                if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                }
                $id = $_GET['id'];
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    
                    //$sql = "UPDATE Billets SET film_id=:film,salle_id=:salle,date=:date,heure=:heure,prix=:prix,numero_siege:=place_restantes WHERE Billet_id=:id";
                    $sql = "UPDATE billets SET utilisateur_id=:utilisateur,seance_id=:seance,date=:date,prix=:prix,numero_siege=:numero_siege WHERE Billet_id=:id";
                    $stmt =$conn->prepare($sql); 
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':utilisateur', $utilisateur);
                    $stmt->bindParam(':seance', $seance);
                    $stmt->bindParam(':date', $date);
                    $stmt->bindParam(':prix', $prix);
                    $stmt->bindParam(':numero_siege', $numeroSiege);
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
            header("Location:selectBillet.php");
        ?>
    </body>
</html>