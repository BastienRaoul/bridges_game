<?php

class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }

  public function afficher(){
    return $this->chaine;
  }

}

class ConnexionException extends MonException{}

class TableAccesException extends MonException{}

class Modele {
private $connexion;

  public function __construct(){
   try{
     $chaine="mysql:host=".HOST.";dbname=".BD;
     $this->connexion = new PDO($chaine,LOGIN,PASSWORD);
     $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   } catch(PDOException $e) {
     $exception=new ConnexionException("problème de connexion à la base");
     throw $exception;
   }
 }

  public function deconnexion(){
    $this->connexion=null;
  }

  public function getPseudos() {
      try {
          $statement = $this->connexion->query("SELECT pseudo from pseudonyme;");
          while ($ligne = $statement->fetch()) {
              $result[] = $ligne['pseudo'];
          }
          return($result);
      } catch (PDOException $e) {
          throw new TableAccesException("problÃƒÂ¨me avec la table pseudonyme");
      }
  }


  public function exists($username, $password) {
      $statement = $this->connexion->prepare("SELECT pseudo,motDePasse from joueurs where pseudo=? and motDePasse=?");
      $statement->bindParam(1, $pseudoParam);
      $statement->bindParam(2, $motDePasseParam);
      $pseudoParam = $username;
      $motDePasseParam = crypt($password, $password);
      $statement->execute();
      $result = $statement->fetch(PDO::FETCH_ASSOC);

      if ($result['pseudo'] != Null && $result['motDePasse']) {
          return true;
      } else {
          return false;
      }
  }
}
?>
