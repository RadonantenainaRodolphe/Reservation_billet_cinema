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

            function insertData($dbName,$userName,$password){
                if (isset($_POST['nom'])) {
                    $nom = $_POST['nom'];
                }
                if (isset($_POST['capacite'])) {
                    $capacite = $_POST['capacite'];
                }
                if (isset($_POST['equipement'])) {
                    $equipement = $_POST['equipement'];
                }
                //Instanciation de la class BaseDeDonnee
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //Requete preparée pour inserer dans la table
                    $sql =$conn->prepare("INSERT INTO salles(nom,capacite,equipements) VALUES(:nom,:capacite,:equipement)"); 
                    $sql->bindParam(':nom', $nom);
                    $sql->bindParam(':capacite', $capacite);
                    $sql->bindParam(':equipement', $equipement);
                    $sql->execute();
                    echo "Nouvelle salle ajouter à la base de donnée";
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();
            }

            insertData($dbName,$userName,$password);
            header("Location:selectSalle.php");
        ?>
    </body>
</html>