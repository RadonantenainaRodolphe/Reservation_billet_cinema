<?php 

session_start();

$dbName = "reservation";
$userName = "root";
$password = "";

include_once('../baseDeDonnee.php');
//
function getSeanceDetail($dbName,$userName,$password){
    $id = $_GET['id'];

    $bdd = new BaseDeDonnee($dbName,$userName,$password);
    try{
        //Connexion à la base de donnée
        $conn=$bdd->connexion();
        //$sql = "SELECT * FROM films";
        $sql = "SELECT s.seance_id,s.date,s.heure,s.prix,s.place_restantes,f.titre AS titre,f.affiche AS affiche,f.description AS description,sa.nom AS salle, re.nom AS realisateur,ge.nom AS genre,ac.nom AS acteur FROM seances s LEFT JOIN films f ON s.film_id = f.film_id LEFT JOIN salles sa ON s.salle_id = sa.salle_id LEFT JOIN realisateur re ON f.realisateur_id = re.realisateur_id LEFT JOIN genre ge ON f.genre_id = ge.genre_id LEFT JOIN acteur ac ON f.acteur_id = ac.acteur_id WHERE seance_id = $id";    
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

$seance = getSeanceDetail($dbName,$userName,$password);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>
    <body>
    <?php include_once('../navbar.php'); $id = $_GET['id'];?>
        <div class="container mt-5 pt-5">
            <div class="row align-items-center text-left p-5">
                <div class="col">
                    <img src="../Img/<?php echo($seance[0]['affiche'])?>" class="img-fluid rounded-start" alt="..." style="height: 100%;">
                </div>
                <div class="col">
                    <h5 class="font-weight-bold">Titre : <?php echo($seance[0]['titre']) ?></h5>
                    <p>Description : <?php echo($seance[0]['description']) ?></p>
                    <p>Realisateur : <?php echo($seance[0]['realisateur']) ?></p>
                    <p>Acteur : <?php echo($seance[0]['acteur']) ?></p>
                    <p>Genre : <?php echo($seance[0]['genre']) ?></p>
                    <p>Salle de projection : <?php echo($seance[0]['salle']) ?></p>
                        <?php
                            if ($seance[0]['place_restantes']<1){
                                echo("<p>Rupture de stock</p>");
                            }
                            else { 
                                echo("<p class='card-text'>Place restant : " . $seance[0]['place_restantes']);
                            }
                        ?>
                    </p>
                    <p>Date :<?php echo($seance[0]['date']) ?> à <small class="text-body-secondary"><?php echo($seance[0]['heure']) ?></small></p>
                </div>
                <div class="col">
                    <p class="font-weight-bold">Prix : <?php echo($seance[0]['prix']) ?>Ariary</p>
                    <?php
                        if ($seance[0]['place_restantes']>1 && $seance[0]["date"] > date('Y-m-d')){
                    ?>
                        <button class="btn btn-success"><a class="navbar-text" href="/Reservation/Billet/insertTicketByUser.php?seance_id=<?php echo($id) ?>">Réserver</a></button>
                    <?php    }
                        else{
                            echo('<button class="btn btn-danger" disabled=disabled><a href="insertTicketByUser.php?seance_id=".$seance[0]["seance_id"]).">Réserver</a></button>');
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>