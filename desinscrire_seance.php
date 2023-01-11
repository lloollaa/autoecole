
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Désinscription séance</title>
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Désinscrire un élève d'une séance </h1>
  <h2> Sélectionnez la séance à laquelle vous désinscrivez l'élève</h2>
  <?php
  //connexion à la base de données
  include("connexion.php");

  //transmission des données du formulaire
  $ideleve = $_POST["ideleve"];

  //mise en place de la date d'aujourd'hui
  date_default_timezone_set('Europe/Paris');
  $datea = date("Y-m-d");

  //vérification de la saisie des données
  if (empty($ideleve)){
    echo "<p>Il faut sélectionner un élève !</p>";
    exit;
  }

  //sélection des inscriptions de l'élève
  $query = "SELECT * FROM inscription INNER JOIN seances ON seances.idseance=inscription.idseance INNER JOIN themes ON seances.idtheme=themes.idthemes WHERE DATEDIFF( `Dateseance` , '$datea' )>=0 AND ideleve=$ideleve";
  //idseance ideleve note idseance Dateseance Effmax idtheme idtheme nom supprime descriptif
  $result = mysqli_query($connect, $query);

  if (!$result){
   echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
   //boutons qui renvoient vers d'autres pages
   echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
   echo "<input type='button' onclick=\"window.location='desinscription_seance.php'\" value='Recommencer' />";
   exit;
  }

  if (mysqli_num_rows($result)==0){ // il n'y a pas de séance dans le futur pour vet élève
    echo"<p>L'élève n'est inscrit à aucune séance dans le futur<p>";
    //boutons qui renvoient vers d'autres pages
    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo "<input type='button' onclick=\"window.location='desinscription_seance.php'\" value='Désinscrire un autre élève' />";;
    exit;
  }
  // il y a des séance dans le futur
  // génère un select avec les séances dans le futur
  echo "<FORM METHOD='post' ACTION='desinscrire_seance2.php'>";
  echo "<label for='idseance'> Sélectionnez la séance</label><br>";
  echo "<select name='idseance' id='idseance' size='4'>";
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){// pour chaque séance affiche son thème et sa date
      echo "<option value='$row[0]'> $row[8] : $row[4]</option>";
    }
  echo"</select>";

  echo "<input type='hidden' value='$ideleve' name='ideleve'>"; // transmet l'id de l'élève
  echo "<br>";
  echo "<input type='submit' value='Désinscrire de cette séance'>";

  echo "</FORM>";

  mysqli_close($connect)

  ?>
</body>
</html>
