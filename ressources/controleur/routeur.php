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
    echo '<form method="post" action="" style="white-space: nowrap"> <input type="submit" name="deconnexion" id="deconnexion" value="Deconnexion"> </form>';
    if (isset($_POST["deconnexion"])){
      session_destroy();
    }

    if (!isset($_SESSION["connecter"])){
      $_SESSION["connecter"] = false;
    }

    if ($_SESSION["connecter"] == true){
      $this->ctrlJeu->jeu();
    } else {
      if(isset($_POST["pseudo"], $_POST["password"])){
        $this->ctrlAuthentification->connexion($_POST["pseudo"], $_POST["password"]);
      } else {
        $this->ctrlAuthentification->accueil();
      }
    }
  }
}
?>
