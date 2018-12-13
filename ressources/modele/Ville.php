<?php


class Ville{
  // permet d'identifier de manière unique la ville
  private $id;
  private $nombrePontsMax;
  private $nombrePonts;
  // un tableau associatif qui stocke les villes qui sont reliées à la ville cible et le nombre de ponts qui les relient (ce nombre de ponts doit être <=2)
  private $villesLiees;


  // constructeur qui permet de valuer les 2 attributs de la classe
  function __construct($id,$nombrePontsMax,$nombrePonts){
    $this->id=$id;
    $this->nombrePontsMax=$nombrePontsMax;
    $this->nombrePonts=$nombrePonts;
    $this->villesLiees=[];
    for ($i = 0; $i < 8; $i++){
      $this->villesLiees[$i] = 0;
    }
  }

  // sélecteur qui retourne la valeur de l'attribut id
  function getId(){
  return $this->id;
  }


  // sélecteur qui retourne la valeur de l'attribut nombrePontsMax
  function getNombrePontsMax(){
  return $this->nombrePontsMax;
  }
  // sélecteur qui retourne la valeur de l'attribut nombrePonts
  function getNombrePonts(){
  return $this->nombrePonts;
  }

  //modifieur qui permet de valuer l'attribut nombrePonts
  function setNombrePonts($nb){
  $this->nombrePonts=$nb;
  }

  // Ajoute un pont entre notre ville et $ville
  // Si déjà deux ponts, les ponts sont enlevés
  function addPont($id) {
    if ($this->getNbPonts($id) >= 2) {
        $this->nombrePonts -= 3;
        $this->villesLiees[$id] = -1;
    }
    $this->villesLiees[$id] += 1;
    $this->nombrePonts += 1;
  }

  // Retourne le nombre de ponts (0, 1, 2) entre deux villes
  function getNbPonts($id) {
      return $this->villesLiees[$id];
  }

  // Renvoie tous les ponts depuis cette ville
  function getAllPonts() {
      return $this->villesLiees;
  }
  // Permet de savoir si une ville possède le nombre de pont qu'elle requière
  function estComplete() {
      return $this->nombrePonts == $this->nombrePontsMax;
  }

  //il faut ici implémenter les méthodes qui permettent de lier des villes entre elles, ...

}
