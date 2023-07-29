<?php 
    session_start();

    $dbName = "reservation";
    $userName = "root";
    $password = "";
    
    include_once('baseDeDonnee.php');

    function getDataFromDb($dbName,$userName,$password){
        $bdd = new BaseDeDonnee($dbName,$userName,$password);
        try{
            //Connexion à la base de donnée
            $conn=$bdd->connexion();
            //$sql = "SELECT * FROM films";
            $sql = "SELECT s.seance_id,s.date,s.heure,s.prix,s.place_restantes,f.titre AS film,f.description AS description,sa.nom AS salle FROM seances s LEFT JOIN films f ON s.film_id = f.film_id LEFT JOIN salles sa ON s.salle_id = sa.salle_id";
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

    $seances = getDataFromDb($dbName,$userName,$password);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index</title>
        <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link href="Css/CarouselStyle.css" rel="stylesheet">
    </head>
    <body>
        <?php include_once("navbar.php"); ?>
        <div>
            <div class="carousel">
                <ul class="slides">
                <input type="radio" name="radio-buttons" id="img-1" checked />
                <li class="slide-container">
                    <div class="slide-image">
                    <img src="Image/image1.jpg">
                    </div>
                    <div class="carousel-controls">
                    <label for="img-4" class="prev-slide">
                        <span>&lsaquo;</span>
                    </label>
                    <label for="img-2" class="next-slide">
                        <span>&rsaquo;</span>
                    </label>
                    </div>
                </li>
                <input type="radio" name="radio-buttons" id="img-2" />
                <li class="slide-container">
                    <div class="slide-image">
                    <img src="Image/image2.jpg">
                    </div>
                    <div class="carousel-controls">
                    <label for="img-1" class="prev-slide">
                        <span>&lsaquo;</span>
                    </label>
                    <label for="img-3" class="next-slide">
                        <span>&rsaquo;</span>
                    </label>
                    </div>
                </li>
                <input type="radio" name="radio-buttons" id="img-3" />
                <li class="slide-container">
                    <div class="slide-image">
                    <img src="Image/image3.jpg">
                    </div>
                    <div class="carousel-controls">
                    <label for="img-2" class="prev-slide">
                        <span>&lsaquo;</span>
                    </label>
                    <label for="img-4" class="next-slide">
                        <span>&rsaquo;</span>
                    </label>
                    </div>
                </li>
                <input type="radio" name="radio-buttons" id="img-4" />
                <li class="slide-container">
                    <div class="slide-image">
                    <img src="Image/image4.jpg">
                    </div>
                    <div class="carousel-controls">
                    <label for="img-3" class="prev-slide">
                        <span>&lsaquo;</span>
                    </label>
                    <label for="img-1" class="next-slide">
                        <span>&rsaquo;</span>
                    </label>
                    </div>
                </li>
                <div class="carousel-dots">
                    <label for="img-1" class="carousel-dot" id="img-dot-1"></label>
                    <label for="img-2" class="carousel-dot" id="img-dot-2"></label>
                    <label for="img-3" class="carousel-dot" id="img-dot-3"></label>
                    <label for="img-4" class="carousel-dot" id="img-dot-4"></label>

                </div>
                </ul>
            </div>
            </div>
        <!--
        <div id="carouselInterval" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" style="height: 90vh;">
                <div class="carousel-item active" data-interval="10000">
                    <img src="Image/image3.jpg" class="d-block w-100">
                </div>
                <div class="carousel-item" data-interval="2000">
                    <img src="Image/image2.jpg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="Image/image1.jpg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="Image/image4.jpg" class="d-block w-100">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselInterval" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselInterval" data-slide="next" role="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        -->
        
        <h2>Les évènements à venir</h2>
        <div class="d-flex flex-row">
        <?php foreach ($seances as $seance) {?>
                <div class="card m-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="Image/image1.jpg" class="img-fluid rounded-start" alt="..." style="height: 100%;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Titre : <?php echo($seance['film']) ?></h5>
                                <p class="card-text">Description : <?php echo($seance['description']) ?></p>
                                <p class="card-text">Salle de projection : <?php echo($seance['salle']) ?></p>
                                <p class="card-text">Prix : <?php echo($seance['prix']) ?>Ariary</p>
                                <p class="card-text">Place restant : <?php echo($seance['place_restantes']) ?></p>
                                <p class="card-text">Date :<?php echo($seance['date']) ?> à <small class="text-body-secondary"><?php echo($seance['heure']) ?></small></p>
                                <button class="btn btn-success"><a href="FilmDetails.php">Détail</a></button> 
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
        </div>
        <script src="bootstrap/dist/jquery/jquery.min.js"></script>
        <script src="bootstrap/dist/tether/tether.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        
    </body>
</html>