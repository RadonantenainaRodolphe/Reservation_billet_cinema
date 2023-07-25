<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index</title>
        <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <h1>Reservation</h1>
        <a href="Genre/genreForm.php">Genre</a>
        <p>Welcome 
            <?php 
            if(isset($_SESSION['name'])){
                echo($_SESSION['name']);
                echo('<a href="Authentification/logout.php">Se deconnecter</a>');
            }
            else{
                echo("home\n");
                echo('<a href="Authentification/loginForm.php">Se connecter</a>');
            }
            ?>
        </p>
    </body>
</html>