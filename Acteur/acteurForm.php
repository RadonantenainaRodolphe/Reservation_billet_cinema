<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acteur</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <form action="insertActeur.php" method="POST">
            <h1>Acteur</h1>
            <div class="form-group">
                <input class="form-control" name="nom" id="nom" placeholder="Entrer le nom de l'acteur ...">
            </div>
            <div class="form-group">
                <input class="form-control" name="prenom" id="prenom" placeholder="Entrer le prénom de l'acteur ...">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </body>
</html>