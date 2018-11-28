<?php

require_once PATH_MODELE . "/modele.php";
require_once PATH_VUE . "/vueJeu.php";
require_once PATH_VUE . "/authentification.php";

class controleurAuthentification {
  private $vue;
  private $modele;
  private $authentification;

  function __construct() {
    $this->vue = new VueJeu();
    $this->modele = new Modele();
    $this->authentification = new Authentification();
  }

  function accueil() {
    $this->authentification->demandePseudo();
  }

  function verification($username, $password) {
    if ($this->modele->exists($username, $password)) {
      $this->vue->affichagePlateau();
    } else {
      $this->authentification->errorAuthentification();
      $this->authentification->demandePseudo();
    }
  }
}
?>
