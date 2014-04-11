

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
    

    function cancelCart() {
        // Update stock
        
        echo 'r';
        $query="UPDATE products as p, cartContent as c SET p.stock=p.stock+c.number WHERE 
        (c.idCart='$this->id') AND (p.id=p.idProduct)";
        $sth = $dbh->prepare($query);
        $sth ->execute();

        $query="DELETE FROM cartContent WHERE idCart='$this->id'";
        $sth = $dbh->prepare($query);
        $sth ->execute();
        

        $query = "DELETE FROM Cart WHERE id='$this->id'";
        $sth = $dbh->prepare($query);
        $sth ->execute();
        
        echo "Votre panier a bien été effacé!";
}
   

}

?>

