<?php
// cette classe ne doit pas être modifiée
require "Ville.php";

class Villes{
  private $villes;
  public function __construct(){
    $this->villes[0][0]=new Ville("0",3,0);
    $this->villes[0][6]=new Ville("1",2,0);
    $this->villes[3][0]=new Ville("2",6,0);
    $this->villes[3][5]=new Ville("3",2,0);
    $this->villes[5][1]=new Ville("4",1,0);
    $this->villes[5][6]=new Ville("5",2,0);
    $this->villes[6][0]=new Ville("6",2,0);
  }

  public function getVille($i,$j) {
    return $this->villes[$i][$j];
  }

  public function getVilles() {
    return $this->villes;
  }

  public function getNbVilles() {
    $nbVilles = 0;
    for ($x = 0; $x <= 6; $x++) {
      for ($y = 0; $y <= 6; $y++) {
        if ($this->existe($x, $y)) {
          $nbVilles++;
        }
      }
    }
    return $nbVilles;
  }

  public function getVilleById($id){
    for ($x = 0; $x <= 6; $x++) {
      for ($y = 0; $y <= 6; $y++) {
        if ($this->existe($x, $y) && $this->getVille($x, $y)->getId() == $id) {
          return $this->getVille($x, $y);
        }
      }
    }
  }

  public function getVilleX($id){
    for ($x = 0; $x <= 6; $x++) {
      for ($y = 0; $y <= 6; $y++) {
        if ($this->existe($x, $y) && $this->getVille($x, $y)->getId() == $id) {
          return $x;
        }
      }
    }
  }

  public function getVilleY($id){
    for ($x = 0; $x <= 6; $x++) {
      for ($y = 0; $y <= 6; $y++) {
        if ($this->existe($x, $y) && $this->getVille($x, $y)->getId() == $id) {
          return $y;
        }
      }
    }
  }

  public function setVille($i,$j,$nombrePonts){
  $this->villes[$i][$j]->setNombrePonts($nombrePonts);
  }

  public function existe($i,$j){
  return isset($this->villes[$i][$j]);
  }

  public function canAddPont($ville1, $ville2){
      if ($this->getVilleX($ville1) != $this->getVilleX($ville2) && $this->getVilleY($ville1) != $this->getVilleY($ville2) || $ville1 == $ville2) {
        $_SESSION['erreur'] = true;
        return false;
      } else {
        $xVille1 = $this->getVilleX($ville1);
        $xVille2 = $this->getVilleX($ville2);
        $yVille1 = $this->getVilleY($ville1);
        $yVille2 = $this->getVilleY($ville2);
        for ($i = min($yVille1, $yVille2) + 1; $i < max($yVille1, $yVille2) - 1; $i++){
          if ($this->existe($xVille1, $i)){
            if ($this->getVille($xVille1, $i) != $this->getVilleById($ville1) || $this->getVille($xVille1, $i) != $this->getVilleById($ville2)){
              $_SESSION['erreur'] = true;
              return false;
            }
          }
        }
        for ($i = min($xVille1, $xVille2) + 1; $i < max($xVille1, $xVille2) - 1; $i++){
          if ($this->existe($i, $yVille1)){
            if ($this->getVille($i, $yVille1) != $this->getVilleById($ville1) || $this->getVille($i, $yVille1) != $this->getVilleById($ville2)){
              $_SESSION['erreur'] = true;
              return false;
            }
          }
        }
        $_SESSION['erreur'] = false;
        return true;
      }
  }

  public function addPont($idVille1, $idVille2) {
    if ($this->canAddPont($idVille1, $idVille2)) {
      $ville2 = $this->getVilleById($idVille2);
      $ville1 = $this->getVilleById($idVille1);
      $this->changementPlateau($ville1, $idVille1, $ville2, $idVille2);
    }
  }

  public function changementPlateau($ville1, $idVille1, $ville2, $idVille2){
    // Verifier qu'une ville ne se trouve pas entre les 2 villes sélectionnées
    // Verifier qu'un pont ne croise pas un autre pont
    $xVille1 = $this->getVilleX($idVille1);
    $xVille2 = $this->getVilleX($idVille2);
    $yVille1 = $this->getVilleY($idVille1);
    $yVille2 = $this->getVilleY($idVille2);
    if ($xVille1 == $xVille2){ // Changement à faire verticalement
      for ($i = min($yVille1, $yVille2); $i < max($yVille1, $yVille2) - 1; $i++){
        if ($ville1->getNbPonts($idVille2) == 0){
          $_SESSION['plateau'][$xVille1][$i + 1] = '|';
        } elseif ($ville1->getNbPonts($idVille2) == 1){
          $_SESSION['plateau'][$xVille1][$i + 1] = '||';
        } else {
          $_SESSION['plateau'][$xVille1][$i + 1] = '/';
        }
      }
    } else { // Changement à faire donc horizontalement
      for ($i = min($xVille1, $xVille2); $i < max($xVille1, $xVille2) - 1; $i++){
        if ($ville1->getNbPonts($idVille2) == 0){
          $_SESSION['plateau'][$i + 1][$yVille1] = '-';
        } elseif ($ville1->getNbPonts($idVille2) == 1){
          $_SESSION['plateau'][$i + 1][$yVille1] = '=';
        } else {
          $_SESSION['plateau'][$i + 1][$yVille1] = '/';
        }
      }
    }
    $ville1->addPont($idVille2);
    $ville2->addPont($idVille1);
    if ($ville1->estComplete()){
      $_SESSION['plateau'][$xVille1][$yVille1] = 'O';
    } else {
      $_SESSION['plateau'][$xVille1][$yVille1] = 'o';
    }
    if ($ville2->estComplete()){
      $_SESSION['plateau'][$xVille2][$yVille2] = 'O';
    } else {
      $_SESSION['plateau'][$xVille2][$yVille2] = 'o';
    }
  }
}
