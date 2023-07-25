<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Utilisateur</title>
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
                if (isset($_POST['telephone'])) {
                    $telephone = $_POST['telephone'];
                }
                if (isset($_POST['motDePasse'])) {
                    $motDePasse = $_POST['motDePasse'];
                }
                $id = $_GET['id'];
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    
                    $sql = "UPDATE utilisateurs SET nom=:nom,prenom=:prenom,telephone=:telephone,mot_de_passe=:motDePasse WHERE utilisateur_id=:id";
                    $stmt =$conn->prepare($sql); 
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':telephone', $telephone);
                    $stmt->bindParam(':motDePasse', $motDePasse);
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
            header("Location:selectUtilisateur.php");
        ?>
    </body>
</html>