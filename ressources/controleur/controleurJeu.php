<?php
require_once PATH_VUE . "vueJeu.php";
require_once PATH_MODELE . "Villes.php";
require_once PATH_MODELE . "modeleStats.php";

class controleurJeu {
  private $vue;
  private $villesStart;
  private $villes;
  private $modeleStats;

  function __construct() {
    $this->vue = new VueJeu();
    $this->modeleStats = new ModeleStats();
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
      $villesStart = unserialize($_SESSION['villesStart']);
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
      $_SESSION['oldPlateau'] = $tab;
  }

  function jeu() {
    if (isset($_GET['ville']) || isset($_GET['oldVille'])){
      $idVille = $_GET['ville'];
      $oldIdVille = $_GET['oldVille'];
      if ($idVille != -1 && $oldIdVille != -1){ // Verifie qu'il existe 2 villes a relier (L'ancienne selectionnée et celle de maintenant)
        $villes = unserialize($_SESSION['villes']);
        $_SESSION['oldPlateau'] = $_SESSION['plateau'];
        for ($i = 0; $i < $villes->getNbVilles(); $i++){
          $cmp = $villes->getVilleById($i);
          $cmp = $cmp->getId();
          if ($idVille == $cmp){
            $villes->addPont($oldIdVille, $idVille);
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

      if ($this->estGagner()){
        $this->affichageResultat("true");
      } elseif ($this->estPerdue()){
        $this->affichageResultat("false");
      } else {
        $this->vue->afficherJeu($oldIdVille, $idVille);
      }
    } else {
      $_SESSION['erreur'] = false;
      $this->vue->afficherJeu(-1, -1);
    }
  }

  function annulerCoup(){
    $_SESSION['plateau'] = $_SESSION['oldPlateau'];
  }

  function reset(){
    $_SESSION['villes'] = $_SESSION['villesStart'];
    $this->constructTab();
  }


  function estGagner(){
    $nbVillesComplete = 0;
    $villes = unserialize($_SESSION['villes']);
    for ($i = 0; $i < $villes->getNbVilles(); $i++){
      $cmp = $villes->getVilleById($i);
      if ($cmp->getNombrePonts() == $cmp->getNombrePontsMax()){
        $nbVillesComplete++;
      }
    }
    if ($nbVillesComplete == $villes->getNbVilles()){
      return true;
    } else {
      return false;
    }
  }

  function estPerdue(){
    $villes = unserialize($_SESSION['villes']);
    for ($i = 0; $i < $villes->getNbVilles(); $i++){
      $cmp = $villes->getVilleById($i);
      if ($cmp->getNombrePonts() > $cmp->getNombrePontsMax()){
        return true;
      }
    }
    return false;
  }

  function affichageResultat($etatPartie){
    if ($etatPartie == "false" || $etatPartie == "abandonner"){
      $this->modeleStats->ajouteNouvellePartiePerdue($_SESSION["pseudo"]);
    } elseif ($etatPartie == "true"){
      $this->modeleStats->ajouteNouvellePartieGagne($_SESSION["pseudo"]);
    }
    $ratioJoueur = $this->modeleStats->getRatioParties($_SESSION["pseudo"]);
    $leaderboardRatios = $this->modeleStats->getLeaderboardRatio();
    $leaderboardPartiesWins = $this->modeleStats->getLeaderboardPartiesGagnees();
    $this->vue->affichageResultat($etatPartie, $ratioJoueur, $leaderboardRatios, $leaderboardPartiesWins);
  }
}
?>
