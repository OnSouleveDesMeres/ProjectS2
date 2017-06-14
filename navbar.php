<?php
require_once "webpage.class.php"

function navbar() {

  $navbar = "
  <nav class='navbar navbar-toggleable-md navbar-inverse bg-inverse'>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo01' aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse' id='navbarTogglerDemo01'>
          <a class='navbar-brand' href='#''>Accueil</a>
          <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
              <li class='nav-item active'>
                  <a class='nav-link' href='#'><i class='fa fa-star' aria-hidden='true'></i> Pannel Admin</a>
              </li>
          </ul>
      </div>
    "

    if( isset(isset($_cookie["prof"]) )) {
      $navbar .=
        "  <div class='dropdown navbar-toggler-right'>
                <span> Bonjour " .
                $_cookie["prof"][0]->getPrenom()
                . " ! </span>
          </div>
        <nav>
        "
        ;


    }

    else {
     $navbar .=
     "  <div class='dropdown navbar-toggler-right'>
          <button class='btn btn-success dropdown-toggle' type='button' id='dropdownconnect' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
              <i class='fa fa-user-circle-o' aria-hidden='true'></i> Se connecter
          </button>
          <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownconnect'>
              <div class='container-fluid'>
                  <form>
                      <div class='form-group row' action='cookieConnection.php' method='POST'>
                          <input class='form-control offset-sm-1 col-sm-10 offset-sm-1' type='text' placeholder='Utilisateur' name='id' required>
                          <input class='form-control offset-sm-1 col-sm-10 offset-sm-1' type='password' placeholder='Mot de passe' name='password' required>
                          <button class='btn btn-success  offset-sm-1 col-sm-10 offset-sm-1' type='submit'>Connexion</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </nav>
  " ;
}

  return $navbar ;
}
