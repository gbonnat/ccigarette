<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
        require('utils.php');
        require_once ('printForms.php');
        
//        if(array_key_exists('taille',$_GET)){
//                $dim=$_GET['taille'];
//        }
        
        if(array_key_exists('page',$_GET)){
                $askedPage=$_GET['page'];
        }
        else {$askedPage="content_home";}
        
        $authorized = checkPage($askedPage);
        
        if($authorized){
            $pageTitle=  getPageTitle($askedPage);
        }
        else{$pageTitle='Erreur';}
        generateHTMLHead($pageTitle, 'style.css');
        
        printLoginForm($askedPage);
    ?>
    <body>
        <?php
            generateHTMLHeader($pageTitle);
        ?>
        
        <div id="content">
            <?php
                if($authorized){
                    require($askedPage.'.php');
                }
                else{
                    echo "<p>Vous n'avez pas accès à cette partie du club</p>";
                }
            ?>
        </div>
    </body>
    
    <?php
        generateHTMLFooter();
    ?>
</html>
