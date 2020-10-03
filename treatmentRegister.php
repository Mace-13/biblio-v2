<?php
    if(isset($_POST['login'])){
        require "connexion.php";
        $err=0;
        if(!empty($_POST['login'])){
            $login=htmlspecialchars($_POST['login']);
            $req = $bdd->prepare("SELECT * FROM membres WHERE login=?");
            $req->execute([$login]);
            if($don=$req->fetch()){
                $err=2;
            }
            $req->closeCursor();
        }else{
            $err=1;
        }

        if(!empty($_POST['nom'])){
            $name=htmlspecialchars($_POST['nom']);
        }else{
            $err=3;
        }

        if(!empty($_POST['prenom'])){
            $surname=htmlspecialchars($_POST['prenom']);
        }else{
            $err=3;
        }

        if(!empty($_POST['mail'])){
            if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,6}$#", $_POST['mail'])){
                $email=$_POST['mail']; 
            }else{
                $err=4;
            }
        }else{
            $err=3;
        }

        if(!empty($_POST['password'])){
            $hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
        }else{
            $err=5;
        }


        if($err==0){
            
            $insert = $bdd->prepare("INSERT INTO membres(login,password,nom,prenom,mail,role) VALUES(:login,:pass,:nom,:prenom,:mail,:role)");
            $insert->execute([
                ":login"=>$login,
                ":pass"=>$hash,
                ":nom"=>$name,
                ":prenom"=>$surname,
                ":mail"=>$email,
                ":role"=> "ROLE_USER"
            ]);
            $insert->closeCursor();
            header("LOCATION:index.php?register=success");

        }else{
            header("LOCATION:inscription.php?error=".$err);
        }


    }else{
        header("LOCATION:inscription.php");
    }


?>