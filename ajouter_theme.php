<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter un thème</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Ajouter un thème : </h1>
  <h2> Ajout du thème </h2>
  <?php

  //connexion à la base de données
  include("connexion.php");

  //transmission des données du formulaire
  $nom = $_POST['theme'];
  $descrip = $_POST['descri'];

  //permet l'utilisation des caractères spéciaux
  $nom = mysqli_real_escape_string($connect, $nom);
  $descrip = mysqli_real_escape_string($connect, $descrip);

  //vérification de la saisie des données
  if(empty($nom) || empty($descrip)){
    echo "<p>Un champ est vide</p>";
    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo "<input type='button' onclick=\"window.location='ajout_theme.html'\" value='Enregistrer un autre thème' />";
    exit;
  }

  $verif1 = "SELECT * FROM themes WHERE nom = '$nom' and supprime = '0'";
  $result1 = mysqli_query($connect, $verif1);

  $verif2 = "SELECT * FROM themes WHERE nom = '$nom' and supprime = '1'";
  $result2 = mysqli_query($connect, $verif2);

  if (!$result1){
    echo "<p>La requête 1 n'a pas pu aboutir</p>".mysqli_error($connect);
    exit;
  }

  if (!$result2){
    echo "<p>La requête 2 n'a pas pu aboutir</p>".mysqli_error($connect);
    exit;
  }

  // Le thème existe déjà dans les thèmes actifs
  if (mysqli_num_rows($result1) > 0)  {
    echo "<p>Le thème $nom existe déjà, vous ne pouvez pas le rajouter.</p>";
    }

  else{ //le thème n'est pas dans les thèmes actifs
    if (mysqli_num_rows($result2) > 0)  { //le thème est dans les thèmes désactivés
      echo "<p>Le thème $nom existait et a été supprimé, il va être réactualisé.</p>";
      $query3 = "UPDATE themes SET supprime = '0' where nom = '$nom'";
      $result3 = mysqli_query($connect, $query3);

      if (!$result3){
        echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
      }
    }
    else{ //le thème n'est ni dans les thèmes actifs ni dans les thèmes désactivés
      $query = "INSERT INTO themes VALUES (NULL,'$nom', '0', '$descrip')";
      $result = mysqli_query($connect, $query);
      if (!$result){
        echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
      }
      else{
        echo "<p>Le thème '$nom' a bien été rajouté.</p>";
      }
    }
  }

  //boutons pour naviguer entre les pages
  echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
  echo "<input type='button' onclick=\"window.location='ajout_theme.html'\" value='Enregistrer un autre thème' />";

  mysqli_close($connect);
  ?>
</body>
</html>
