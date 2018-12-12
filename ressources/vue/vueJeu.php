<?php

class VueJeu {

  function afficherJeu() { ?>
    <html>
      <head>
        <title> Bridges </title>
        <link rel = "stylesheet" type = "text/css" href = " css.css">
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
                if (isset($_SESSION['ville'])) {
                    $ville = unserialize($_SESSION['ville']);
                }
            for ($i = 0; $i < 7; $i++) {
              echo "<tr>";
              for ($j = 0; $j < 7; $j++) {
                echo "<td>";
                if ($villes->existe($i, $j)) {
                  $villeSelection = $villes->getVille($i, $j);
                  echo "<a href='?ville=".$villeSelection->getId()."'>".$villeSelection->getNombrePontsMax()."</a>";
                } else {
                  echo "&nbsp";
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


  function affichagePlateau($villes) { ?>
  <html>
    <head>
      <title> Bridges </title>
      <link rel = "stylesheet" type = "text/css" href = " css.css">
      <meta charset = "utf-8"/>
    </head>

    <body bgcolor = "#FFFFFF">
      <h1 style="text-align:center; margin-top:2%;">Bridges</h1>
      <form>
        <input type="button" value="Réinitialiser partie"> </input>
        <input type="button" value="Annuler dernier mouvement"> </input>
      </form>
      <br/>
      <?php $this->construirePlateau($villes); ?>

<?php
 }

 function construirePlateau($villes) { ?>
  <canvas id="plateauCanvas" width="700" height="700" style="border:1px solid #000000;"> </canvas>
  <script "text/javascript">
  var canvas = document.getElementById("plateauCanvas");
  var ctx = canvas.getContext("2d");
  <?php for($i = 0; $i <= 6; $i++){
    for ($j = 0; $j <= 6; $j++){
      if (isset($villes[$i][$j])) { ?>
        ctx.beginPath();
        ctx.arc(100 * <?php echo $i; ?> + 50, 100 * <?php echo $j; ?> + 50, 25, 0, 2 * Math.PI);
        ctx.stroke();
        ctx.fillText("<?php echo $villes[$i][$j]->getNombrePontsMax(); ?>", 100 * <?php echo $i; ?> + 47, 100 * <?php echo $j; ?> + 54);
    <?php }
    }
  } ?>

  function getPosMouse(event) {
    var rect.canvas.getBoundingClientRect();
      return {
        x : event.clientX - rect.left,
        y : event.clientY - rect.top
      };
  }

  canvas.addEventListener("click", function(event) {
    mousePos = getPosMouse(event);
    <?php echo mousePos; ?>
  }, false);

  </script>
 <?php }



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
