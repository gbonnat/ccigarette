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
    $cart_id = Cart::getCart();
// renvoie un tableau des ids produits dans le panier de l'utilisateur connecté.        
     $product_list = array();
     $product_list = cartProduct::getCartContent($cart_id->id);
     
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
                    <input type="button" value="Supprimer ce produit du panier">
                </div>
            </div>
            
CHAIN;
}
}
?>

<input type = 'button' name = 'Vider mon panier' value = "Vider mon panier" onclick = "Cart::cancelCart()" >
<input type = 'button' name = 'Procéder au paiement' value = "Procéder au paiement" onclick =  >