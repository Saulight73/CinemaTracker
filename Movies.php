
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

    if(isset($_POST['trie']) && isset($_POST['rea']) && isset($_POST['GENRE']))
    {
    	$_SESSION['trie'] = $_POST['trie'];
    	$_SESSION['rea'] = $_POST['rea'];
    	$_SESSION['GENRE'] = $_POST['GENRE'];  
    }

    if(isset($_SESSION['rea']) && $_SESSION['rea']!="")
	{
		$tous = '';
	}

	if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="")
	{
		$GENRE = '';
	}
	elseif (isset($_SESSION['GENRE']) && $_SESSION['GENRE']!="") 
	{
		$GENRE = 'AND GENRE.Id_GENRE = FILM_GENRE.Id_GENRE AND FILM_GENRE.Id_FILM = FILM.Id_FILM';
	}

?>
<!DOCTYPE html>
<html>


    <head>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');
        </style> 
        <link rel="stylesheet" href="CSSFilm.css">
        <meta charset="utf-8" />
        <title>CinemaTracker - Grenoble</title>
    </head>


    <body>
        <header class="NavBarSettings">
                <a href="Accueil.html" class="NavContentTitle"><u>CinemaTracker</u></a>
                <a href="Movies.html"class="NavContent">TROUVER UN FILM</a>
                <a href="Cinemas.html"class="NavContent">CINEMAS</a>
                <a href="FAQ.html"class="NavContent">FAQ</a>
                <a href="AboutUs.html"class="NavContent">About us</a>
        </header>



        <main>
            <section>
                <article>
                    <h2 class="MiddleTitle">Trouve ton film</h2>
                    <form method="post">

                <label for="trie" style="display:block; float:left; width:80px">Trier Par :</label>
                <p><select name="trie" id="trie">
          
                <option value="FILM.Note DESC" 
                    <?php if(isset($_SESSION['trie']) && $_SESSION['trie']=="FILM.Note DESC"){echo "selected";}
                          ?>>Meilleur Note
          
                <option value="FILM.Note ASC" 
                    <?php if(isset($_SESSION['trie']) && $_SESSION['trie']=="FILM.Note ASC"){echo "selected";}
                          ?>>Pire Note
          
                <option value="FILM.Nom_FILM ASC" 
                    <?php if(isset($_SESSION['trie']) && $_SESSION['trie']=="FILM.Nom_FILM ASC"){echo "selected";}
                          ?>>Nom FILM A-Z
          
                 <option value="FILM.Nom_FILM DESC" 
                    <?php if(isset($_SESSION['trie']) && $_SESSION['trie']=="FILM.Nom_FILM DESC"){echo "selected";}
                          ?>>Nom FILM Z-A
          
                <option value="FILM.Durée DESC" 
                    <?php if(isset($_SESSION['trie']) && $_SESSION['trie']=="FILM.Durée DESC"){echo "selected";}
                          ?>>Durée FILM décroissante
          
                <option value="FILM.Durée ASC" 
                    <?php if(isset($_SESSION['trie']) && $_SESSION['trie']=="FILM.Durée ASC"){echo "selected";}
                          ?>>Durée FILM croissante
          
                </select></p>
          
                <label for="rea" style="display:block; float:left; width:150px">Trier Par Réalisateur :</label>
                <p><select name="rea" id="rea">
          
                <option value="" 
                    <?php if(isset($_SESSION['rea']) && $_SESSION['rea']==""){echo "selected"; 
                            $tous = ', REALISATEUR.Nom_REALISATEUR, REALISATEUR.Prenom_REALISATEUR';}
                          ?>>Tous
          
                <option value="AND REALISATEUR.Id_REA = 1" 
                    <?php if(isset($_SESSION['rea']) && $_SESSION['rea']=="AND REALISATEUR.Id_REA = 1"){echo "selected";}
                          ?>>Todd Philips
          
                <option value="AND REALISATEUR.Id_REA = 2" 
                    <?php if(isset($_SESSION['rea']) && $_SESSION['rea']=="AND REALISATEUR.Id_REA = 2"){echo "selected";}
                          ?>>Christopher Nolan
          
                <option value="AND REALISATEUR.Id_REA = 3" 
                    <?php if(isset($_SESSION['rea']) && $_SESSION['rea']=="AND REALISATEUR.Id_REA = 3"){echo "selected";}
                          ?>>Sam Mendes
                
                </select></p>
          
                <label for="GENRE" style="display:block; float:left; width:150px">Chercher Par GENRE :</label>
                <p><select name="GENRE" id="GENRE">
          
                <option value="" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']==""){echo "selected";}
                          ?>>Tous
          
                <option value="AND GENRE.Id_GENRE = 1" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="AND GENRE.Id_GENRE = 1"){echo "selected";}
                          ?>>Action
          
                <option value="AND GENRE.Id_GENRE = 2" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="AND GENRE.Id_GENRE = 2"){echo "selected";}
                          ?>>Aventure
          
                 <option value="AND GENRE.Id_GENRE = 3" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="AND GENRE.Id_GENRE = 3"){echo "selected";}
                          ?>>Fantastique
          
                <option value="AND GENRE.Id_GENRE = 4" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="AND GENRE.Id_GENRE = 4"){echo "selected";}
                          ?>>Horreur
          
                <option value="AND GENRE.Id_GENRE = 5" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="AND GENRE.Id_GENRE = 5"){echo "selected";}
                          ?>>Comédie
                 
                <option value="AND GENRE.Id_GENRE = 6" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="AND GENRE.Id_GENRE = 6"){echo "selected";}
                          ?>>Romance
          
                <option value="AND GENRE.Id_GENRE = 7" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="AND GENRE.Id_GENRE = 7"){echo "selected";}
                          ?>>Thriller
          
                <option value="AND GENRE.Id_GENRE = 8" 
                    <?php if(isset($_SESSION['GENRE']) && $_SESSION['GENRE']=="AND GENRE.Id_GENRE = 8"){echo "selected";}
                          ?>>SCI-FI
          
                </select></p>
          
                <input type="submit" name="iSubmit" value="selectionner" /></p>
          
              </form>
          
          <?php
          
          $servername = "sql305.byethost13.com";
          $username = "b13_27447252";
          $password = "fantasywars1";
          $dbname = "b13_27447252_CINEMATRACKER";
          
          if(isset($_SESSION['trie']) && isset($_SESSION['rea']) && isset($_SESSION['GENRE']))
             {
              
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8;", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $conn->prepare("
                    SELECT DISTINCT FILM.Nom_FILM, FILM.Note, FILM.Durée, PAYS_ORIGINE.Pays ".$tous."  
                  FROM FILM, REALISATEUR, FILM_REALISATEUR, PAYS_ORIGINE, GENRE, FILM_GENRE
                  WHERE REALISATEUR.Id_REA = FILM_REALISATEUR.Id_REA 
                  AND FILM_REALISATEUR.Id_FILM = FILM.Id_FILM
                  AND PAYS_ORIGINE.Id_ORIGINE = FILM.Id_ORIGINE 
                  ".$_SESSION['rea']."
                  ".$GENRE."
                  ".$_SESSION['GENRE']."
                  ORDER BY ".$_SESSION['trie']."");
            
                $stmt->execute();
            
                tableau('info');
               
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
                  

          ?>
           

                </article>
                <br><br><br><br><br><br><br><br><br><br><br><br><br>
                

            </section>
            
        </main>

        <footer>
            <p>
                © EPSI Groupe 2: Anthony Tran / Nicolas Merceur / Charles Coutures / Mohamed Khadrouche
                <a href="https://discord.gg/AVydncagNX" class="DiscordLink"><img src="IMG/Discord link.png" alt="Invitation serveur discord" width="8%" height="8%"></a>
            </p>
        </footer>
    </body>
</html>