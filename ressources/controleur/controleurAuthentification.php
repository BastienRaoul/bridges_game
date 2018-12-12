<?php

require_once PATH_MODELE . "modele.php";
require_once PATH_VUE . "vueJeu.php";
require_once PATH_VUE . "authentification.php";
require_once PATH_MODELE . "Villes.php";

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

  function connexion($pseudo, $password) {
    if ($this->modele->exists($pseudo, $password)){
      $_SESSION["connecter"] = true;
      $_SESSION['villes'] = serialize($this->villes);
      $this->vue->afficherJeu();
    } else {
      $this->authentification->errorAuthentification();
      $this->authentification->demandePseudo();
    }
  }
}
?>
