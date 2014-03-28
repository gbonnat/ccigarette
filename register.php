//<h2>M'inscrire</h2>


<?php
require_once('User.php');

$nom = "";
if (array_key_exists('nom',$_POST)){
    $nom = $_POST['nom'];
}

$prenom = "";
if (array_key_exists('prenom',$_POST)){
    $prenom = $_POST['prenom'];
}

$erreur = "";
$ok = FALSE;
$tentative = FALSE;
if (isset($_POST['email']) && !$_POST['email']=="" && isset($_POST['password']) && isset($_POST['mdp2']) && $_POST['password']==$_POST['mdp2']){
    $tentative = TRUE;
    $ok= User::insertUser($_POST['email'],$_POST['password'],$_POST['title'],$_POST['nom'],$_POST['prenom'],$_POST['naissance']);
}

    if ($ok){
         $_SESSION['loggedIn'] = true;
        echo "Bienvenue sur notre site";
       

    }
    else{
        if ($tentative){
            echo "Email déjà rattaché à un compte!";
        }
        if (isset($_POST['password']) && isset($_POST['mdp2']) && $_POST['password']!=$_POST['mdp2']){
            echo "mdp différents!";
            
        }


echo<<<FIN
<form action='index.php?page=register' method='POST'>
    <input type='email' name='email' placeholder='email'><br>
    <input type='password' name='password' placeholder='mot de passe'><br>
    <input type='password' name='mdp2' placeholder='mot de passe (confirmation)'><br>
    <input name="title" value="Mme" type="radio" checked="checked" required />Mme
    <input name="title" value="M." type="radio" />M. <br>
    <input type='text' name='nom' placeholder='nom' value='$nom'><br>
    <input type='text' name='prenom' placeholder='prénom' value='$prenom'><br>
    <input id="Date of Birth" type=date required name=naissance placeholder="Dare of Bith"><br>
    <input type='submit' action='valider'>
</form>
FIN;
    }
?>
   


