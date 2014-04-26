

<?php
require_once('User.php');

class Cart{
    public $id;
    
    function checkAndUpdate(){
        $dbh = Database::connect();
        $query = "UPDATE Cart SET timeStamp=NOW() WHERE id='$this->id' "
                . "AND timeStamp> (NOW() - INTERVAL 15 MINUTE)";
        $sth = $dbh->prepare($query);
        $sth ->execute();
        if ($sth->rowCount() == 1) return true;
        else{
        $this->cancelCart();
        return false;
        }

    }
       public static function getCart(){
        $dbh = Database::connect();
        $query = "SELECT * FROM carts WHERE user=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS,'Cart');
        $sth->execute(array($_SESSION['email']));       
        $reponse = null;
        if ($sth->rowCount()>0){
            $reponse = $sth->fetch();
        }
        $sth->closeCursor();
        $dbh = null;
        return $reponse;
    }
    
     public static function createCart($email){
           $dbh = Database::connect();
            $query = "INSERT INTO Carts(id,user,timestamp) VALUES ('',?,15)";
            $sth = $dbh->prepare($query);
            $sth->execute(array($email));
            return ($sth->rowCount()>0);
        
     }
    
   

}

?>

