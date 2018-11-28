<?php
require_once "controleurAuthentification.php";

class Routeur {
  private $ctrlAuthentification;
  private $modele;
  private $controleur;
  private $vue;

  public function __construct() {
    $this->ctrlAuthentification = new ControleurAuthentification();
    $this->modele = new Modele();
    $this->vue = new VueJeu();
  }

  public function routerRequete() {
    if ((isset($_POST["username"])) && (isset($_POST["password"]))) {
      $this->ctrlAuthentification->verification($_POST["username"], $_POST["password"]);
    } else {
      $this->ctrlAuthentification->accueil();
    }
  }


}
?>
