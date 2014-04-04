<h2>Bienvenue sur votre espace perso !</h2>








<h3>Mettre à jour mon mot de passe</h3>


<?php
require_once("User.php");

echo "Bonjour ". $_SESSION['title']. " ". $_SESSION['nom'];

if (isset($_POST["vp"]) && $_POST["vp"] != "" &&
        isset($_POST["up"]) && $_POST["up"] != "" &&
        isset($_POST["up2"]) && $_POST["up2"] != "" && $_POST["up"]==$_POST["up2"]) {
    $user = User::getUser($_SESSION['email']);
    if (!$user == NULL) {
        if ($user->testerMDP($_POST['vp'])) {
            $user->updateMDP($_POST['up']);
            echo "Mot de passe mis à jour!";
        }
    }
}



echo<<<END
<form action="index.php?page=content_users" method=post
      oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">
 <p>
  <label for="vpassword">Password actuel:</label>
  <input id="vpassword" type=password required name=vp>
 </p>
 <p>
  <label for="password1">Nouveau Password:</label>
  <input id="password1" type=password required name=up>
 </p>
 <p>
  <label for="password2">Confirmer nouveau password:</label>
  <input id="password2" type=password name=up2>
 </p>
  <input type=submit value="Mettre à jour">
</form>
END;
?>