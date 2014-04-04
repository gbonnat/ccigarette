<?php

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
    
    function cancelCart() {
        // Update stock
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
}
}
