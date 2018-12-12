<?php
require_once PATH_VUE . "vueJeu.php";
require_once PATH_CONTROLEUR . "controleurAuthentification.php";

class controleurJeu {
  private $ctrlAuthentification;
  private $vue;

  function __construct() {
    $this->vue = new VueJeu();
    $this->ctrlAuthentification = new ControleurAuthentification();
  }

  function jeu() {
    if (isset($_POST["deconnexion"])){
      session_destroy();
      $this->ctrlAuthentification->accueil();
    } else {
      if(isset($_SESSION["ville"])){
        $idVille = unserialize($_SESSION["ville"]);
        $villes = unserialize($_SESSION["villes"]);
        $villes->addPont($idVille, $_GET["ville"]);
        $_SESSION["villes"] = serialize($villes);
        unset($_SESSION["ville"]);
        unset($_GET["ville"]);
      } elseif (isset($_GET["ville"])) {
        $_SESSION["ville"] = serialize($_GET["ville"]);
      }
      $this->vue->afficherJeu();
    }
  }
}
?>
s/ressources/
