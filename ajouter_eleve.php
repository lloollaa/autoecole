<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="projet.css">
  </head>
<body>
  <h1> Ajouter un élève : </h1>
  <h2> Ajout de l'élève </h2>
  <?php
  // date d'aujourd'hui pour l'inscription de l'élève
  date_default_timezone_set('Europe/Paris');
  $date = date("Y-m-d");

  //connexion à la base de données
  include("connexion.php");

  // récupère les informations du formulaire
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $datenais = $_POST['datenais'];

  //permet l'utilisation des caractères spéciaux
  $nom = mysqli_real_escape_string($connect, $nom);
  $prenom = mysqli_real_escape_string($connect, $prenom);


  //vérification de la saisie des données
  if(empty($nom) || empty($prenom) || empty($datenais)){
    echo "<p>Un champ est vide</p>";
    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='AJouter un élève' />";
    exit;
  }

  //vérifie si un élève avec le même nom et prénom est enregistré
  $verif = "SELECT nom, prenom FROM eleves WHERE nom = '$nom' AND prenom = '$prenom'";
  $result1 = mysqli_query($connect, $verif);
  if (!$result1){
    echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
    exit;
  }

  if (mysqli_num_rows($result1) > 0)  {
    // si l'élève existe déjà, génère une table qui récapitule les informations et demande si il veut vraiment rajouter cet élève
    echo "<p>L'élève existe déjà, le rajouter quand même ?</p>";
    echo  "<table class='table'>
          <tr>
            <th> Nom </th> <th> Prénom </th> <th> Date de Naissance </th>
          </tr>
          <tr>
            <td> <a>$nom</a> </td>
            <td> <a>$prenom </a></td>
            <td> <a>$datenais</a> </td>
          </tr>
          </table> <br>
          
          <form action = 'valider_eleve.php' method = 'post'>
          <input name='nom' type='hidden' value='$nom'>
          <input name='prenom' type='hidden' value='$prenom'>
          <input name='datenais' type='hidden' value='$datenais'>

          <input type='submit' value='Valider'>
          <input type='button' onclick=\"window.location='accueil.html'\" value='Ne pas rajouter' />
          </form>";
  }
  else{//l'élève n'est pas dans la base
    if ($datenais > $date){ // la date de naissance est deans le futur
      echo "<p>Vous avez saisi une date de naissance dans le futur.</p>";
      echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
      echo "<input type='button' onclick=\"window.location='ajout_eleve.html'\" value='AJouter un élève' />";
      exit;
    }
    // insère l'élève dans la base de données
    $query2 = "INSERT INTO eleves VALUES (NULL,"."'$nom'".", "."'$prenom'".", "."'$datenais'".", "."'$date'".")";
    $result2 = mysqli_query($connect, $query2);
    if (!$result2){
      echo "<p>La requête n'a pas pu aboutir</p>".mysqli_error($connect);
      exit;
    }
    //message qui indique à l'utilisateur que l'élève a été ajouté
    echo "<p>L'élève $nom $prenom né(e) le $datenais a bien été ajouté.</p>";
    echo "<input type='button' onclick=\"window.location='accueil.html'\" value='Accueil' />";
    }

  mysqli_close($connect);
  ?>
</body>
</html>
