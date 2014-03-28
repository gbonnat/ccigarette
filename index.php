<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php

session_name("SessionClub");
// ne pas mettre d'espace dans le nom de session !

session_start();



require_once("utils.php");
require_once("printForms.php");
require_once("logInOut.php");

// traitement des contenus de formulaires
/*if (isset($_GET["todo"])) {
    switch ($_GET['todo']) {
        case 'login': logIn();
            break;
        case 'logout': logOut();
            break;
        case 'register': User::register();
            break;
        case 'changepassword':User::changepassword();
            break;
    }
}*/

// Décommenter la ligne suivante pour afficher le tableau $_SESSION pour le debuggage
//print_r($_SESSION);




//        if(array_key_exists('taille',$_GET)){
//                $dim=$_GET['taille'];
//        }

if (array_key_exists('page', $_GET)) {
    $askedPage = $_GET['page'];
} else {
    $askedPage = "content_home";
}

$authorized = checkPage($askedPage);

if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $pageTitle = 'Erreur';
}
generateHTMLHead($pageTitle, 'style.css');




if (array_key_exists('todo', $_GET) && ($_GET['todo'] == "login")) {
    logIn();
}
if (array_key_exists('todo', $_GET) && ($_GET['todo'] == "logout")) {
    logOut();
}
?>

<html>    
    <body>
<?php

generateHTMLHeader();

if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]){
    printLoginForm($askedPage);
}
generateMenu();


?>


        <div id="content">
            <?php
            if ($authorized) {
                require($askedPage . '.php');
            } else {
                echo "<p>Vous n'avez pas accès à cette partie du club</p>";
            }
            ?>
        </div>
    </body>

<?php
generateHTMLFooter();
?>
</html>
