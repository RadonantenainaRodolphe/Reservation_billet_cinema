<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Utilisateur</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <form action="insertUtilisateur.php" method="POST">
            <h1>Utilisateur</h1>
            <div class="form-group">
                <input class="form-control" name="nom" id="nom" placeholder="Entrer le nom de l'Utilisateur ...">
            </div>
            <div class="form-group">
                <input class="form-control" name="prenom" id="prenom" placeholder="Entrer le prénom de l'Utilisateur ...">
            </div>
            <div class="form-group">
                <input class="form-control" name="telephone" id="telephone" placeholder="Entrer le telephone de l'Utilisateur ...">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="motDePasse" id="motDePasse" placeholder="Entrer le mot de passe de l'Utilisateur ...">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </body>
</html>