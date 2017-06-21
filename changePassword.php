<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/06/17
 * Time: 10:21
 */
require_once 'updatePassword.php';
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
if(isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"]) && isset($_COOKIE["profId"]) && !empty($_COOKIE["profId"])) {
    $w = new Webpage('Modification de mot de passe');
    $w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
    $w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
    $w->appendCssURL('css/style-accueil.css');
    $w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
    $w->appendContent(navbar());
    $w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
    $w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
    $w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
    $w->appendJsURL('js/javascript.js');

    $successorfail = '';

    if (isset($_COOKIE['profId']) && !empty($_COOKIE['profId']) &&
        isset($_POST['lastpass']) && !empty($_POST['lastpass']) &&
        isset($_POST['newpass']) && !empty($_POST['newpass'])
    ) {

        $successorfail = changePassword($_COOKIE['profId'], $_POST['lastpass'], $_POST['newpass']);

    }

    $html = <<<HTML
<div class="col-md-12 text-center center">
    <div class="col-md-12" style="height:50px;"></div>
    {$successorfail}
    <form name="passwordChange" method="post" action="changePassword.php">
            <h1>Modification du mot de passe</h1>
    <div class="col-md-12" style="height:50px;"></div>
            <div class="input-group offset-sm-3 col-sm-6">
                <span class="col-sm-3">Ancien mot de passe : </span>
                <input type="password" name="lastpass" class="form-control col-sm-7 offset-sm-1" placeholder="Mot de passe actuel" value="" required>
            </div>
    <div class="col-md-12" style="height:50px;"></div>
            <div class="input-group offset-sm-3 col-sm-6">
                <span class="col-sm-3">Nouveau mot de passe : </span>
                <input type="password" id="newmdp1" name="newpass" class="form-control col-sm-7 offset-sm-1" placeholder="Nouveau mot de passe" value="" required>
            </div>
    <div class="col-md-12" style="height:50px;"></div>

            <div class="input-group">
                <button id="editeleve"type="submit" class="btn btn-success offset-sm-4 col-sm-4">Valider</button>
            </div>

            <div style="height:15px;"></div>
        </form>
</div>
HTML;


    $w->appendContent($html);

    $w->appendContent(footer());
    echo $w->toHTML();
}
else{

    header("Location: index.php");

}