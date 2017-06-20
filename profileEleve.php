<?php
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Eleve.class.php';
require_once 'Categorie.class.php';

if(isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"]) && isset($_COOKIE["profId"]) && !empty($_COOKIE["profId"])) {
    $w = new Webpage('Elève');

    $w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
    $w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
    $w->appendCssURL('css/style-profile.css');
    $w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
    $w->appendContent(navbar());
    $w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
    $w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
    $w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
    $w->appendJsURL('js/javascript.js');

    $html = "";
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $eleve = Eleve::createFromId($id);

        $imgUser = $eleve[0]->getImgPath();

        if ($imgUser == null) {
            $imgUser = "img/noavatar.png";
        }

        $html .= <<<HTML

<main>
            <div style="height:55px;"></div>
            <h1 class="offset-sm-2">Édition du profil de l'élève {$eleve[0]->getNom()} {$eleve[0]->getPrenom()} :</h1>
            <div style="height:15px;"></div>

            <form method="post" action="updateStudent.php" enctype="multipart/form-data">
            
                <div class="offset-md-3 col-sm-6">
                    <center><img src="{$imgUser}"  alt="photoprofil" width="20%" class="img-circle" name="profil"></center>
                    <div style="height:25px;"></div>
                    <center> 
                        <div class="fileUpload btn btn-primary">
                        <input type="file" class="upload" name="avatar">
                        </div>
                    </center>
                </div>

                <div class="input-group offset-sm-3 col-sm-6">
                    <span class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                    <input class="form-control" name="idEleve" type="text" placeholder="{$id}" value="{$eleve[0]->getId()}" readonly="readonly">
                    <span class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                    <input type="text" name="nom" class="form-control" placeholder="Nom" value="{$eleve[0]->getNom()}" required>
                    <span class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="{$eleve[0]->getPrenom()}" required>
                </div>

                <div class="input-group offset-sm-3 col-sm-6">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input type="date" name="datens" class="form-control" placeholder="Date de naissance (YYYY-MM-DD)" value="{$eleve[0]->getDateNaissance()}" required pattern="((?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))}">
                    <select class="custom-select" name="classe" required="" value="{$eleve[0]->getIdClass()}">
                        <option value="{$eleve[0]->getIdClass()}">Choisissez une classe</option>
                        <option value="1">Petite section</option>
                        <option value="2">Moyenne section</option>
                        <option value="3">Grande section</option>
                    </select>
                </div>

                <div class="input-group offset-sm-3 col-sm-6">
                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    <input type="email" name="email" class="form-control" value="{$eleve[0]->getEmail()}" placeholder="unemail@exemple.com">
                    <input type="email" name="email2" class="form-control" value="{$eleve[0]->getEmail2()}" placeholder="unemail2@exemple.com">
                </div>

                <div class="input-group offset-sm-3 col-sm-6">
                    <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                    <input type="tel"  name="telephone" class="form-control" placeholder="N° de téléphone" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" value="{$eleve[0]->getNumeroTel()}" required>
                    <input type="tel"  name="telephone2" class="form-control" placeholder="N° de téléphone 2" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$ value="{$eleve[0]->getNumeroTel2()}"">
                </div>

                <div  class="input-group offset-sm-3 col-sm-6">
                    <span class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                    <input type="text" name="rue" class="form-control" aria-label="adresse" placeholder="Adresse" value="{$eleve[0]->getRue()}" required>
                    <input type="text" name="cp" class="form-control" placeholder="Code postal" pattern="[0-9]{5}" value="{$eleve[0]->getCodePostal()}" required>
                    <input type="text" name="ville" class="form-control" aria-label="ville" placeholder="Ville" value="{$eleve[0]->getVille()}" required>
                </div>
                <div class="input-group offset-sm-3 col-sm-6">
                    <span class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                    <input type="text" name="rue2" class="form-control" aria-label="adresse" placeholder="Adresse 2" value="{$eleve[0]->getRue2()}">
                    <input type="text" name="cp2" class="form-control" placeholder="Code postal 2" pattern="[0-9]{5}" value="{$eleve[0]->getCodePostal2()}">
                    <input type="text" name="ville2" class="form-control" aria-label="ville" placeholder="Ville 2" value="{$eleve[0]->getVille2()}">
                </div>

                <div class="input-group">
                    <button id="editeleve" type="submit" class="btn btn-success offset-sm-4 col-sm-4">Valider</button>
                </div>

                <div style="height:15px;"></div>
            </form>
HTML;

    } else {
        $html .= 'Elève introuvable';
    }

    $w->appendContent($html);
    $w->appendContent(footer());
    echo($w->toHTML());
}
else{
    header('Location: login.php');
}