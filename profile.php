<?php
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Professeur.class.php';

$w = new Webpage('Profile');

$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style-accueil.css');
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
$w->appendContent(navbar());
$w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
$w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
$w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
$w->appendJsURL('js/javascript.js');

$html = "";


if (isset($_COOKIE["profId"]) && !empty($_COOKIE["profId"])){
    $professeur = Professeur::createFromId($_COOKIE["profId"]);


$html = <<<HTML

<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <title>Administration</title>
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <link rel="stylesheet" href="bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css">
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style-profile.css">
    </head>
    <body>

    <main>
        <div style="height:55px;"></div>
        <h1 class="offset-sm-2">Édition de votre profil :</h1>
        <div style="height:15px;"></div>

        <form name="Profil" method="GET" action="updateProfil.php">

            <div class="offset-md-3 col-sm-6">
                <center><img src="img/noavatar.png"  alt="photoprofil" width="20%" class="img-circle" name="profil" accept="image/*"></center>
                <div style="height:25px;"></div>
                <center>
                    <div class="fileUpload btn btn-primary">
                        <input type="file" class="upload">
                    </div>
                </center>
            </div>

            <div class="input-group offset-sm-3 col-sm-6">
                <span class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                <input type="text" name="nom" class="form-control" placeholder="Nom" value="{$professeur[0]->getNom()}" required>
            </div>



            <div class="input-group offset-sm-3 col-sm-6">
                <span class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="{$professeur[0]->getPrenom()}" required>
            </div>

            <div class="input-group offset-sm-3 col-sm-6">
                <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                <input type="date" name="datens" class="form-control" placeholder="Date de naissance (AAAA-MM-JJ)" value="{$professeur[0]->getDateNaissance()}"required pattern="((?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))">
            </div>

            <div class="input-group offset-sm-3 col-sm-6">
                <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                <input type="email" name="email" class="form-control" value="{$professeur[0]->getEmail()}" placeholder="unemail@exemple.com">
            </div>

            <div class="input-group offset-sm-3 col-sm-6">
                <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                <input type="tel"  name="telephone" class="form-control" value="{$professeur[0]->getNumeroTel()}" placeholder="N° de téléphone" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" required>
            </div>

            <div  class="input-group offset-sm-3 col-sm-6">
                <span class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                <input type="text" name="rue" class="form-control" aria-label="adresse" value="{$professeur[0]->getRue()}" placeholder="Adresse" required>
                <input type="text" name="cp" class="form-control" placeholder="Code postal" value="{$professeur[0]->getCodePostal()}" pattern="[0-9]{5}" required>
                <input type="text" name="ville" class="form-control" aria-label="ville" placeholder="Ville" value="{$professeur[0]->getVille()}" required>
            </div>

            <div class="input-group">
                <button id="editeleve" type="submit" class="btn btn-success offset-sm-4 col-sm-4">Valider</button>
            </div>

            <div style="height:15px;"></div>
        </form>

    </main>-


HTML;

		$html .= '</div>';
}

$html.= "<script>$('.collapse').collapse('hide')</script>";
$w->appendContent($html);
$w->appendContent(footer());
echo ($w->toHTML());
