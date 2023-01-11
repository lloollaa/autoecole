<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Désinscription séance</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Désinscrire un élève d'une séance </h1>
  <h2> Désinscription de l'élève à la séance demandée </h2>
  <?php
  //connexion à la base de données
  include("connexion.php");

  //transmission de sdonnées du formulaire
  $ideleve = $_POST["ideleve"];
  $idseance = $_POST["idseance"];

  //vérification de la saisie des données
  if (empty($idseance)){
    echo "<p>Il faut sélectionner une séance ! </p>";
  }

  else{ // si les données ont bien été tranmises
    //suppression de l'inscription
    $query = "DELETE FROM inscription WHERE ideleve='$ideleve' AND idseance='$idseance'";
    $result = mysqli_query($connect, $query);

    if (!$result){
      echo "<p> La requête n'a pas pu aboutir.</p>".mysqli_error($connect);
    }
    else{
      echo "<p>L'élève a bien été désinscrit de la séance !</p>";
    }
  }

  // boutons pour aller à l'accueil ou désinscrire un autre élève
  echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
  echo "<input type='button' onclick=\"window.location='desinscription_seance.php'\" value='Désinscrire un autre élève' />";;

  mysqli_close($connect);
  ?>
</body>
</html>
