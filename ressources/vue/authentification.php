<?php
class Authentification {

  function demandePseudo() {
    echo '<form class = "login-form" method = "POST" action = ".">';
    echo '<input type = "text" placeholder = "Nom d\'utilisateur" name = "pseudo"/>';
    echo '<input type = "password" placeholder = "Mot de passe" name = "password"/>';
    echo '<button type = "submit"> Connexion </button> </form>';
  }

  function errorAuthentification() {
    echo "<h1> Mauvais Pseudo ou Mauvais Password </h1> </br>";
  }

  function deconnexion() {
    echo "<h1> Deconnexion </h1> </br>";
  }
}
?>
