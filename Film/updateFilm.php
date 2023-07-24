<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Film</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <?php

            $dbName = "reservation";
            $userName = "root";
            $password = "";
            
            include_once('../baseDeDonnee.php');

            $genre = $_POST['genre'];
            echo($genre);
            function updateData($dbName,$userName,$password){
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
                $id = $_GET['id'];
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    
                    $sql = "UPDATE films SET titre=:titre,description=:description,genre_id=:genre,acteur_id=:acteur,realisateur_id=:realisateur WHERE film_id=:id";
                    $stmt =$conn->prepare($sql); 
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':titre', $titre);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':genre', $genre);
                    $stmt->bindParam(':acteur', $acteur);
                    $stmt->bindParam(':realisateur', $realisateur);
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
            header("Location:selectFilm.php");
        ?>
    </body>
</html>