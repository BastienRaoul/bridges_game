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
    if (isset($_POST["deconnexion"])){
      session_destroy();
      header('Location: index.php');
    }
    
    if (!isset($_SESSION["connecter"])){
      $_SESSION["connecter"] = false;
    }

    if ($_SESSION["connecter"] == true){
      if (isset($_POST["annulerCoup"])){
        $this->ctrlJeu->annulerCoup();
        header('Location: index.php');
      } elseif (isset($_POST["recommencer"])){
        $this->ctrlJeu->reset();
        header('Location: index.php?ville=-1&oldVille=-1');
      } elseif (isset($_POST["abandonner"])){
        $this->ctrlJeu->affichageResultat("abandonner");
      } else {
        $this->ctrlJeu->jeu();
      }
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
