<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Grégoire
 */
class User{
    public $email;
    public $password;
    public $title;
    public $nom;
    public $prenom;
    public $naissance;
    
    public function __toString(){
        return $this->nom;
    }
    
    public static function insertUser($email, $password, $title, $nom, $prenom,$naissance) {

        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `users`(`email`, `password`, `title`, `nom`, `prenom`, `naissance`) VALUES(?,SHA1(?),?,?,?,?)");
        $sth->execute(array($email, $password, $title, $nom, $prenom, $naissance));
        $dbh = null;
    }

    public function testerMDP($password){
        return $this->password == sha1($password);
    }

    
    public function updateMDP($password){
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE Users SET password=sha1(?) WHERE email=?");
        $sth->execute(array($password,$this->email));
    }

       public static function newUser($login){
        if (User::getUser($login)==null) return true;
        else return false;
    }
    
    public static function getUser($email){
        
        $dbh = Database::connect();
        $query = "SELECT * FROM Users WHERE email=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS,'User');
        $sth->execute(array($email));
        $reponse = null;
        if ($sth->rowCount()>0){
            $reponse = $sth->fetch();
        }
        $sth->closeCursor();
        $dbh = null;
        return $reponse;

    }
    
    public static function register(){
    if(isset($_POST["email"]) && $_POST["email"] != "" &&
    isset($_POST["up"]) && $_POST["up"] != "" &&
    isset($_POST["up2"]) && $_POST["up2"] != "" &&
    isset($_POST["title"]) && $_POST["title"] != "" &&        
    isset($_POST["prenom"]) && $_POST["prenom"] != "" &&
    isset($_POST["nom"]) && $_POST["nom"] != "" &&
    isset($_POST["naissance"]) && $_POST["naissance"] != "" &&
    $_POST["up"]==$_POST["up2"]){
        if  (User::insertUser($_POST["email"],$_POST["up"],$_POST["title"],$_POST["prenom"],$_POST["nom"],$_POST["naissance"])){
            $_SESSION['loggedIn'] = true;
            }
        else {
            echo "<p> error, login already exists, unmatching passwords </p>";
            header('Location: register.php');
            exit();
            }
    } else {echo "ERRRRRRRRRRRRRRRRREEUUUR"; exit();}
   
 }
 
  public static function changepassword(){
     if (!estConnecte()){
    echo <<<END
    <p> Vous devez etre connecté pour avoir accès à la page de changement de mot de passe</p>
END;
    }

    else{
    if(isset($_POST["email"]) && $_POST["email"] != "" &&
    isset($_POST["up"]) && $_POST["up"] != "" &&
    isset($_POST["up1"]) && $_POST["up1"] != "" &&
    isset($_POST["up2"]) && $_POST["up2"] != "" &&
    (!User::nouvelUtilisateur($_POST["login"])|| $_SESSION['loggedIn'])&&
    $_POST["up1"]==$_POST["up2"]&&
    User::testerMdp($_POST["login"],$_POST["up"])){
        User::updateMDP($_POST["up2"],$_POST["login"]);
    }
    }
}
    
}
