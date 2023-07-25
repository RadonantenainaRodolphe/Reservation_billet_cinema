<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css"> 
    </head>
    <body>
        <form action="login.php" method="POST">
            <h1>Connectez-vous</h1>
            <div class="form-group">
                <input class="form-control" name="name" id="name" placeholder="Entrer votre nom">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Entrer votre mot de passe">
            </div>
            <p><a href="../Utilisateur/utilisateurForm.php">S'incrire</a></p>
            <div>
                <button type="submit" class="btn btn-primary" name="login">Se connecter</button>
            </div>
        </form>
    </body>
</html>