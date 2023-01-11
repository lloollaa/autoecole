<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Noter élèves</title>
    <link rel="stylesheet" href="projet.css">
  </head>
  <body>
    <h1>Validation d'une séance passée<h1>
    <h2>Notation des élèves</h2>
    <?php
    // connexion à la base de données
    include("connexion.php");

    //transmission des informations
    $idseance = $_POST['id_seance'];

    //selection de l'inscription
    $query1 = "SELECT * FROM inscription WHERE idseance = '$idseance'";
    $result1 = mysqli_query($connect, $query1);

    if (!$result1){
      echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
      exit;
    }

    //sélection des élèves inscrits à cette séance
    while ($row1 = mysqli_fetch_array($result1, MYSQLI_NUM)){
      // il aurait fallu faire un code qui update la note si elle a déjà été rentrée mais qu'on la rentre une autre fois vide (qui retourne à -1)
        $nb_fautes = $_POST["nbfautes_$row1[1]"];
        if (empty($nb_fautes)){ // prévient si un élève n'a pas été noté
          echo "<p> Au moins un élève n'a pas été noté !</p>";
        }
        else{ // si le nombre de fautes a bien été rentré
          $ideleve = $_POST["ideleve_$row1[1]"];
          $note = 40 - $nb_fautes;

          // change la note dans la table inscription
          $query2 = "UPDATE inscription SET note = $note WHERE ideleve = '$ideleve' AND idseance = '$idseance'";
          $result2 = mysqli_query($connect, $query2);
          if (!$result2){
            echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
            echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
            echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Valider une séance' />";
            exit;
          }
        }
      }
      // message qui indique à l'utilisateur que la séance a été notée
      echo "<p>Les notes ont été mises à jour pour les élèves que vous avez notés</p>";

      //boutons pour naviguer entre les pages
      echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo "<input type='button' onclick=\"window.location='validation_seance.php'\" value='Valider une séance' />";

      mysqli_close($connect);
    ?>

  </body>
</html>
