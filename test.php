<?php 
$dbName = "reservation";
$userName = "root";
$password = "";

include_once('baseDeDonnee.php');
/*
    if(isset($_POST['submit']) && isset($_FILES['image'])){
        echo("<pre>");
        print_r($_FILES['image']);
        echo("</pre>");

        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageError = $_FILES['image']['error'];
        
        if($imageError == 0 ){
            if($imageSize > 100000){
                $message = "Image trop volumineux";
                header("Location:test.php?error=$message");
            }
        }else {
            $message = "Erreur erreur";
            header("Location:test.php?error=$message");
        }
       
    }
    else {
        echo("Erreur lors de l'importation de l'image");
    }*/

    if(isset($_POST["submit"])){
        if($_FILES["image"]["error"] === 4){
            echo("<script>alert('Image n\'existe pas');</script>");
        } else {
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $tmpName = $_FILES['image']['tmp_name'];

            $validExtenstion = ["jpg","jpeg","png"];
            $fileExtension = explode(".",$fileName);
            $fileExtension = strtolower(end($fileExtension));
            if(!in_array($fileExtension, $validExtenstion)){
                echo("<script>alert('L\'extension n\'est pas valide');</script>");
            } else if($fileSize > 2000000){
                echo("<script>alert('Le fichier est trés volumineux');</script>");
            } else{
                $newFileName = uniqid();
                $newFileName .= '.'.$fileExtension;
                echo($newFileName);
                move_uploaded_file($tmpName, 'Img/'.$newFileName);
                /*
                $bdd = new BaseDeDonnee($dbName,$userName,$password);
                try{
                    //Connexion à la base de donnée
                    $conn=$bdd->connexion();
                    
                    $sql = "UPDATE films SET affiche=:affiche WHERE film_id=8";
                    $stmt =$conn->prepare($sql); 
                    $stmt->bindParam(':affiche', $newFileName, PDO::PARAM_INT);
                    if($stmt->execute()){
                        echo("Mis à jour avec succés");
                    }
                }
                catch(PDOException $e) {
                    echo "ERREUR <br>" . $e->getMessage();
                }
                echo("OK");
                */
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form  method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <button type="submit" name="submit">HI</button>
    </form>
</body>
</html>