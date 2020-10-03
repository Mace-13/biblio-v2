<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="treatmentRegister.php" method="POST" id="inscription">
            <h1 class="mt-3 mb-5">Inscription</h1>  
            <div class="form-group">
                <label for="login">Login: </label>
                <input type="text" id="login" name="login" placeholder="Votre login" class="form-control">
            </div>
            <div class="form-group">
                <label for="nom">Nom: </label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" class="form-control">
            </div>
            <div class="form-group">
                <label for="prenom">Prenom: </label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre prenom" class="form-control">
            </div>
            <div class="form-group">
                <label for="mail">Email: </label>
                <input type="mail" id="mail" name="mail" placeholder="Votre adresse e-mail" class="form-control">
            </div>
            <div class="form-group">
                <label for="pass1">Mot de passe</label>
                <input type="password" id="pass1" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Inscription">
            </div>
            <?php 
                if(isset($_GET['error'])){
                    switch($_GET['error']){
                        case 1:
                            echo "<div class='error alert alert-danger' role='alert'>Veuillez remplir correctement le formulaire</div>";
                        break;
                        case 2:
                            echo "<div class='error alert alert-danger' role='alert'>Login déjà utilisé, veuillez en choisir un autre</div>";
                        break;
                        case 3:
                            echo "<div class='error alert alert-danger' role='alert'>Veuillez remplir correctement le formulaire</div>";
                        break;
                        case 4:
                            echo "<div class='error alert alert-danger' role='alert'>Votre adresse e-mail n'est pas valide</div>";
                        break;
                        case 5:
                            echo "<div class='error alert alert-danger' role='alert'>Veuillez remplir correctement le formulaire</div>";
                        break;
                        default:
                            echo "<div class='erroralert alert-danger ' role='alert'>Veuillez remplir correctement le formulaire</div>";
                    }
                }
            ?>
        </form> 

    </div>
    
</body>
</html>