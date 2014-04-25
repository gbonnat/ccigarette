<?php
class Product{
    public $id;
    public $product;
    public $price;
    public $stock;
    
    
    public static function getProduct($id){
        $dbh = Database::connect();
        $query = "SELECT * FROM Products WHERE id=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS,'Product');
        $sth->execute(array($id));       
        $reponse = null;
        if ($sth->rowCount()>0){
            $reponse = $sth->fetch();
        }
        $sth->closeCursor();
        $dbh = null;
        return $reponse;
    }
    
    public static function add_to_cart(){
        //use $_GET['id_product'], $_SESSION['email']
        //checkout logInOut.php functions for comparison
    }

    
}



