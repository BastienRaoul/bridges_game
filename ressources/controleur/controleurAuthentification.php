<?php

require_once PATH_MODELE . "/modele.php";
require_once PATH_VUE . "/vueJeu.php";
require_once PATH_VUE . "/authentification.php";
require_once PATH_MODELE . "/Villes.php";

class controleurAuthentification {
  private $vue;
  private $modele;
  private $authentification;
  private $villes;

  function __construct() {
    $this->vue = new VueJeu();
    $this->modele = new Modele();
    $this->authentification = new Authentification();
    $this->villes = new Villes();
  }

  function accueil() {
    $this->authentification->demandePseudo();
  }

  function verification($username, $password) {
    if (isset($_SESSION["connecter"])){
      if ($this->modele->exists($username, $password)) {
        $villes = $this->villes->getVilles();
        $this->vue->affichagePlateau($villes);
      } else {
        $this->authentification->errorAuthentification();
        $this->authentification->demandePseudo();
      }
    } else {
      $this->authentification->deconnexion();
      $this->authentification->demandePseudo();
    }

  }
}
?>
