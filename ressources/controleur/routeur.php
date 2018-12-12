<?php
require_once "controleurAuthentification.php";
require_once "controleurJeu.php";

class Routeur {
  private $ctrlAuthentification;
  private $ctrlJeu;
  private $modele;
  private $controleur;
  private $vue;

  public function __construct() {
    $this->ctrlAuthentification = new ControleurAuthentification();
    $this->ctrlJeu = new ControleurJeu();
    $this->modele = new Modele();
    $this->vue = new VueJeu();
  }

  public function routerRequete() {
    if (!isset($_SESSION["connecter"])){
      $_SESSION["connecter"] = false;
    }

    if ($_SESSION["connecter"] == true){
      $this->ctrlJeu->jeu();
    } else {
      $this->ctrlAuthentification->Connexion();
    }
  }

}
?>
