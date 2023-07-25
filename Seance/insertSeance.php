<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Seance</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <?php
            
            $dbName = "reservation";
            $userName = "root";
            $password = "";
            
            include_once('../baseDeDonnee.php');

            function insertData($dbName,$userName,$password){
                if (isset($_POST['film'])) {
                    $film = $_POST['film'];
                }
                if (isset($_POST['salle'])) {
                    $salle = $_POST['salle'];
                }
                if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                }
                if (isset($_POST['heure'])) {
                    $heure = $_POST['heure'];
                }
                if (isset($_POST['prix'])) {
                    $prix = $_POST['prix'];
                }
                if (isset($_POST['placeRestantes'])) {
                    $placeRestantes = $_POST['placeRestantes'];
                }
                //Instanciation de la class BaseDeDonnee
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //Requete preparée pour inserer dans la table
                    $sql =$conn->prepare("INSERT INTO seances(film_id,salle_id,date,heure,prix,place_restantes) VALUES(:film,:salle,:date,:heure,:prix,:placeRestantes)"); 
                    $sql->bindParam(':film', $film);
                    $sql->bindParam(':salle', $salle);
                    $sql->bindParam(':date', $date);
                    $sql->bindParam(':heure', $heure);
                    $sql->bindParam(':prix', $prix);
                    $sql->bindParam(':placeRestantes', $placeRestantes);
                    $sql->execute();
                    echo "Nouvelle seance ajouter à la base de donnée";
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                //Fermeture de la base de donnée
                $bdd->deconnexion();
            }

            insertData($dbName,$userName,$password);
            header("Location:selectSeance.php");

        ?>
    </body>
</html>