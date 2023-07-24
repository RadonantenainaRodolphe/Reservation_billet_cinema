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
                if (isset($_POST['titre'])) {
                    $titre = $_POST['titre'];
                }
                if (isset($_POST['description'])) {
                    $description = $_POST['description'];
                }
                if (isset($_POST['genre'])) {
                    $genre = $_POST['genre'];
                }
                if (isset($_POST['acteur'])) {
                    $acteur = $_POST['acteur'];
                }
                if (isset($_POST['realisateur'])) {
                    $realisateur = $_POST['realisateur'];
                }
                //Instanciation de la class BaseDeDonnee
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //Requete preparée pour inserer dans la table
                    $sql =$conn->prepare("INSERT INTO films(titre,description,genre_id,acteur_id,realisateur_id) VALUES(:titre,:description,:genre,:acteur,:realisateur)"); 
                    $sql->bindParam(':titre', $titre);
                    $sql->bindParam(':description', $description);
                    $sql->bindParam(':genre', $genre);
                    $sql->bindParam(':acteur', $acteur);
                    $sql->bindParam(':realisateur', $realisateur);
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
            header("Location:selectFilm.php");

        ?>
    </body>
</html>