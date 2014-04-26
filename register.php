<script type="text/javascript">
	
		jQuery(document).ready(function(){
			// Declare parallax on layers
			jQuery('.parallax-layer').parallax({
				mouseport: jQuery("#parallax")
			});
		});
	</script>

<center>
    <h2>Register Now</h2>
</center>


<?php
require_once('User.php');
require_once('Cart.php');

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
        Cart::createCart($_POST['email']);
    }
    
    else{
        if ($tentative){
            echo "Email déjà rattaché à un compte!";
        }
        if (isset($_POST['password']) && isset($_POST['mdp2']) && $_POST['password']!=$_POST['mdp2']){
            echo "mdp différents!";
            
        }


echo<<<FIN
<form action='index.php?page=register' method='POST' id='register'>
    <input type='email' name='email' placeholder='email'><br>
    <input type='password' name='password' placeholder='password'><br>
    <input type='password' name='mdp2' placeholder='repeat password'><br>
    <input name="title" value="W" type="radio" checked="checked" required />Mme
    <input name="title" value="M" type="radio" />M. <br>
    <input type='text' name='nom' placeholder='Last name' value='$nom'><br>
    <input type='text' name='prenom' placeholder='First Name' value='$prenom'><br>
    <input id="Date of Birth" type=date required name=naissance placeholder="Date of Bith"><br>
    <input type='submit' action='valider' class='buttons' >
</form>
FIN;
    }

?>
   
        <div class="parallax-viewport" id="parallax" style="margin: 70px;">
    <ul>
        <li class="parallax-layer"  style="width: 860px; height: 273px;"><img src="images/0_sun.png" alt="" style="position: absolute;left: 300px;top: -12px"></li>
        <li class="parallax-layer"  style="width: 920px; height: 274px;"><img src="images/1_mountains.png" alt="" style="position: absolute; margin: 0;"></li>
        <li class="parallax-layer"  style="width: 1100px; height: 284px;"><img src="images/2_hill.png" alt="" style="position: absolute;left: 0px;top: 30px"></li>
        <li class="parallax-layer"  style="width: 1360px; height: 320px;"><img src="images/3_wood.png" alt="" style="position: absolute;left: 0px;top: 60px"></li>
    </ul>
</div>

