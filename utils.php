<?php

function generateHTMLHead($title, $styleSheet) {
    echo <<<CHAINE_DE_FIN
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Nom de l'auteur"/>
        <meta name="keywords" content="Mots clefs relatifs à cette page"/>
        <meta name="description" content="Descriptif court"/>
        <link rel="stylesheet" type="text/css" href="$styleSheet" />
        <title>$title</title>
    </head>               
CHAINE_DE_FIN;
}

function generateHTMLHeader($pageTitle) {
    echo '<header id="entete">
            <h1>'.$pageTitle.'</h1>
            <p>Détails supplémentaires</p>
        </header>';
        
    generateMenu();
}

function generateHTMLFooter() {
    echo "<footer>" . PHP_EOL;
    echo "<p>Designed by Grégoire Bonnat</p>" . PHP_EOL;
    echo "<div id='logos'>" . PHP_EOL;
    echo "<a href='https://www.facebook.com/gregoire.bonnat'>
                        <img src='fb.png' class='logo'>
                    </a>" . PHP_EOL;
    echo "<a href='https://twitter.com/GBonnat'>
                        <img src='twitter.png' class='logo'>
                    </a>" . PHP_EOL;
    echo "<a href='http://www.linkedin.com/pub/gr%C3%A9goire-bonnat/82/a98/ba2'>
                        <img src='linkedin.png' class='logo'>
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
        var_dump($page);
        return $page->title;
    }
    
    return false;
  }
}

function generateMenu(){
    $xml = simplexml_load_file("pages.xml");
 
  $tabPages = $xml->page;
 
  echo '<nav id="menu">
            <ul>';
  
  foreach($tabPages as $page){
      echo '<li><a href="index.php?page='.$page->name.'">'.$page->title.'</a></li>';
     
  }
    
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


class User{
    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $naissance;
    public $email;
    public $feuille;
    
    public function __toString(){
        return $this->nom;
    }
    
    public static function insertUser($login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $feuille) {

        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `users`(`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `feuille`) VALUES(?,SHA1(?),?,?,?,?,?,?)");
        $sth->execute(array($login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $feuille));
        $dbh = null;
    }

    public function testerMDP($mdp){
        return $this->mdp == sha1($mdp);
    }

    
    public function updateMDP($mdp){
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE Users SET mdp=sha1(?) WHERE login=?");
        $sth->execute(array($mdp,$this->login));
    }

    
    public static function getUser($login){
        
        $dbh = Database::connect();
        $query = "SELECT * FROM Users WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS,'User');
        $sth->execute(array($login));
        $reponse = null;
        if ($sth->rowCount()>0){
            $reponse = $sth->fetch();
        }
        $sth->closeCursor();
        $dbh = null;
        return $reponse;

    }
}

?>

