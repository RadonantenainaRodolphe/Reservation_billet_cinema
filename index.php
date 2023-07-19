<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index</title>
        <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <h1>Reservation</h1>
        <a href="genreForm.php">Genre</a>
        <?php
            $connection = mysql_connect('localhost','root','') or die('impossible de se connecter !');
            mysql_select_db('reservation') or die('impossible de selectionner la base de données');
            $query = 'INSERT INTO genre(genre_id,nom) VALUES(2,"erotique")';
            mysql_query($query);
            mysql_close($connection);
        ?>
    </body>
</html>