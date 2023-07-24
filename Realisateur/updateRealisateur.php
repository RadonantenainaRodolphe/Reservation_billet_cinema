<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Realisateur</title>
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
                if (isset($_POST['prenom'])) {
                    $prenom = $_POST['prenom'];
                }
                $id = $_GET['id'];
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    
                    $sql = "UPDATE realisateur SET nom=:nom,prenom=:prenom WHERE realisateur_id=:id";
                    $stmt =$conn->prepare($sql); 
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':prenom', $prenom);
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
            header("Location:selectRealisateur.php");
        ?>
    </body>
</html>