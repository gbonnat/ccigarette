<script type="text/javascript">
  $(document).ready(function () {

      $(window).scroll(function () {
          if ($(this).scrollTop() > 100) {
              $('#up').fadeIn();
          } else {
              $('#up').fadeOut();
          }
      });

      $('#up').click(function () {
          $("html, body").animate({
              scrollTop: 0
          }, 1500);
          return false;
      });

  });
</script>

<center>
    <h2>Discover our selection of amazing products</h2>
</center>

<?php

    for ($id = 1; $id <= 4; $id++) {
        $cig = Product::getProduct($id);
        
    echo <<<CHAIN
            <div class="product_box">
                <div class="product_label">
                    <h3>$cig->product</h3>
                    <h3>For only $cig->price € !</h3>
                </div>
                <div class="image_box">
                <div id="zoombox">
                    <img src="images/products/product$id.jpg">
                </div>
                    
                </div>
            <form action="index.php?todo=add_to_cart&page=content_cart&id_product=$id" method="POST">
                <input type="submit" value="Buy" class='buttons' >
            </form>
            </div>
            
CHAIN;
         if ($cig->stock == 0){
            echo "Produit non disponible";
        };   
    }


?>

<div><center>Up</center></div>
<a href="#" id="scrollup"><img src="images/up.png" id='up'></a>