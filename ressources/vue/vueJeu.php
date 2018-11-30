<?php

class VueJeu {

  function affichagePlateau() { ?>
  <html>
    <head>
      <link rel = "stylesheet" type = "text/css" href = " css.css">
      <meta charset = "utf-8"/>
    </head>

    <body bgcolor = "#FFFFFF">
      <h1 style="text-align:center; margin-top:2%;">Bridges</h1>
      <input type="button" value="Réinitialiser partie"> </input>
      <input type="button" value="Annuler dernier mouvement"> </input>

<?php
 }

 function construirePlateau($villes) {
   echo "<canvas id=\"plateauCanvas\" width=\"800\" height=\"800\" style=\"border:1px solid #000000;\"> </canvas>";
   echo "<script \"text/javascript\">";
   echo "var canvas = document.getElementById(\"plateauCanvas\");";
   echo "var ctx = canvas.getContext(\"2d\");";
   echo "ctx.arc(100, 100, 90, 0, 2 * Math.PI);";
   echo "ctx.fillText(\"1\", 10, 10);";
   for (int i = 0; i <= 6; i++){
     
   }
   echo "ctx.fillText(\"".$villes.toString()."\", 200, 200);";
   echo "ctx.stroke();";
   echo "</script>";
 }
} ?>
