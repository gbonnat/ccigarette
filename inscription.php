<!DOCTYPE html>
 
<html>
 
<head>
  <title>formulaire1</title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>
 
<body>
  <h1>Inscription !</h1>
  
 <?php
  if(isset($_GET["nom"]) && $_GET["nom"] != "" && isset($_GET["genre"])) {
    echo "Bonjour", " ";
    if ($_GET["genre"] == "mme") echo "Mme " ;
    if ($_GET["genre"] == "m") echo "M. " ;
    if ($_GET["genre"] == "mlle") echo "Mlle " ;
  echo $_GET["prenom"] . " !";
  } else {
  
      ?>
  <form method="get">
    <p>Civilité :
      <input name="genre" value="m" type="radio" checked="true" required />M.
      <input name="genre" value="mme" type="radio" required />Mme
      <input name="genre" value="mlle" type="radio"  required/>Mlle
     </p>
    <p>Prénom : <input type="text" name="prenom" required /> *</p>
    <p>Nom : <input type="text" name="nom" required /> *</p>
    <p>Code postal : <input type="number" name="code postal" required /> *</p>   
    <p>email : <input type="email" name="email" required /> *</p>
    <p>Mot de passe : <input type="password" name="password" required /> *</p>
    
    <p><input type="submit" value="Valider" /></p>
  </form>
    <?php
    
    
    
  }
  ?>
</body>
 
</html>