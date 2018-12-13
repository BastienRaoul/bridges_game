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
    /*echo 'ville: ';
    var_dump($_GET['ville']);
    echo 'oldVille: ';
    var_dump($_GET['oldVille']);*/
    if ($idVille != -1 && $oldIdVille != -1){ // Verifie qu'il existe 2 villes a relier (L'ancienne selectionnée et celle de maintenant)
      $villes = unserialize($_SESSION['villes']);
      for ($i = 0; $i < 7; $i++){
        for ($j = 0; $j < 7; $j++){
          if ($villes->existe($i, $j)){
            $cmp = $villes->getVille($i, $j);
            $cmp = $cmp->getId();
          /*  echo 'cmp: ';
            var_dump($cmp);
            echo 'idVille: ';
            var_dump($idVille);*/
            if ($idVille == $cmp){
              $villes->addPont($oldIdVille, $idVille);
            }
          }
        }
      }
      $_SESSION['villes'] = serialize($villes);
      unset ($_GET['ville']);
      $idVille = -1;
      $oldIdVille = -1;
    } else {
      $oldIdVille = $idVille;
      $idVille = -1;
    }

    $this->vue->afficherJeu($oldIdVille, $idVille);
  }
}
?>
