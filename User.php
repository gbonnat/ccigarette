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
        if (User::getUser($email)==NULL){
            $query = "INSERT INTO Users(email,password,title,nom,prenom,naissance) VALUES (?,SHA1(?),?,?,?,?)";
            $sth = $dbh->prepare($query);
            $sth->execute(array($email,$password,$title,$nom,$prenom,$naissance));
            return ($sth->rowCount()>0);
        }
        else{
            return false;
        }
    }

    public function testerMDP($password){
        return $this->password == sha1($password);
    }

    
    public function updateMDP($password){
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE Users SET password=sha1(?) WHERE email=?");
        $sth->execute(array($password,$this->email));
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
