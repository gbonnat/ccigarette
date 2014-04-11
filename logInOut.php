<?php
require_once('User.php');

function logIn(){
    if (array_key_exists('email', $_POST)&& array_key_exists('password', $_POST)){
        $user = User::getUser($_POST['email']);
        if (! $user==NULL && $user->testerMDP($_POST['password'])){
            $_SESSION['loggedIn'] = true;
            $_SESSION['email'] = $user->email;
            $_SESSION['nom'] = $user->nom;
            $_SESSION['prenom'] = $user->prenom;
            $_SESSION['title'] = $user->title;
            return true;
        }
    }
    else{ 
        return false;
    }
}

function logOut(){   
    $_SESSION['loggedIn'] = false;
    unset($_SESSION['email']);
    unset($_SESSION['nom']);
    unset($_SESSION['prenom']);
    unset($_SESSION['title']);
}

?>