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

  public function getVille($i,$j){
    return $this->villes[$i][$j];
  }

  public function getVilles(){
    return $this->villes;
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

  public function canAddPont($ville1, $ville2)
  {
      if ($this->getVilleX($ville1) != $this->getVilleX($ville2) && $this->getVilleY($ville1) != $this->getVilleY($ville2) || $ville1 == $ville2) {
          return false;
      }
      return true;
  }

  public function addPont($ville1, $ville2) {
      if ($this->canAddPont($ville1, $ville2)) {
          $v1 = $this->getVilleById($ville1);
          $v1->addPont($ville2);
          $v2 = $this->getVilleById($ville2);
          $v2->addPont($ville1);
      }
  }

  public function toString(){
    for ($i = 0; $i <= 6; $i++){
      for ($j = 0; $j <= 6; $j++){
        if ($this->getVille($i, $j)) {
          echo "yes" . $i . $j;
        }
      }
    }
  }
}
