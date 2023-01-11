<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajout d'une séance</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1>Création d'une nouvelle séance</h1>
  <h2>Merci de rentrer les informations demandées</h2>
  <?php
  //connexion à la base de données
  include("connexion.php");

  //sélection et affichage des thèmes actifs
  $query = "SELECT * FROM themes where supprime ='0'";
  $result = mysqli_query($connect, $query);

  if (!$result){
    echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
    exit;
  }

  // select qui affiche les thèmes
  echo "<FORM METHOD='POST' ACTION='ajouter_seance.php' >";
  echo "<label for='menuChoixTheme'>Thème de la séance :</label><br>";
  echo "<select name='menuChoixTheme' id='menuChoixTheme' size='4'>";
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<option value=$row[0]>".$row[1]."</option>";
       }
  echo "</select>";
  echo "<br><br>";

  //affichage du formulaire pour la séance
  echo "<label for='datese'> Date de la séance :</label>";
  echo "<br>";
  echo "<input type='date' name='datese' id='datese' min='2022-01-01'>";
  echo "<br><br>";
  echo "<label for='effmax'>Effectif maximum de la séance:</label><br>";
  echo "<input type='number' min='1' id='effmax' name='effmax'><br>";
  echo "<INPUT type='submit' value='Enregistrer séance'>";
  echo "</FORM>";

  mysqli_close($connect);
  ?>
</body>
</html>
