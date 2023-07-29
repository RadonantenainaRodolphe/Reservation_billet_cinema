<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Utilisateur</title>
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../loginFormStyle.css">
    </head>
    <body>
        
        <div class="pt-5">
            <div class="global-container">
                <div class="card login-form">
                    <div class="card-body">
                        <h3 class="card-title text-center">Inscrivez-vous</h3>
                        <div class="card-text">
                            <form action="insertUtilisateur.php" method="POST">
                                <div class="form-group">
                                    <input class="form-control" name="nom" id="nom" placeholder="Entrer votre nom">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="prenom" id="prenom" placeholder="Entrer votre prénom(s)">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="telephone" id="telephone" placeholder="Entrer votre numéro de téléphone">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="motDePasse" id="motDePasse" placeholder="Entrer votre mot de passe">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>