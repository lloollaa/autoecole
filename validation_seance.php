<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Validation séance</title>
    <link rel="stylesheet" href="projet.css">
  </head>
  <body>
    <h1>Validation d'une séance</h1>
    <h2>Sélectionnez une séance passée pour noter les élèves</h2>

    <?php
    //connexion à la base de données
    include("connexion.php");

    //mise en place de la date
    date_default_timezone_set('Europe/Paris');
    $datemax = date("Y-m-d");

    //sélection et affichage des séances dans le passé
    $query = "SELECT * FROM seances INNER JOIN themes ON seances.idtheme = themes.idthemes WHERE DATEDIFF( `Dateseance` , '$datemax' )<0 ORDER BY themes.nom";
    // renvoie idseance dateseance effmax idtheme idtheme nom supprime descriptif
    $result = mysqli_query($connect,$query);

    if (!$result){
      echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
      exit;
    }

    echo "<FORM METHOD='POST' ACTION='valider_seance.php' >";
    echo "<label for='choixseancefaite'> Veuillez sélectionner une séance :</label><br>";
    echo "<select name='choixseancefaite' id='choixseancefaite' size='5'>";
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      echo "<option value=$row[0]>$row[5] : $row[1]</option>";
    }
    echo "</select>";
    echo "<br>";

    echo "<input type=submit value=Noter cette séance>";

    echo "</FORM>";
    mysqli_close($connect);

    ?>
  </body>
</html>
