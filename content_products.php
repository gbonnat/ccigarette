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

<h2>Discover our selection of amazing products</h2>

<?php

    for ($id = 1; $id <= 4; $id++) {
        $cig = Product::getProduct($id);
        
        echo <<<CHAIN
            <div class="product_box">
                <div class="image_box">
                    <h3>$cig->product</h3>
                    <h3>For only $cig->price € !</h3>
                    <img src="images/products/product$id.jpg">
                    <input type="button" value="Buy">
                </div>
            </div>
            
CHAIN;
        
    }


?>

<a href="#" id="scrollup"><img src="images/up.png" id='up'></a>