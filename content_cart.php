<h2>Voici le contenu de votre panier !</h2>
    
    <?php
require_once('Cart.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<input type = 'button' name = 'Vider mon panier' value = "Vider mon panier" onclick = "Cart::cancelCart()" >