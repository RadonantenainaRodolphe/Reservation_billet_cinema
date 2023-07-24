<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <?php

            $dbName = "reservation";
            $userName = "root";
            $password = "";
            
            include_once('../baseDeDonnee.php');

            function insertData($dbName,$userName,$password){
                if (isset($_POST['genre'])) {
                    $genre = $_POST['genre'];
                }
                //Instanciation de la class BaseDeDonnee
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //Requete preparée pour inserer dans la table
                    $sql =$conn->prepare("INSERT INTO genre(nom) VALUES(:genre)"); 
                    $sql->bindParam(':genre', $genre);
                    $sql->execute();
                    echo "Nouvelle genre ajouter à la base de donnée";
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();
            }

            insertData($dbName,$userName,$password);
            header("selectGenre");
        ?>
    </body>
</html>