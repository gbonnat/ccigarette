<?php

require_once('utils.php');
$form_values_valid=false;
generateHTMLHeader("register", "utilities/defi5.css");

echo<<<lapin
  <section id="newregistry">
  <h1>Become a member !</h1>
  <form action="index.php?todo=register" method=post 
       oninput="up2.setCustomValidity(up2.value != up.value ? 'Passwords do not match.' : '')">
       
     <p>
<label for="Email">Email:</label>
 <input id=" Email" type=text required size="35" maxlength="35" name=email placeholder="Email" >
</p>
  <p>
<label for="password1">Password:</label>
 <input id="password1" type=password required size="31" maxlength="31" name=up placeholder="Password">
</p>
  <p>
<label for="password2">Confirm Password:</label>
 <input id="password2" type=password name=up2 placeholder="Confirm Password" >
</p>
<p>
<label for="Gender">Gender:</label>
<input name="title" value="f" type="radio" checked="checked" required />F
      <input name="title" value="m" type="radio" />M
    </p>
  <p>
<label for="First Name">First Name:</label>
 <input id="First Name" type=text required size="30" maxlength="30" name=prenom placeholder="First Name" >
</p> 
  <p>
<label for="Family Name">Family Name:</label>
 <input id="Family Name" type=text required size="27" maxlength="27" name=nom placeholder="Family Name">
</p>
  <p>
<label for="Date of Birth">Date of Birth:</label>
 <input id="Date of Birth" type=date required name=naissance placeholder="Dare of Bith">
</p>
<p>
    <input type=submit value="Create account">
</p>
</form>
</section>
</body>
</html>
lapin;


?>