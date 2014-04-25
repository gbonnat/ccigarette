<?php
require_once('Product.php');
require_once('Cart.php');

class cartProduct{
    public $idProduct;
    public $number;
    
        public static function getCartContent($cart_id){
        $dbh = Database::connect();    
        $query = "SELECT * FROM cartcontent WHERE idCart=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS,'cartProduct');
        $sth->execute(array($cart_id));       
        $reponse = array();
        
        while ($myobj = $sth->fetch()){
            array_push($reponse, $myobj);
            
        }
        $sth->closeCursor();
        $dbh = null;
        return $reponse;
        
       }
}
?>