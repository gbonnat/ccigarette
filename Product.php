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
        $dbh = Database::connect();
        
        $query = "SELECT * FROM Carts WHERE user=?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($_SESSION['email']));       
        $reponse = null;
        if ($sth->rowCount()>0){
            $reponse = $sth->fetch();
        }
        //var_dump($_SESSION['email']);
        
        $id_cart=$reponse["id"];
        $id_product=filter_input(INPUT_GET, 'id_product');
        
        $query2 = "SELECT * FROM cartcontent WHERE idCart=? and idProduct=?";
        $sth2 = $dbh->prepare($query2);
        $sth2->execute(array($id_cart,$id_product));       
        $reponse2 = null;
        if ($sth2->rowCount()>0){
            $reponse2 = $sth2->fetch();
        }
        
        if ($reponse2 == null){
        $query3 = "INSERT INTO Cartcontent(idCart,idProduct,number) VALUES (?,?,1)";
        $sth3 = $dbh->prepare($query3);
        $sth3->execute(array($id_cart,$id_product));       

        return ($sth3->rowCount()>0);
        }
        else{
        $query4 = "UPDATE cartcontent SET number=? WHERE idCart=$id_cart and idProduct=$id_product";    
        $sth4 = $dbh->prepare($query4);
        $newNumber = $reponse2["number"]+1;
        $sth4->execute(array($newNumber));       

        return ($sth4->rowCount()>0);
                
        }

    }

    
}



