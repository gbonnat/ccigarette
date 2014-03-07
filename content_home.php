<h2>
    Bienvenue au club. 
</h2>

<h3>Attention, ici on est très sélect</h3>
<p>Nous avons un superbe choix d'e-cigarettes, des roses, des bleues, des vertes...</p>

<?php

    User::insertUser('1@gmail.com', '0000', 'M', 'NOM', 'PRENOM', '2000-01-01');

    $guy = User::getUser("1@gmail.com");
    echo "Bonjour $guy->prenom $guy->nom <br>";
//    $guy->updateMDP("test");
//    var_dump($guy);
    if($guy->testerMDP("0000")){
        echo "mot de passe valide !";
    }
    else
        echo "mot de passe invalide";

?>