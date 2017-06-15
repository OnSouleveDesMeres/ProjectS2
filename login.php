<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/06/17
 * Time: 10:41
 */

require_once 'webpage.class.php';

$html = new WebPage('Login');
if(isset($_COOKIE["prof"]) && !empty($_COOKIE["prof"])){

    header("Location: index.php");

}
else{

    $html->appendCssUrl("bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css");
    $html->appendCssUrl("font-awesome-4.7.0/css/font-awesome.min.css");
    $html->appendCssUrl("css/style.css");
    $html->appendContent('<div>
      <img id="logoconnect" src="img/logo.png" alt="logo.png">
    </div>
    <div id="middle" class="col-md-4 offset-md-4">
      <div class="card card-inverse card-primary text-center">
        <div class="card-header">
          <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i> Connexion :</h2>
        </div>
        <div class="card-block">
          <form action="cookieConnection.php" method="post">
            <div class="form-group">
              <label class="control-label" for="exampleInputEmail1">Nom d\'utilisateur :</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom d\'utilisateur" name="id">
            </div>
            <div class="form-group">
              <label class="control-label" for="exampleInputPassword1">Mot de passe :</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" name="password">
            </div>
            <div class="checkbox">
              <label class="control-label">
              <input type="checkbox"> Rester connecté
              </label>
            </div>
            <button type="submit" class="btn btn-secondary">Connexion</button>
          </form>
        </div>
      </div>
    </div>');

    $html->appendContent('
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>');

}

echo $html->toHTML();

