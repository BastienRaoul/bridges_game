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
          <input type="submit" name="deconnexion" id="deconnexion" value="Deconnexion">
          <h1>Bridges</h1>
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
                    if ($idVille == $villeActuelle->getId()){ // Si la ville est selectionnée
                      echo "selectionner";
                    }  elseif ($villeActuelle->getNombrePonts() > $villeActuelle->getNombrePontsMax()){ // Si il y a trop de ponts
                      echo "erreur";
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
} ?>
