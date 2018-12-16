<?php

class ModeleStats {
  private $connexion;

  public function __construct() {
		try {
		  $chaine = "mysql:host=" . HOST . ";dbname=" . BD;
			$this->connexion = new PDO($chaine, LOGIN, PASSWORD);
			$this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			throw new ConnexionException("Problème de connexion à la base de donnée. Veuillez vérifier votre configuration.");
		}
	}

  public function deconnexion() {
	  $this->connexion = null;
	}


  public function getRatioParties($pseudo) {
      try {
          $statement = $this->connexion->prepare("select partieGagnee from parties where pseudo=?;");
          $statement->bindParam(1, $pseudo);
          $statement->execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);

              $nbPartiesGagnees = 0;
              foreach($result as $valeur){
                  $nbPartiesGagnees += $valeur['partieGagnee'];
              }
              return array("nbTotalParties"=>sizeof($result), "nbTotalPartiesGagnees"=>$nbPartiesGagnees);

      } catch (PDOException $e) {
          $this->deconnexion();
          throw new TableAccesException("Problème avec la table parties.");
      }
  }

  public function getLeaderboardRatio() {
      try {
          $statement = $this->connexion->prepare("SELECT pseudo,sum(partieGagnee) as totalPartiesGagnees, count(pseudo) as totalPartiesJouees, sum(partieGagnee)/count(pseudo) as ratio FROM parties group by pseudo order by ratio desc LIMIT 3;");
          $statement->execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);

          if(!isset($result[1])){
            $result[1] = array ( 'pseudo' => 'Personne à cette position',
            'totalPartiesGagnees' => 'Inconnu',
            'totalPartiesJouees' => 'Inconnu',
            'ratio' => 'Inconnu');
          }

          if(!isset($result[2])){
            $result[2] = array ( 'pseudo' => 'Personne à cette position',
            'totalPartiesGagnees' => 'Inconnu',
            'totalPartiesJouees' => 'Inconnu',
            'ratio' => 'Inconnu');
          }
          foreach ($result as $row) {
            $row['ratio'] = round($row['ratio'], 3);
          }
          return $result;
      } catch (PDOException $e) {
          $this->deconnexion();
          throw new TableAccesException("Problème avec la table parties.");
      }
  }
  public function getLeaderboardPartiesGagnees() {
      try {
          $statement = $this->connexion->prepare("SELECT pseudo,sum(partieGagnee) as totalPartiesGagnees, count(pseudo) as totalPartiesJouees, sum(partieGagnee)/count(pseudo) as ratio FROM parties group by pseudo order by totalPartiesGagnees desc LIMIT 3;");
          $statement->execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);
          if(!isset($result[1])){
            $result[1] = array ( 'pseudo' => 'Personne à cette position',
            'totalPartiesGagnees' => 'Inconnu',
            'totalPartiesJouees' => 'Inconnu',
            'ratio' => 'Inconnu');
          }

          if(!isset($result[2])){
            $result[2] = array ( 'pseudo' => 'Personne à cette position',
            'totalPartiesGagnees' => 'Inconnu',
            'totalPartiesJouees' => 'Inconnu',
            'ratio' => 'Inconnu');
          }
          foreach ($result as $row) {
            $row['ratio'] = round($row['ratio'], 3);
          }
          return $result;
      } catch (PDOException $e) {
          $this->deconnexion();
          throw new TableAccesException("Problème avec la table parties.");
      }
  }

  public function ajouteNouvellePartieGagne($pseudo) {
      try {
          $statement = $this->connexion->prepare("insert into parties(pseudo, partieGagnee) values(?,1)");
          $statement->bindParam(1, $pseudo);
          $statement->execute();
      } catch (PDOException $e) {
          $this->deconnexion();
          throw new TableAccesException("Problème avec la table parties.");
      }
  }

  public function ajouteNouvellePartiePerdue($pseudo) {
      try {
          $statement = $this->connexion->prepare("insert into parties(pseudo, partieGagnee) values(?,0)");
          $statement->bindParam(1, $pseudo);
          $statement->execute();
      } catch (PDOException $e) {
          $this->deconnexion();
          throw new TableAccesException("Problème avec la table parties.");
      }
  }
}

?>
