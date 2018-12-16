<?php

class VueJeu {

  function afficherJeu($oldIdVille, $idVille) { ?>
    <html>
      <head>
        <title> Bridges </title>
        <link rel = "stylesheet" type = "text/css" href = "css/style.css">
        <meta charset = "utf-8"/>
      </head>
      <body>
        <form method="post" action="" style="white-space: nowrap">
          <input type="submit" name="annulerCoup" id="annulerCoup" value="annulerCoup">
          <input type="submit" name="recommencer" id="recommencer" value="recommencer">
          <input type="submit" name="abandonner" id="abandonner" value="abandonner">
          <input type="submit" name="deconnexion" id="deconnexion" value="Deconnexion">

          <h1>Bridges</h1>
          Connecté en tant que: <b> <?php echo $_SESSION['pseudo'] ?> </b> <br/>
          <?php if ($_SESSION['erreur'] == true){
            echo "Il n'est pas possible de lier ces 2 villes";
          } else {
            echo "<br/>";
          }?>
          <div id="jeu">
            <table>
              <?php
              $villes = unserialize($_SESSION['villes']);
              for ($i = 0; $i < 7; $i++){
                echo "<tr>";
                for ($j = 0; $j < 7; $j++){
                  if ($_SESSION['plateau'][$i][$j] == '|'){
                    echo "<td class='simplevertical'></td>";
                  } elseif ($_SESSION['plateau'][$i][$j] == '||'){
                    echo "<td class='doublevertical'></td>";
                  } elseif ($_SESSION['plateau'][$i][$j] == '-'){
                    echo "<td class='simplehorizontal'></td>";
                  } elseif ($_SESSION['plateau'][$i][$j] == '='){
                    echo "<td class='doublehorizontal'></td>";
                  } else {
                    echo "<td>";
                  }
                  if ($_SESSION['plateau'][$i][$j] == 'o' || $_SESSION['plateau'][$i][$j] == 'O'){ //Si c'est une ville
                    $villeActuelle = $villes->getVille($i, $j);
                    echo "<a href='?ville=" . $villeActuelle->getId() . "&oldVille=" . $oldIdVille . "'class='";
                    if ($oldIdVille == $villeActuelle->getId()){ // Si la ville est selectionnée
                      echo "selectionner";
                    } elseif ($_SESSION['plateau'][$i][$j] == 'O'){ // Si la ville est finie
                      echo "complete";
                    }
                    // Besoin d'ajout ville desactive donc non possibilité de sélection
                    echo "'>" . $villeActuelle->getNombrePontsMax() . "</a>";
                  } else {
                    if ($_SESSION['plateau'][$i][$j] == '/'){ // Si c'est une case vide
                      echo "&nbsp";
                    }
                  }
                  echo "</td>";
                }
                echo "</tr>";
              }
            ?>
           </table>
          </div>
        </form>
      </body>
    </html>
  <?php
  }

  function affichageResultat($etatPartie, $ratioJoueur, $leaderboardRatios, $leaderboardPartiesWins){
    if ($etatPartie == "true"){
      echo "Bravo vous avez Gagner '" . $_SESSION["pseudo"] . "'!";
    } elseif ($etatPartie == "false" ) {
      echo "Dommage vous avez Perdu '" . $_SESSION["pseudo"] . "'!";
    } else {
      echo "Vous avez abandonné la partie '" . $_SESSION["pseudo"] . "'!";
    }
    echo "<h1> Statistiques </h1> <br/>";
    if($ratioJoueur["nbTotalParties"]>0){
      echo "Vous avez gagné " . $ratioJoueur['nbTotalPartiesGagnees'] . " parties sur un total de " . $ratioJoueur["nbTotalParties"] . " parties jouées soit un ratio de ". round($ratioJoueur['nbTotalPartiesGagnees']/$ratioJoueur["nbTotalParties"],3);
    } else {
      echo "Vous avez gagné " . $ratioJoueur['nbTotalPartiesGagnees'] . " parties sur un total de " . $ratioJoueur["nbTotalParties"] . " parties jouées.";
    }
    echo "<br/> <br/>";
    echo '<div class="leaderboard">';
    echo "<p>Leaderboard des ratios</p>";
    echo "<p>Leaderboard des parties gagnées</p>";
    echo "</div>";
		echo '<div class="leaderboard">';
		echo '<table><tr><th>Rang</th><th>Pseudo</th><th>Ratio</th></tr>';

		echo '<tr><td>1</td><td>' . $leaderboardRatios[0]['pseudo'] . '</td><td>' . $leaderboardRatios[0]['ratio'] . '</td></tr>';
		echo '<tr><td>2</td><td>' . $leaderboardRatios[1]['pseudo'] . '</td><td>' . $leaderboardRatios[1]['ratio'] . '</td></tr>';
		echo '<tr><td>3</td><td>' . $leaderboardRatios[2]['pseudo'] . '</td><td>' . $leaderboardRatios[2]['ratio'] . '</td></tr>';
		echo "</table>";

		echo "<table>";
		echo "<tr><th>Rang</th><th>Pseudo</th><th>Total Parties gagnées</th><th>Total Parties perdues</th><th>Ratio</th></tr>";

    $nbPartiesPerdues1 = ($leaderboardRatios[0]['pseudo'] != "Personne à cette position") ? ($leaderboardPartiesWins[0]['totalPartiesJouees']) - ($leaderboardPartiesWins[0]['totalPartiesGagnees']) :"Inconnu";
		$nbPartiesPerdues2 = ($leaderboardRatios[1]['pseudo'] != "Personne à cette position") ? ($leaderboardPartiesWins[1]['totalPartiesJouees']) - ($leaderboardPartiesWins[1]['totalPartiesGagnees']) :"Inconnu";
		$nbPartiesPerdues3 = ($leaderboardRatios[2]['pseudo'] != "Personne à cette position") ? ($leaderboardPartiesWins[2]['totalPartiesJouees']) - ($leaderboardPartiesWins[2]['totalPartiesGagnees']) :"Inconnu";

    echo '<tr><td>1</td><td>' . $leaderboardPartiesWins[0]['pseudo'] . '</td><td>' . $leaderboardPartiesWins[0]['totalPartiesGagnees'] . '</td><td>' . $nbPartiesPerdues1 . '</td><td>' . $leaderboardPartiesWins[0]['ratio'] . '</td></tr>';
		echo '<tr><td>2</td><td>' . $leaderboardPartiesWins[1]['pseudo'] . '</td><td>' . $leaderboardPartiesWins[1]['totalPartiesGagnees'] . '</td><td>' . $nbPartiesPerdues2 . '</td><td>' . $leaderboardPartiesWins[1]['ratio'] . '</td></tr>';
		echo '<tr><td>3</td><td>' . $leaderboardPartiesWins[2]['pseudo'] . '</td><td>' . $leaderboardPartiesWins[2]['totalPartiesGagnees'] . '</td><td>' . $nbPartiesPerdues3 . '</td><td>' . $leaderboardPartiesWins[2]['ratio'] . '</td></tr>';
		echo '</table></div>';
    echo '<br/> <br/>';
    echo '<form method="post" action="" style="white-space: nowrap">';
    echo '<input type="submit" name="recommencer" id="recommencer" value="recommencer">';
    echo '&nbsp';
    echo '<input type="submit" name="deconnexion" id="deconnexion" value="Deconnexion">';
    echo '</form>';



  }
} ?>
