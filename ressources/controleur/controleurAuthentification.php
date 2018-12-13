<?php

require_once PATH_MODELE . "modele.php";
require_once PATH_VUE . "vueJeu.php";
require_once PATH_VUE . "authentification.php";
require_once PATH_MODELE . "Villes.php";
require_once PATH_CONTROLEUR . "controleurJeu.php";

class controleurAuthentification {
  private $vue;
  private $modele;
  private $authentification;
  private $jeu;
  private $villes;

  function __construct() {
    $this->vue = new VueJeu();
    $this->modele = new Modele();
    $this->authentification = new Authentification();
    $this->jeu = new controleurJeu();
    $this->villes = new Villes();
  }

  function accueil() {
    $this->authentification->demandePseudo();
  }

  function connexion($pseudo, $password) {
    if ($this->modele->exists($pseudo, $password)){
      $_SESSION["connecter"] = true;
      $_SESSION['villes'] = serialize($this->villes);
      $this->jeu->constructTab();
      $oldIdVille = -1;
      $idVille = -1;
      $this->vue->afficherJeu($oldIdVille, $idVille);
    } else {
      $this->authentification->errorAuthentification();
      $this->authentification->demandePseudo();
    }
  }
}
?>
