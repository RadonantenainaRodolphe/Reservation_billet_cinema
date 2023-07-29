<?php 
    session_start();
?>
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

            function insertData($dbName,$userName,$password){
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
                    //Pour plus de securite il faut hasher le mot de passe
                    $motDePasse = hash("sha256",$_POST['motDePasse']);
                }
                //Instanciation de la class BaseDeDonnee
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //Requete preparée pour inserer dans la table
                    $sql =$conn->prepare("INSERT INTO utilisateurs(nom,prenom,telephone,mot_de_passe) VALUES(:nom,:prenom,:telephone,:motDePasse)"); 
                    $sql->bindParam(':nom', $nom);
                    $sql->bindParam(':prenom', $prenom);
                    $sql->bindParam(':telephone', $telephone);
                    $sql->bindParam(':motDePasse', $motDePasse);

                    $sql->execute();
                    echo "Nouvelle utilisateur ajouter à la base de donnée";
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();
            }

            insertData($dbName,$userName,$password);
            $_SESSION['name'] = $_POST['nom'];
            header("Location:../index.php");
        ?>
    </body>
</html>