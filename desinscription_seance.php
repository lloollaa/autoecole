<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Désinscription séance</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Désinscrire un élève d'une séance </h1>
  <h2> Sélectionnez un élève à désincrire </h2>
  <?php
  //connexion à la base de données
  include("connexion.php");

  //sélection de tous les élèves
  $query = "SELECT * FROM eleves ORDER BY nom";
  $result = mysqli_query($connect, $query);

  if (!$result){
    echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
    exit;
  }

  // mise en place d'un formulaire qui affiche tous les élèves
  echo "<FORM METHOD='POST' ACTION='desinscrire_seance.php'";
  echo "<label for='ideleve' class='label'> Veuillez sélectionner un élève</label><br>";
  echo "<select name='ideleve' id='ideleve' size=4>";
  while($row = mysqli_fetch_array($result, MYSQLI_NUM)){ // affiche le nom prénom et date de  naissance de chaque élève
    echo "<option value=$row[0]>$row[1] $row[2], né.e le $row[3]</option>";
  }
  echo "</select>";
  echo "<br>";

  echo "<input type='submit' value='Désinscrire cet élève'>";
  echo "</FORM>";

  mysqli_close($connect);

  ?>
</body>
</html>
