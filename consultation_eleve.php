<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter un thème</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Consulter les informations d'un élève : </h1>
  <h2> Sélectionnez un élève à consulter </h2>
  <?php
  // connexion à la base de données
  include("connexion.php");

  // sélection de tous les élèves pour les afficher
  $query = "SELECT * FROM eleves ORDER BY nom";
  $result = mysqli_query($connect, $query);

  if (!$result){
    echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
    exit;
  }

  // mise en place d'un formulaire qui affiche tous les élèves
  echo "<FORM METHOD='POST' ACTION='consulter_eleve.php'";
  echo "<label for='ideleve' class='label'>Veuillez sélectionner un élève</label><br>";
  echo "<select name='ideleve' id='ideleve' size='4'>";

  while($row = mysqli_fetch_array($result, MYSQLI_NUM)){ // pour chaque élève dans la base
    echo "<option value=$row[0]>$row[1] $row[2], né.e le $row[3]</option>";
  }
  echo "</select>";

  echo "<br>";
  echo "<input type='submit' value='Consulter cet élève'>";

  echo "</FORM>";

  mysqli_close($connect);
  ?>
</body>
</html>
