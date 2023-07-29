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
        <?php include_once("navbar.php"); ?>
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
        <script src="bootstrap/dist/jquery/jquery.min.js"></script>
        <script src="bootstrap/dist/tether/tether.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>