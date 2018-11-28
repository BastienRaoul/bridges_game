<?php

class VueJeu {

  function affichagePlateau() {
    echo '<h1 style="text-align:center; margin-top:2%;">Bridges</h1>';
    echo utf8_decode('<p style="text-align:center; margin-top:2%;"><input type="button" value="Nouvelle partie"></input>
                      <input type="button" value="Réinitialiser partie"></input>
                      <input type="button" value="Annuler dernier mouvement"></input></p>');
  }
}

?>
