<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Realisateur</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <form action="insertRealisateur.php" method="POST">
            <h1>Realisateur</h1>
            <div class="form-group">
                <input class="form-control" name="nom" id="nom" placeholder="Entrer le nom du Realisateur ...">
            </div>
            <div class="form-group">
                <input class="form-control" name="prenom" id="prenom" placeholder="Entrer le prénom du Realisateur ...">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </body>
</html>