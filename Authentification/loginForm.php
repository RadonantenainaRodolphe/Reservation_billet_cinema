<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../loginFormStyle.css">
        
    </head>
    <body>
        <div class="pt-5">
            <div class="global-container">
                <div class="card login-form">
                    <div class="card-body">
                        <h3 class="card-title text-center">Connectez-vous</h3>
                        <div class="card-text">
                            <form action="login.php" method="POST">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input class="form-control" name="name" id="name" placeholder="Entrer votre nom">
                                </div>
                                <div class="form-group">
                                    <label for="pass">Mot de passe</label>
                                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Entrer votre mot de passe">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary" name="login">Se connecter</button>
                                </div>
                                <div class="sign-up">
                                    Vous n'avez pas encore du compte? <a href="../Utilisateur/utilisateurForm.php">S'inscrire</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>