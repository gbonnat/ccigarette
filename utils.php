<?php

//require_once 'User.php';


function generateHTMLHead($title, $styleSheet) {
    echo <<<CHAINE_DE_FIN
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Nom de l'auteur"/>
        <meta name="keywords" content="Mots clefs relatifs à cette page"/>
        <meta name="description" content="Descriptif court"/>
        <link rel="stylesheet" type="text/css" href="$styleSheet" />
        <script type="text/javascript" src="js/code.js"></script>    
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>    
        <script type="text/javascript" src="js/parallax/jquery.parallax.js"></script>    
        <title>$title</title>
    </head>               
CHAINE_DE_FIN;
}

function generateHTMLHeader($askedPage) {
    echo '<header>';
    echo '<img src="images/logo_cc.png" id="logo_cc">';
    echo '<h1 id="logo">'."Club Cigarette".'</h1>';   
    
    if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]){
    printLoginForm($askedPage);
}
    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
        echo '<div class="login">';
        echo    "<ul>";
        echo        "<li><a href='index.php?page=content_users'>Mon compte</a></li>";
        echo        "<li><a href='index.php?page=content_cart'>Mon panier</a></li>";
        echo        "<li><a href='index.php?todo=logout'>Logout</a></li>";
        echo    "</ul>";
        echo '</div>';
        }
        
    echo '</header>';   
}

function generateHTMLFooter() {
    echo "<footer>" . PHP_EOL;
    echo "<p>Designed by Grégoire Bonnat & Julien Mercier</p>" . PHP_EOL;
    echo "<div id='logos'>" . PHP_EOL;
    echo "<a href='https://www.facebook.com/gregoire.bonnat'>
                        <img src='images/fb.png' class='logo'>
                    </a>" . PHP_EOL;
    echo "<a href='https://twitter.com/GBonnat'>
                        <img src='images/twitter.png' class='logo'>
                    </a>" . PHP_EOL;
    echo "<a href='http://www.linkedin.com/pub/gr%C3%A9goire-bonnat/82/a98/ba2'>
                        <img src='images/linkedin.png' class='logo'>
                    </a>" . PHP_EOL;
    echo "</div>
    </footer>";
}

function checkPage($askedPage){
    //Chargement du fichier
  $xml = simplexml_load_file("pages.xml");
 
  //Recuperation de l'ensemble des noeuds correspondant aux balises "page"
  $tabPages = $xml->page;
 
  //Parcours du tableau des pages (on peut utiliser egalement une boucle "for")
  foreach($tabPages as $page){
    if (strcmp($page->name,$askedPage)==0){
        return true;
    }
  }
  return false;
}

function getPageTitle($askedPage){
    //Chargement du fichier
  $xml = simplexml_load_file("pages.xml");
 
  //Recuperation de l'ensemble des noeuds correspondant aux balises "page"
  $tabPages = $xml->page;
 
  //Parcours du tableau des pages (on peut utiliser egalement une boucle "for")
  foreach($tabPages as $page){
    if (strcmp($page->name,$askedPage)==0){
        return $page->title;
    }
    
    return false;
  }
}

function generateMenu(){
/*    $xml = simplexml_load_file("pages.xml");
 
  $tabPages = $xml->page;
 
  echo '<nav id="menu">
            <ul>';
  
  foreach($tabPages as $page){
      echo '<li><a href="index.php?page='.$page->name.'">'.$page->title.'</a></li>';
      
  } */
    
  echo '<nav id="menu">
            <ul>';
  echo '<li><a href="index.php?page=content_home">Club Cigarette</a></li>';
  echo '<li><a href="index.php?page=register">Join the Club</a></li>';
  echo '<li><a href="index.php?page=content_products">The Boutique</a></li>';
  echo '</ul>
        </nav>';
}
class Database{
    public static function connect(){
        $dsn = 'mysql:dbname=cigclubdb;host=127.0.0.1';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo 'Connexion echouee : ' . $ex->getMessage();
            exit(0);
        }
        return $dbh;
        
    }
}

?>

