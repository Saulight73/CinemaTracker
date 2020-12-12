<?php

	function tableau($var1) {

		echo "<table style='border: solid 1px black;'>";


	 if($var1=='prix')
	  {

		if(isset($_SESSION['personne']) && $_SESSION['personne']=="")
		{
			$personne = '<th>Personne</th>';
		}
		else
		{
			$personne = '';
		}	


		if(isset($_SESSION['sceance']) && $_SESSION['sceance']=="Prix")
		{
			$prix = '<th>Prix 2D</th>';
		}
		elseif(isset($_SESSION['sceance']) && $_SESSION['sceance']=="Prix+Supplement_3D")
		{
			$prix = '<th>Prix 3D</th>';
		}
		elseif(isset($_SESSION['sceance']) && $_SESSION['sceance']=="Prix, Prix+Supplement_3D")
		{
			$prix = '<th>Prix 2D</th><th>Prix 3D</th>';
		}


		echo "<tr><th>FILM</th><th>CINEMA</th>" .$prix, $personne. "</tr>";

	  }
	  elseif ($var1=='info') 
	  {

	  	if(isset($_SESSION['rea']) && $_SESSION['rea']=="")
		{
			$realisateur = '<th>Nom Réalisateur</th><th>Prénom Réalisateur</th>';
		}
		else
		{
			$realisateur = '';
		}


	  	echo "<tr><th>FILM</th><th>NOTE /10</th><th>Durée en min</th><th>Pays Origine</th>
	  			".$realisateur."</tr>";

	  }
	  elseif ($var1=='acteur') 
	  {
	  
	    echo "<tr><th>Nom Acteur</th><th>Prenom Acteur</th><th>Date de naissance</th><th>FILM</th>
	    		</tr>";
	  
	  }


 		class TableRows extends RecursiveIteratorIterator {
  		function __construct($it) {
    	parent::__construct($it, self::LEAVES_ONLY);
  		
  		}

  		function current() {
    	return "<td style='width:150px;border:1px solid black;'>" .parent::current(). "</td>";
  		}

  		function beginChildren() {
    	echo "<tr>";
  		}

  		function endChildren() {
    	echo "</tr>" . "\n";
  		}
 	}

 }
 

function displayTab($name,$tab) {
	echo "<p>$name :</p>";
	echo "<p><pre>"; print_r($tab); 
	echo "</pre></p>";
}

?>