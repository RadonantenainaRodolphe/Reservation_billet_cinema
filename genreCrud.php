<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Index</title>
        <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <?php
            $nomGenre = $_POST['genre'];
            echo($nomGenre);
            $connection = mysql_connect('localhost','root','') or die('impossible de se connecter !');
            mysql_select_db('reservation') or die('impossible de selectionner la base de données');
            $query = 'INSERT INTO genre(nom) VALUES($nomGenre)';
            mysql_query($query);
            mysql_close($connection);
            echo($nomGenre);
        ?>
    </body>
</html>