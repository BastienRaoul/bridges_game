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
    if ($_SESSION["connecter"] == true){
      $this->ctrlJeu->jeu();
    }
    if ((isset($_POST["username"])) && (isset($_POST["password"]))) {
      $_SESSION["connecter"] = true;
      $this->ctrlAuthentification->verification($_POST["username"], $_POST["password"]);
    } else {
      $this->ctrlAuthentification->accueil();
    }
  }


}
?>
