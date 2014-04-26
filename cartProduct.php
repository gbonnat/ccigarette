<?php
require_once('Product.php');
require_once('Cart.php');

class cartProduct{
    public $idCart;
    public $idProduct;
    public $number;
    
        public static function getCartContent($id_cart){
        $dbh = Database::connect();    
        $query = "SELECT * FROM cartcontent WHERE idCart=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS,'cartProduct');
        $sth->execute(array($id_cart));       
        $reponse = array();
        
        while ($myobj = $sth->fetch()){
            array_push($reponse, $myobj);
            
        }
        $sth->closeCursor();
        $dbh = null;
        return $reponse;
        
       }
       //supprime le produit sélectionné de la base cartProduct
       public static function deleteProduct(){
       $dbh = Database::connect(); 
       $query = "DELETE FROM cartcontent WHERE idCart=? and idProduct=?";
       $sth = $dbh->prepare($query);
       $sth->setFetchMode(PDO::FETCH_CLASS,'cartProduct');       
       $sth->execute(array($_GET['id_cart'],$_GET['id_product']));       
       }
       
       //supprime tous les produits du panier correspondant sans supprimer le panier. Celui-ci sera vide.
       public static function deleteAllProduct(){
       $dbh = Database::connect();
       $query = "DELETE FROM cartcontent WHERE idCart=?";
       $sth = $dbh->prepare($query);
       $sth->setFetchMode(PDO::FETCH_CLASS,'cartProduct');  
       $sth->execute(array($_GET['id_cart'])); 
       }
}
?>