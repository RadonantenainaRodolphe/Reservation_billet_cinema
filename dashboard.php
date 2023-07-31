<?php session_start(); 
    if(isset($_SESSION['role']) && $_SESSION['role'] != 'admin'){
        header("Location:/Reservation/index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <?php include_once('navbar.php'); ?>
    <h1 class="font-weight-bold mt-5 text-center text-primary">Dashboard</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4 menu mx-0">
                <ul class="nav flex-column">
                    <li class="nav-item  py-3">
                        <a class="nav-link" href="/Reservation/Seance/selectSeance.php">Seance</a>
                    </li>
                    <li class="nav-item  py-3">
                        <a class="nav-link" href="/Reservation/Film/selectFilm.php">Film</a>
                    </li>
                    <li class="nav-item  py-3">
                        <a class="nav-link" href="/Reservation/Acteur/selectActeur.php">Acteur</a>
                    </li>
                    <li class="nav-item  py-3">
                        <a class="nav-link" href="/Reservation/Realisateur/selectRealisateur.php">Realisateur</a>
                    </li>
                    <li class="nav-item  py-3">
                        <a class="nav-link" href="/Reservation/Genre/selectGenre.php">Genre</a>
                    </li>
                    <li class="nav-item  py-3">
                        <a class="nav-link" href="/Reservation/Salle/selectSalle.php">Salle</a>
                    </li>
                    <li class="nav-item  py-3">
                        <a class="nav-link" href="/Reservation/Utilisateur/selectUtilisateur.php">Utilisateur</a>
                    </li>
                    <li class="nav-item  py-3">
                        <a class="nav-link" href="/Reservation/Billet/selectBillet.php">Billet</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 ml-0 d-flex">
                <div class="align-self-center">
                    <h2>Bienvenue chef <?php echo($_SESSION['name']); ?></h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>