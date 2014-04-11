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
     $cart_id = Cart::getCart();
        
     $product_id = cartProduct::getCartContent($cart_id->id);
     
     $product = Product::getProduct($product_id->idProduct);
        
    echo <<<CHAIN
            <div class="product_box">
                <div class="image_box">
                    <h3>$product->product</h3>
                    <h3>quantité $product_id->number  !</h3>
                    <img src="images/products/product$product_id->idProduct.jpg">
                    
                </div>
            </div>
            
CHAIN;
}
?>

<input type = 'button' name = 'Vider mon panier' value = "Delete" onclick = "Cart::cancelCart()" >