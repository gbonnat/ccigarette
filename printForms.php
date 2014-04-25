<?php

function printLoginForm($askedpage){
    echo<<<FIN
    <form action="index.php?todo=login&page=$askedpage" method="POST" class='login'>
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="mot de passe">
        <input type="submit" value="login" id="login_btn">
        <a href="index.php?&page=register" class="login_text">Sign up!</a>
    </form>
FIN;
}

function printLogoutForm($askedpage){
    echo<<<FIN
    <a href="index.php?todo=logout&page=$askedpage">Logout</a>
FIN;
}

?>