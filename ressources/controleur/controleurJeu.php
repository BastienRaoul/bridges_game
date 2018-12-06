<?php
require_once PATH_VUE . "/vueJeu.php";
require_once PATH_VUE . "/controleurAuthentification.php";

class controleurJeu {
  private $ctrlAuthentification;
  private $vue;

  function __construct() {
    $this->vue = new VueJeu();
  }

  function jeu() {
    if (isset($_SESSION["connecter"])) {

    } else {
      session_destroy();
      $this->
    }
  }

}
?>
