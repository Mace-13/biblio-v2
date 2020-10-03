<?php
    session_start();
    require ('connexion.php');

    if(isset($_POST['login'])){
        if($_POST['login']!="" && $_POST['password']!=""){
            $login=htmlspecialchars($_POST['login']);
            $connexion = $bdd->prepare("SELECT id_membre,login,password,role FROM membres WHERE login=?");
            $connexion->execute([$login]);

            if($don=$connexion->fetch()){
                if(password_verify($_POST['password'],$don['password'])){
                    $_SESSION['login']=$don['login'];
                    $_SESSION['id_membre']=$don['id'];
                    $_SESSION['role']=$don['role'];

                    header('LOCATION:index.php');
                }else{
                    $error="<div class='error alert alert-danger' role='alert'>Votre login ou mot de passe est incorrect</div>";
                }
            }else{
                $error="<div class='error alert alert-danger' role='alert'>Votre login ou mot de passe est incorrect</div>";
            }
        }else{
            $error="<div class='error alert alert-danger' role='alert'>Veuillez remplir le formulaire</div>";
        }
    }

    if(isset($_GET['deco'])){
        session_destroy();
        header('LOCATION:index.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>BDworld</title>
</head>
<body>
    <?php
        if(isset($_SESSION['login'])){
    ?>

    <div class="row col-12 mt-3 mb-5">
        <ul class="nav col-10">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Actu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Forum</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Shop</a>
            </li>
        </ul>
        <ul class="nav col-1 justify-content-end">
            <li class="nav_item">
                <?php
                    if($_SESSION['role']=="ROLE_ADMIN"){
                        echo '<a href="admin/" class="btn btn-warning">Administration</a>';
                    }
                ?>
            </li>
        </ul>
        <ul class="nav col-1 justify-content-end">
            <li class="nav_item">
                <a href="index.php?deco=accept" class="btn btn-danger" id="deco-button">Déconnexion</a>
            </li>
        </ul>
    </div>
  
    <div class="container">
    
        <h1>Bonjour <?=$_SESSION['login']?></h1>
            
      

        <h2 class=" mt-5 mb-5">Actualité</h2>

    
        <div class="row d-flex justify-content-around">

            <?php
            
                $req = $bdd->query('SELECT id,nom,description,image FROM article ORDER BY nom');

                while($don = $req->fetch()){

                    $id = $don['id'];
                    $nom = $don['nom'];
                    $descri = $don['description'];
                    $img = $don['image'];

                    echo "  <div class=\"card float-right\" style=\"width:18rem;height:600px;\">
                                <img src=\"images/$img\" class=\"card-img-top\" alt=\"$img\" style=\" width=150px;height=250px;\">
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">$nom</h5>
                                    <p class=\"card-text text-truncate\" >$descri</p>
                                    <a href=\"resume.php?id=$id\" class=\"btn btn-info\">See more</a>
                                </div> 
                            </div>
                    
                        ";
                }
            
            ?>
        </div>
    </div>
    <?php
        }else{
            include ('formConnex.php');
        }
    
    ?>

</body>
</html>