<h2>Voici le contenu de votre panier !</h2>
    
    <?php
require_once('Cart.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (Cart::getCart()==null){
    echo "Votre panier est vide";
}
else{
// renvoie l'id du panier de l'utilisateur connecté. 
    $id_cart = Cart::getCart();
// renvoie un tableau des ids produits dans le panier de l'utilisateur connecté.        
     $product_list = array();
     $product_list = cartProduct::getCartContent($id_cart->id);
     
   //renvoie la taille du tableau
     
   $taille=count($product_list);
   
   //affiche tous les éléments du panier
   
   $i=0;
   While ($taille>0){
       
     $Z= $product_list[$i];
     $i++;
     $product = Product::getProduct($Z->idProduct);
     $taille=$taille-1;   
     
    echo <<<CHAIN
            <div class="product_box">
                <div class="image_box">
                    
                    <h3>Vous avez    $Z->number   $product->product dans votre panier</h3>
                    <img src="images/products/product$Z->idProduct.jpg">
                    <form action="index.php?todo=deleteProduct&page=content_cart&id_product=$Z->idProduct&id_cart=$id_cart->id" method="POST">
                    <input type="submit" value="Supprimer ce produit du panier" class='buttons'>
                    </form>
    
                </div>
            </div>
            
CHAIN;
}
   echo <<<CHAIN
<form action="index.php?todo=deleteAllProduct&page=content_cart&id_cart=$id_cart->id" method="POST">
<input type="submit" value="Vider mon panier" class='buttons'>
</form>
CHAIN;
}
?>


<input type = 'button' name = 'Procéder au paiement' value = "Procéder au paiement" onclick =  >