<?php
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Eleve.class.php';
require_once 'Categorie.class.php';
require_once 'Classe.class.php';

$w = new Webpage('Eleves');

$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style-accueil.css');
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
$w->appendContent(navbar());
$w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
$w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
$w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
$w->appendJsURL('js/javascript.js');

$html='';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $eleve = Eleve::createFromId($id);
    $categories = Categorie::getAll();
    $classe = Classe::createFromId($eleve[0]->getIdClass());

    $html = <<<HTML
        <div class="row">
            <div class="offset-sm-1" style="margin-top:50px;">
                <ul class="list-group">
                  <li class="list-group-item">Nom : {$eleve[0]->getNom()}</li>
                  <li class="list-group-item">Prénom : {$eleve[0]->getPrenom()}</li>
                  <li class="list-group-item">Classe : {$classe[0]->getNom()}</li>
                  <li class="list-group-item">Email : {$eleve[0]->getEmail()}</li>
                  <li class="list-group-item">Téléphone : {$eleve[0]->getNumeroTel()}</li>
                  <li class="list-group-item">Ville : {$eleve[0]->getVille()}</li>
                  <li class="list-group-item">Code postal : {$eleve[0]->getCodePostal()}</li>
                  <li class="list-group-item">Rue : {$eleve[0]->getRue()}</li>
                  <li class="list-group-item">Date de naissance : {$eleve[0]->getDateNaissance()}</li>
                  <li class="list-group-item">Email 2 : {$eleve[0]->getEmail2()}</li>
                  <li class="list-group-item">Téléphone 2 : {$eleve[0]->getNumeroTel2()}</li>
                  <li class="list-group-item">Ville 2 : {$eleve[0]->getVille2()}</li>
                  <li class="list-group-item">Code postal 2: {$eleve[0]->getCodePostal2()}</li>
                  <li class="list-group-item">Rue 2: {$eleve[0]->getRue2()}</li>
                  <li class="text-center" style="list-style:none;"><a href="profileEleve.php?id={$id}"><button class="btn btn-primary">Editer le profil de l&apos;élève</button></a></li> 
                </ul>
            </div>
            <div id="card3" class = "offset-sm-1 card" style="margin-top:50px;">
                <div class="form-group container" style="margin:10px;">
                    <form action="observableEleve.php" method="GET">
                        <div class="form-group">
                          <label>Choisissez une catégorie pour modifier les observables de l'élève :</label>
                          <select class="form-control" name="categorie"> 
HTML;

foreach ($categories as $c){
  $html .= '<option value="'.$c->getId().'">'.$c->getNom().'</option>';
}

$html .= <<<HTML
                          </select>
                          </div>
                          <button class="btn btn-primary" type="submit">Sélectionner</button>
                          <input type="text" name="id" value="{$id}" style="margin-left:-99999999px;">
                    </form>
                </div>
                <a href="" style="margin-top:50px;"><button class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Afficher en PDF</button></a>
            </div>            
        </div>
    </div>
HTML;
}
else{
    $html .= '<h1>Erreur élève introuvable</h1>';
}


$w->appendContent($html);
$w->appendContent(footer());
$w->appendJs('jQuery(function() {
    jQuery("#category").change(function() {
        this.form.submit();
    });
});');
$w->appendJs('jQuery(function() {
    jQuery("#observable").change(function() {
        this.form.submit();
    });
});');
echo ($w->toHTML());