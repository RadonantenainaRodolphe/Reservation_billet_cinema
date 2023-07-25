<?php
    session_start();
    $dbName = "reservation";
    $userName = "root";
    $password = "";
     
    include_once('../baseDeDonnee.php');

    if(isset($_POST['login'])){
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        $bdd = new BaseDeDonnee($dbName,$userName,$password);
        //Connexion à la base de donnée
        $conn=$bdd->connexion();
        $sql = $conn->prepare("SELECT * FROM utilisateurs WHERE nom=:name AND mot_de_passe =:pass");
        $sql->bindParam(':name', $name);
        $sql->bindParam(':pass', $pass);
        $sql->execute();

        if($sql->rowCount()>0){
            $_SESSION['name'] = $name;
            header("Location:../index.php");

        }
        else {
           header("Location:loginForm.php");
           echo("Votre nom ou mot de n'est pas valide !");
        }
    }
?>