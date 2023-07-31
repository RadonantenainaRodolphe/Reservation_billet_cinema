<?php
    session_start()
?>

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

            function getIdUser($dbName,$userName,$password){
                $name = $_SESSION['name'];
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //$sql = "SELECT * FROM films";
                $sql = "SELECT utilisateur_id FROM utilisateurs WHERE nom ='{$name}'";
                    $result = $conn->query($sql);
                    $userId = $result->fetchAll(PDO::FETCH_ASSOC);
                   // $genre = $conn->query("SELECT ")

                    return $userId;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();    
            }
            
            function getSeanceDetailById($dbName,$userName,$password){
                $id = $_GET['seance_id'];
            
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    $sql = "SELECT s.prix,s.date,s.place_restantes,sa.capacite FROM seances s INNER JOIN salles sa WHERE seance_id = $id";
                    $result = $conn->query($sql);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    // $genre = $conn->query("SELECT ")
            
                    return $data;
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();                
            }
            
            function insertData($dbName,$userName,$password){
                $utilisateur = getIdUser($dbName,$userName,$password)[0]['utilisateur_id'];
                $seance = $_GET['seance_id'];
                $prix = getSeanceDetailById($dbName,$userName,$password)[0]['prix'];
                $date = getSeanceDetailById($dbName,$userName,$password)[0]['date'];
                $capaciteSalle = getSeanceDetailById($dbName,$userName,$password)[0]['capacite'];
                $placeRestantes = getSeanceDetailById($dbName,$userName,$password)[0]['place_restantes'];
                //Algo numéro de la chaise
                global $numeroChaise;
                $numeroChaise = $capaciteSalle - $placeRestantes + 1;
                //Instanciation de la class BaseDeDonnee
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //Requete preparée pour inserer dans la table
                    $sql =$conn->prepare("INSERT INTO billets(utilisateur_id,seance_id,numero_siege,prix,date) VALUES(:utilisateur,:seance,:numeroSiege,:prix,:date)"); 
                    $sql->bindParam(':utilisateur', $utilisateur);
                    $sql->bindParam(':seance', $seance);
                    $sql->bindParam(':numeroSiege', $numeroChaise);
                    $sql->bindParam(':prix', $prix);
                    $sql->bindParam(':date', $date);
                    $sql->execute();
                    echo "Nouvelle seance ajouter à la base de donnée";
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();
            }
            
            function updatePlaceNumber($dbName,$userName,$password){
                $id = $_GET['seance_id'];
                $placeRestantes = getSeanceDetailById($dbName,$userName,$password)[0]['place_restantes'];
                $place = $placeRestantes - 1;
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    
                    //$sql = "UPDATE Billets SET film_id=:film,salle_id=:salle,date=:date,heure=:heure,prix=:prix,numero_siege:=place_restantes WHERE Billet_id=:id";
                    $sql = "UPDATE seances SET place_restantes=:place WHERE seance_id=:id";
                    $stmt =$conn->prepare($sql); 
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':place', $place);
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
            echo($_SESSION['name']);
        if(isset($_SESSION['name'])){
            insertData($dbName,$userName,$password);
            updatePlaceNumber($dbName,$userName,$password);
            $message = "Votre réservation est effectuée. Votre numéro de chaise est ".$numeroChaise;
            header("Location:/Reservation/index.php?message=".$message);
        }else{
            header("Location:/Reservation/Authentification/loginForm.php");
        }

        ?>
    </body>
</html>