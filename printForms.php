<?php

function printLoginForm($askedpage){
    echo<<<FIN
    <form action="index.php?todo=login&page=$askedpage" method="POST">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="mot de passe">
        <input type="submit" value="login">
        <a href="index.php?&page=register">M'incrire!</a>
    </form>
FIN;
}

function printLogoutForm($askedpage){
    echo<<<FIN
    <a href="index.php?todo=logout&page=$askedpage">Logout</a>
FIN;
}

?>