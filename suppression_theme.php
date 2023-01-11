<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Supprimer un thème</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Supprimer un thème </h1>
  <h2> Sélectionnez un thème à supprimer </h2>
  <?php
  // connexion à la base de données
  include("connexion.php");

  // sélection de tous les élèves pour les afficher
  $query = "SELECT * FROM themes WHERE supprime ='0' ORDER BY nom";
  $result = mysqli_query($connect, $query);

  if (!$result){
    echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
    exit;
  }

  // mise en place d'un formulaire qui affiche tous les thèmes
  echo "<FORM METHOD='POST' ACTION='supprimer_theme.php'";

  echo "<label for='idtheme' class='label'> Veuillez sélectionner un thème à supprimer</label><br>";
  echo "<select name='idtheme' id='idtheme' size=4>";
  while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
    echo "<option value=$row[0]>$row[1]</option>";
  }
  echo "</select>";
  echo "<br>";
  echo "<input type='submit' value='Supprimer ce thème'>";

  echo "</FORM>";

  mysqli_close($connect);

  ?>
</body>
</html>
