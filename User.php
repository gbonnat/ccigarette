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
    public $mdp;
    public $title;
    public $nom;
    public $prenom;
    public $naissance;
    
    public function __toString(){
        return $this->nom;
    }
    
    public static function insertUser($email, $mdp, $title, $nom, $prenom,$naissance) {

        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `users`(`email`, `mdp`, `title`, `nom`, `prenom`, `naissance`) VALUES(?,SHA1(?),?,?,?,?)");
        $sth->execute(array($email, $mdp, $title, $nom, $prenom, $naissance));
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
}
