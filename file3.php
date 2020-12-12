
<?php

include('fonctions.php');

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    else
    {
        session_destroy();
        session_start(); 
    }

    if(isset($_POST['trier']) && isset($_POST['film']))
    {
    	$_SESSION['trier'] = $_POST['trier'];
    	$_SESSION['film'] = $_POST['film'];
    }
?>

<!DOCTYPE html> 
<html> 
    <head>
        <title>Informations Acteurs</title>
        <meta charset="utf-8" />
    </head>
    <body>

	<form method="post">

	  <label for="trier" style="display:block; float:left; width:80px">Trier Par :</label>
      <p><select name="trier" id="trier">

      <option value="Acteur.Nom_Acteur ASC, Acteur.Prenom_Acteur ASC" 
          <?php if(isset($_SESSION['trier']) && $_SESSION['trier']=="Acteur.Nom_Acteur ASC, Acteur.Prenom_Acteur ASC"){echo "selected";}
                ?>>Nom Acteurs A-Z

      <option value="Acteur.Nom_Acteur DESC, Acteur.Prenom_Acteur DESC" 
          <?php if(isset($_SESSION['trier']) && $_SESSION['trier']=="Acteur.Nom_Acteur DESC, Acteur.Prenom_Acteur DESC"){echo "selected";}
                ?>>Nom Acteurs Z-A

	  <option value="Acteur.Date_de_naissance DESC" 
          <?php if(isset($_SESSION['trier']) && $_SESSION['trier']=="Acteur.Date_de_naissance DESC"){echo "selected";}
                ?>>Age Acteur Croissant

       <option value="Acteur.Date_de_naissance ASC" 
          <?php if(isset($_SESSION['trier']) && $_SESSION['trier']=="Acteur.Date_de_naissance ASC"){echo "selected";}
                ?>>Age Acteur Décroissant

      <option value="Film.Nom_Film ASC" 
          <?php if(isset($_SESSION['trier']) && $_SESSION['trier']=="Film.Nom_Film ASC"){echo "selected";}
                ?>>Nom Film A-Z

      <option value="Film.Nom_Film DESC" 
          <?php if(isset($_SESSION['trier']) && $_SESSION['trier']=="Film.Nom_Film DESC"){echo "selected";}
                ?>>Nom Film Z-A

      </select></p>

      <label for="film" style="display:block; float:left; width:100px">Trier Par Film:</label>
      <p><select name="film" id="film">

      <option value="" 
          <?php if(isset($_SESSION['film']) && $_SESSION['film']==""){echo "selected";}
                ?>>tous

      <option value="AND FILM.Id_Film = 1" 
          <?php if(isset($_SESSION['film']) && $_SESSION['film']=="AND FILM.Id_Film = 1"){echo "selected";}
                ?>>TENET

      <option value="AND FILM.Id_Film = 2" 
          <?php if(isset($_SESSION['film']) && $_SESSION['film']=="AND FILM.Id_Film = 2"){echo "selected";}
                ?>>JOKER

	  <option value="AND FILM.Id_Film = 3" 
          <?php if(isset($_SESSION['film']) && $_SESSION['film']=="AND FILM.Id_Film = 3"){echo "selected";}
                ?>>INCEPTION

       <option value="AND FILM.Id_Film = 4" 
          <?php if(isset($_SESSION['film']) && $_SESSION['film']=="AND FILM.Id_Film = 4"){echo "selected";}
                ?>>INTERSTELLAR

      <option value="AND FILM.Id_Film = 5" 
          <?php if(isset($_SESSION['film']) && $_SESSION['film']=="AND FILM.Id_Film = 5"){echo "selected";}
                ?>>SKYFALL 007
      
      </select></p>

	<input type="submit" name="aSubmit" value="selectionner" /></p>

</form>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CINEMATRACKER";

if(isset($_SESSION['trier']))
   {
	
	try {
  	$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8;", $username, $password);
  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  	$stmt = $conn->prepare("
  		SELECT Acteur.Nom_Acteur, Acteur.Prenom_Acteur, Acteur.Date_de_naissance, Film.Nom_Film
  		FROM Acteur, FILM, Joue 
		WHERE Acteur.ID_Acteur = Joue.ID_Acteur 
		AND Joue.Id_Film = FILM.Id_Film 
		".$_SESSION['film']."
		ORDER BY ".$_SESSION['trier']."");
  
  	$stmt->execute();
  
  	tableau('acteur');
 	
 		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			echo $v;
    	}
  		
	} catch(PDOException $e) {
  	echo "Error: " . $e->getMessage();
	}
	$conn = null;
	echo "</table>";

   }
		
		displayTab('$_GET',$_GET);
        displayTab('$_POST',$_POST);
        displayTab('$_SESSION',$_SESSION);
        displayTab('$_COOKIE',$_COOKIE);

        echo "Id session = ".session_id();
?>
 
  </body>
</html>