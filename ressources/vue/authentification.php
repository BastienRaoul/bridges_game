<?php
class Authentification {

  function demandePseudo() {
    echo '<form class = "login-form" method = "POST" action = ".">';
    echo '<input type = "text" placeholder = "Nom d\'utilisateur" name = "username"/>';
    echo '<input type = "password" placeholder = "Mot de passe" name = "password"/>';
    echo '<button type = "submit"> Connexion </button> </form>';
  }

  function errorAuthentification() {
    echo "<h1> Mauvais Pseudo ou Mauvais Password </h1> </br>";
  }
}
?>
