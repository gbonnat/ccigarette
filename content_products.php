<h2>Discover our selection of amazing products</h2>

<?php

    for ($id = 1; $id <= 4; $id++) {
        $cig = Product::getProduct($id);
        
        echo <<<CHAIN
            <div class="product_box">
                <div class="image_box">                   
                    <img src="images/products/product$id.jpg">
                </div>
            </div>
            
CHAIN;
        
    }
    
    
    


?>
