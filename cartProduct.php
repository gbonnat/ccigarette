<?php
require_once('Product.php');
require_once('Cart.php');

class cartProduct{
    public $idCart;
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
       public static function deleteProduct($cart_id,$idProduct){
       $dbh = Database::connect(); 
       $query = "DELETE FROM cartcontent WHERE idCart=? and idProduct=?";
       $sth = $dbh->prepare($query);
       $sth->setFetchMode(PDO::FETCH_CLASS,'cartProduct');       
       $sth->execute(array($cart_id,$idProduct));       
       }
}
?>