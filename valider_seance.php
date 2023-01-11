<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Valider la séance</title>
    <link rel="stylesheet" href="projet.css">
  </head>
  <body>
    <h1> Validation d'une séance passée</h1>
    <h2>Notez les élèves pour la séance sélectionnée</h2>
    <?php
    // connexion à la base de données
    include("connexion.php");

    //transmission des données
    $seance = $_POST['choixseancefaite'];

    // vérification de la saisie des données
    if (empty($seance)){
      echo "<p> Il faut  sélectionner une séance</p>";
      echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Valider une séance' />";
      exit;
    }

    // sélection des inscription de la séance
    $query1 = "SELECT * FROM inscription INNER JOIN eleves ON inscription.ideleve = eleves.ideleve WHERE inscription.idseance = '$seance'";
    //renvoie idseance ideleve note ideleve nom prenom datenaiss
    $result1 = mysqli_query($connect, $query1);

    if (!$result1){
      echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
      echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Valider une séance' />";
      exit;
    }

    if (mysqli_num_rows($result1) == 0){ // il n'y a pas d'élèves inscrits
      echo "<p> Aucun élève n'est inscrit à cette séance</p>";
    }
    else { // il y a des élèves inscrits
      //formulaire qui affiche les élèves 1 par 1 avec leur note
      echo "<FORM ACTION='noter_eleves.php' METHOD='POST'>";
      echo "<br><table class='table' border=1>";
      echo "<tr> <th>Nom:</th> <th>Prénom:</th> <th>Nombre de fautes:</th> </tr>";
      while ($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)){ // pour chaque élève inscrit
          echo "<input type='hidden' value='$row1[1]' name='ideleve_$row1[1]'>"; // transmet l'id de l'élève pour le traitement des informations
          echo "<tr>";
          echo "<td> $row1[4]</td>";
          echo "<td> $row1[5]</td>";
            if($row1[2] == -1){ // si l'élève n'est pas encore noté, le champ est vide
              echo "<td><input type='number' name='nbfautes_$row1[1]' min='0' max='40' id='nombre'></td>";
            }
            else{ //si l'élève est noté, on affiche sa note
              $fautes = 40 - $row1[2];
              echo "<td><input type='number' name='nbfautes_$row1[1]' min='0' max='40' id='nombre' value='$fautes'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        //transmission de l'id de la séance pour le traitement en php
        echo "<input type='hidden' name='id_seance' value='$seance'>";
        echo "<br>";
        echo "<input type='submit' value='Valider les notes pour cette séance'>";
        echo "</FORM>";
      }

    //boutons pour naviguer entre les séances
    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Valider une autre séance' />";

    mysqli_close($connect);

     ?>

  </body>
</html>
