<?php

class VueJeu {

  function afficherJeu($oldIdVille, $idville) { ?>
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
                  echo "<td>";
                  if ($_SESSION['plateau'][$i][$j] == 'o' || $_SESSION['plateau'][$i][$j] == 'O'){ //Si c'est une ville
                    $villeActuelle = $villes->getVille($i, $j);
                    echo "<a href = '? ville = " . $villeActuelle->getId() . " & oldVille = " $oldIdVille.  . "' class = ' ";
                    if ($idVille == $villeActuelle->getId()){ // Si la ville est selectionnée
                      echo "selectionner";
                    } elseif ($_SESSION['plateau'][$i][$j] == 'O'){ // Si la ville est finie
                      echo "complete";
                    } elseif ($villeActuelle->getNombrePontsMax() > $villeActuelle->getNombrePonts()){ // Si il y a trop de ponts
                      echo "erreur";
                    }
                    // Besoin d'ajout ville desactive donc non possibilité de sélection
                    echo "'>" . $villeActuelle->getNombrePontsMax() . "</a>";
                  } elseif ($_SESSION['plateau'][$i][$j] != '/'){
                    echo "ya un pont";
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

/*
 array(4) {
   [0]=> array(2) {
    [0]=> object(Ville) (4) {
      ["id":"Ville":private]=> string(1) "0" ["nombrePontsMax":"Ville":private]=> int(3) ["nombrePonts":"Ville":private]=> int(0) ["villesLiees":"Ville":private]=> NULL }
    [6]=> object(Ville) (4) {
      ["id":"Ville":private]=> string(1) "1" ["nombrePontsMax":"Ville":private]=> int(2) ["nombrePonts":"Ville":private]=> int(0) ["villesLiees":"Ville":private]=> NULL }
  }[3]=> array(2) {
    [0]=> object(Ville) (4) {
      ["id":"Ville":private]=> string(1) "2" ["nombrePontsMax":"Ville":private]=> int(6) ["nombrePonts":"Ville":private]=> int(0) ["villesLiees":"Ville":private]=> NULL }
    [5]=> object(Ville) (4) {
      ["id":"Ville":private]=> string(1) "3" ["nombrePontsMax":"Ville":private]=> int(2) ["nombrePonts":"Ville":private]=> int(0) ["villesLiees":"Ville":private]=> NULL }
  }[5]=> array(2) {
    [1]=> object(Ville) (4) {
      ["id":"Ville":private]=> string(1) "4" ["nombrePontsMax":"Ville":private]=> int(1) ["nombrePonts":"Ville":private]=> int(0) ["villesLiees":"Ville":private]=> NULL }
    [6]=> object(Ville) (4) {
      ["id":"Ville":private]=> string(1) "5" ["nombrePontsMax":"Ville":private]=> int(2) ["nombrePonts":"Ville":private]=> int(0) ["villesLiees":"Ville":private]=> NULL }
  }[6]=> array(1) {
    [0]=> object(Ville) (4) {
      ["id":"Ville":private]=> string(1) "6" ["nombrePontsMax":"Ville":private]=> int(2) ["nombrePonts":"Ville":private]=> int(0) ["villesLiees":"Ville":private]=> NULL } } }
*/
/*
  Array (
  [0] => Array (
    [0] => Ville Object (
      [id:Ville:private] => 0 [nombrePontsMax:Ville:private] => 3 [nombrePonts:Ville:private] => 0 [villesLiees:Ville:private] => )
    [6] => Ville Object (
      [id:Ville:private] => 1 [nombrePontsMax:Ville:private] => 2 [nombrePonts:Ville:private] => 0 [villesLiees:Ville:private] => ) )
  [3] => Array (
    [0] => Ville Object (
      [id:Ville:private] => 2 [nombrePontsMax:Ville:private] => 6 [nombrePonts:Ville:private] => 0 [villesLiees:Ville:private] => )
    [5] => Ville Object (
      [id:Ville:private] => 3 [nombrePontsMax:Ville:private] => 2 [nombrePonts:Ville:private] => 0 [villesLiees:Ville:private] => ) )
  [5] => Array (
    [1] => Ville Object (
      [id:Ville:private] => 4 [nombrePontsMax:Ville:private] => 1 [nombrePonts:Ville:private] => 0 [villesLiees:Ville:private] => )
    [6] => Ville Object (
      [id:Ville:private] => 5 [nombrePontsMax:Ville:private] => 2 [nombrePonts:Ville:private] => 0 [villesLiees:Ville:private] => ) )
  [6] => Array (
    [0] => Ville Object (
      [id:Ville:private] => 6 [nombrePontsMax:Ville:private] => 2 [nombrePonts:Ville:private] => 0 [villesLiees:Ville:private] => ) ) )
*/
} ?>
