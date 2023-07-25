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

            function updateData($dbName,$userName,$password){
                if (isset($_POST['nom'])) {
                    $nom = $_POST['nom'];
                }
                if (isset($_POST['capacite'])) {
                    $capacite = $_POST['capacite'];
                }
                if (isset($_POST['equipement'])) {
                    $equipement = $_POST['equipement'];
                }
                $id = $_GET['id'];
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    
                    $sql = "UPDATE salles SET nom=:nom,capacite=:capacite,equipements=:equipement WHERE salle_id=:id";
                    $stmt =$conn->prepare($sql); 
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':capacite', $capacite);
                    $stmt->bindParam(':equipement', $equipement);

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
            header("Location:selectSalle.php");
        ?>
    </body>
</html>