<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Valider l'élève</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Ajouter un élève : </h1>
  <h2> Ajouter un élève ayant le même nom qu'un autre</h2>
  <?php
  // mise en place de la date
  date_default_timezone_set('Europe/Paris');
  $date = date("Y-m-d");

  //connexion à la base de données
  include("connexion.php");

  // récupération des informations du formulaire
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $datenais = $_POST['datenais'];

  // pas de vérifiaction pour savoir si les données ont été rentrées, elles le sont obligatoirement grâce à ajouter_eleve.php

  //permet l'utilisation des caractères spéciaux
  $nom = mysqli_real_escape_string($connect, $nom);
  $prenom = mysqli_real_escape_string($connect, $prenom);

  // insère l'élève dans la table
  $query = "INSERT INTO eleves VALUES (NULL,'$nom', '$prenom', '$datenais', '$date')";
  $result = mysqli_query($connect, $query);

  if (!$result){
    echo "<p>La requête n'a pas pu aboutir :</p>".mysqli_error($connect);
  }

  else{ // la requête s'est bien déroulée
    echo "<p>L'élève $nom $prenom né(e) le $datenais a bien été ajouté(e).</p>";
  }

  // boutons pour naviguer entre les pages
  echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
  echo "<input type='button' onclick=\"window.location='ajouter_eleve.html'\" value='Ajouter un autre élève' />";

  mysqli_close($connect);
  ?>
</body>
</html>
