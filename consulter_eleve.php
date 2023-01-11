<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter un thème</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Consulter les informations d'un élève : </h1>
  <h2>Informations de l'élève</h2>
  <?php
  //connexion à la base de données
  include("connexion.php");

  //transmission des données du formulaire
  $ideleve = $_POST["ideleve"];

  //vérification des données
  if (empty($ideleve)){
    echo "<p>Il faut sélectionner un élève !</p>";
    exit;
  }

  //sélection de l'élève demandé
  $query = "SELECT * FROM eleves WHERE ideleve = '$ideleve'";
  $result = mysqli_query($connect, $query);
  if (!$result){
    echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo "<input type='button' onclick=\"window.location='consultation_eleve.php'\" value='Consulter un autre élève' />";
    exit;
  }

  //affichage des informations de l'élève dans un tableau
  echo "<table class='table'>";
  echo "<tr> <th>ID</th> <th>Nom</th> <th>Prénom</th> <th>Date de naissance</th> <th>Date d'inscription</th></tr>";
  while($row = mysqli_fetch_array($result, MYSQLI_NUM)){ // affiche chaque information de l'élève
    echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
    echo "<td>$row[3]</td>";
    echo "<td>$row[4]</td>";
    echo "</tr>";
  }
  echo "</table>";

  mysqli_close($connect);

  ?>
</body>
</html>
