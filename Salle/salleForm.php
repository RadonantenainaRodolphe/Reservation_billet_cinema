<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Salle</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <form action="insertSalle.php" method="POST">
            <h1>Realisateur</h1>
            <div class="form-group">
                <input class="form-control" name="nom" id="nom" placeholder="Entrer le nom de la salle ...">
            </div>
            <div class="form-group">
                <input class="form-control" name="capacite" id="capacite" placeholder="Entrer la capacité de la salle ...">
            </div>
            <div class="form-group">
                <input class="form-control" name="equipement" id="equipement" placeholder="Entrer les équipements de la salle ...">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </body>
</html>