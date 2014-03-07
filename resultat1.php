<!DOCTYPE html>

<html>

<head>
  <title>inscription</title>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>

<body>
  <p>Formulaire soumis.</p>

  <p>
  <?php
  echo "Bonjour", " ";
    if ($_GET["genre"] == "mme") echo "Mme " ;
    if ($_GET["genre"] == "m") echo "M. " ;
    if ($_GET["genre"] == "mlle") echo "Mlle " ;
  echo $_GET["prenom"] . " !";
  ?>
  </p>
</body>

</html>