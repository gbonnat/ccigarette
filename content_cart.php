<script type="text/javascript">
    $(document).ready(function() {

        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#up').fadeIn();
            } else {
                $('#up').fadeOut();
            }
        });

        $('#up').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 1500);
            return false;
        });

    });
</script>

<center>
    <h2>Here is what is in your cart</h2>
</center>
    
    <?php
require_once('Cart.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (Cart::getCart()==null){
    echo "Erreur - Vous n'avez pas de panier";
    //n'est jamais sensé l'afficher puisque le panier est créé au moment où l'on se register
}

if (cartProduct::getCartContent(Cart::getCart()->id)==null){
        echo "Your cart is enpty now, check the amazing products in the boutique!";
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
     
                <div class="product_label">
                    <h3>$Z->number   $product->product</h3>
                </div>
            
                <div class="image_box">
                    <div id="zoombox">
                        <img src="images/products/product$Z->idProduct.jpg">
                    </div>
                </div>
            
            <form action="index.php?todo=deleteProduct&page=content_cart&id_product=$Z->idProduct&id_cart=$id_cart->id" method="POST">
                <input type="submit" value="Delete from cart" class='buttons'>
            </form>
                    
        </div>
            
CHAIN;
}
   echo <<<CHAIN
    <div style="width: 912px; display: inline-block;">
        <center><h3></h3></center>
        <form action="index.php?todo=deleteAllProduct&page=content_cart&id_cart=$id_cart->id" method="POST">
        <input type="submit" value="Empty cart" class='buttons'>
        </form>
           
    </div>
CHAIN;
}
?>
