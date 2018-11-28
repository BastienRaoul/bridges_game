<?php

class VueJeu {

  function affichagePlateau() {
    $html = '<html> <head> <link rel = "stylesheet" type = "text/css" href = " css.css">';
  /*  $html .= '<h1 style="text-align:center; margin-top:2%;">Bridges</h1>';
    echo utf8_decode('<p style="text-align:center; margin-top:2%;"><input type="button" value="Nouvelle partie"></input>
                      <input type="button" value="Réinitialiser partie"></input>
                      <input type="button" value="Annuler dernier mouvement"></input></p>');

*/
    $html .= '<meta charset = "utf-8"/>';
    $html .= '<h1>BRIDGES</h1> </head>';
    $html .= '<body bgcolor = "#FFFFFF">';
    $html .= '<canvas style="display: block" id="plateauCanvas" width="1000" height="1000" tabindex="1"></canvas>';
    $html .= '<script> var c = document.getElementById("myCanvas"); var ctx = c.getContext("2d"); ctx.beginPath(); ctx.arc(100, 100, 50, 0, 2 * Math.PI); ctx.stroke(); </script>';
    echo $html;
  }
}

?>
