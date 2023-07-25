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

            function insertData($dbName,$userName,$password){
                if (isset($_POST['utilisateur'])) {
                    $utilisateur = $_POST['utilisateur'];
                }
                if (isset($_POST['seance'])) {
                    $seance = $_POST['seance'];
                }
                if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                }
                if (isset($_POST['numeroSiege'])) {
                    $numeroSiege = $_POST['numeroSiege'];
                }
                if (isset($_POST['prix'])) {
                    $prix = $_POST['prix'];
                }
                if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                }
                //Instanciation de la class BaseDeDonnee
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    //Requete preparée pour inserer dans la table
                    $sql =$conn->prepare("INSERT INTO billets(utilisateur_id,seance_id,numero_siege,prix,date) VALUES(:utilisateur,:seance,:numeroSiege,:prix,:date)"); 
                    $sql->bindParam(':utilisateur', $utilisateur);
                    $sql->bindParam(':seance', $seance);
                    $sql->bindParam(':numeroSiege', $numeroSiege);
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

            insertData($dbName,$userName,$password);
            header("Location:selectBillet.php");

        ?>
    </body>
</html>