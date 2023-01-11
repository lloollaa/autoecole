<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscrire élève</title>
    <link rel="stylesheet" href="projet.css">
  </head>
  <body>
    <h1>Inscription d'un élève à une séance</h1>
    <h2>Inscription de l'élève</h2>
    <?php

    //connexion à la base de données
    include("connexion.php");

    //transmission des informations du formulaire
    $idseance = $_POST['choixseance'];
    $ideleve = $_POST['choixeleve'];

    //vérification de la saisie des informations
    if (empty($idseance) || empty($ideleve)){
      echo "<p>Un champ est vide.</p>";
      echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo "<input type='button' onclick=\"window.location='inscription_eleve.php'\" value='Enregistrer un autre élève' />";
      exit;
    }

    // sélection de la bonne séance pour vérifier l'effectif
    $query1 = "SELECT * FROM seances WHERE idseance = '$idseance'";
    $result1 = mysqli_query($connect, $query1);
    if(!$result1){
      echo "<p>La requête 1 n'a pas pu aboutir : </p>".mysqli_error($connect);
      exit;
    }

    while ($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)){
      $effmax = $row1[2]; // on met l'effectif maximal dans une variable
      // sélection de toutes les inscriptions à la séance
      $query2 = "SELECT * FROM inscription WHERE idseance ='$idseance'";
      $result2 = mysqli_query($connect, $query2);
      if(!$result2){
        echo "<p>La requête 2 n'a pas pu aboutir : </p>".mysqli_error($connect);
        exit;
      }

      if (mysqli_num_rows($result2) >= $effmax){ // la valeur de l'effectif maximum a été atteinte
        echo "<p>Cette séance est déjà complète, l'élève ne peut pas s'y inscrire.</p>";
      }
      else{
        while ($row2 = mysqli_fetch_array($result2, MYSQLI_NUM)){
          if ($row2[1] == $ideleve){ // l'id de lélève est déjà présent dans l'inscription
            echo "<p>Cet élève est déjà inscrit à cette séance, il ne peut donc pas s'y inscrire une autre fois.</p>";
            exit;
          }
        }
          // l'élève peut être inscrit
          $query3 = "INSERT INTO inscription VALUES('$idseance', '$ideleve', -1)";
          $result3 = mysqli_query($connect, $query3);
          if(!$result3){
            echo "<p>La requête 3 n'a pas pu aboutir : </p>".mysqli_error($connect);
          }
          else{
            echo "<p>L'élève a été inscrit à la séance.</p>";
          }
        }
      }

    // boutons pour naviguer dans le site
    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo "<input type='button' onclick=\"window.location='inscription_eleve.php'\" value='Enregistrer un autre élève' />";


    mysqli_close($connect);
    ?>
  </body>
</html>
