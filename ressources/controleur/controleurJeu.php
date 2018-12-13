<?php
require_once PATH_VUE . "vueJeu.php";
require_once PATH_MODELE . "Villes.php";

class controleurJeu {
  private $vue;
  private $villesStart;
  private $villes;

  function __construct() {
    $this->vue = new VueJeu();
  }
  /*
  * Fonction de la construction du tableau de jeu.
  * / représente un endroit vide.
  * o s'agit d'une ville non finie.
  * O s'agit d'une ville finie.
  * - = | || sont les chemins entres les villes
  */
  function constructTab() {
      $tab = array();
      $villesStart = unserialize($_SESSION['villes']);
      for ($i = 0; $i < 7; $i++){
        for ($j = 0; $j < 7; $j++){
          if ($villesStart->existe($i, $j)){
            $tab[$i][$j] = 'o';
          } else {
            $tab[$i][$j] = '/';
          }
        }
      }
      $_SESSION['plateau'] = $tab;
  }

  function jeu() {
    $idVille = $_GET['ville'];
    $oldIdVille = $_GET['oldVille'];
    $villes = unserialize($_SESSION['villes']);
    for ($i = 0; $i < 7; $i++){
      for ($j = 0; $j < 7; $j++){
        if ($idVille == $villes->getVille($i, $j)->getId()){
        }
      }
    }
    $villes->addPont($oldIdVille, $idVille);
    $_SESSION['villes'] = serialize($villes);
    unset ($_GET['ville']);
    $this->vue->afficherJeu($idVille);
  }
}
?>
