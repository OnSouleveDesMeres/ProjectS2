<?php
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Observable.class.php';
require_once 'Categorie.class.php';
require_once 'Update.class.php';

if(isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"]) && isset($_COOKIE["profId"]) && !empty($_COOKIE["profId"])) {
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

    $html = '';

    if(isset($_GET['categorieSup']) && !empty($_GET['categorieSup']) && isset($_GET['idCatg']) && !empty($_GET['idCatg']) && isset($_GET['nom']) && !empty($_GET['nom'])){

        Update::updateCategory($_GET['idCatg'], 'LIBCATG', $_GET['nom']);
        Update::updateCategory($_GET['idCatg'], 'CAT_IDCATG', $_GET['categorieSup']);
        header('Location: panel.php');

    }

    if (isset($_GET['id'])) {
        
        
        $id = $_GET['id'];
        $categorie = Categorie::createFromId($id);

        var_dump($categorie[0]->getIdSup());

        if($categorie[0]->getIdSup() != null){
        $categorieSup = Categorie::createFromId($categorie[0]->getIdSup());
        $categories = Categorie::getAll();
        $html .= <<<HTML
        
    <div style="height:15px;"></div>
    <form name="Observable" method="GET" action="categorie.php">

            <div class="offset-md-3 col-sm-6"> 
            <label>Nom :</label>               
            </div>
            <div class="input-group offset-sm-3 col-sm-6">     
                <input class="form-control col-sm-2" name="idCatg" type="text" placeholder="{$id}" value="{$id}" readonly="readonly">       	
                <input type="text" name="nom" class="form-control" placeholder="Nom" value="{$categorie[0]->getNom()}" required>
            </div>
            <div class="offset-md-3 col-sm-6">
            <label>Catégorie :</label>  
			    <select class="form-control" name="categorieSup">
			    	<option value="{$categorieSup[0]->getId()}">{$categorieSup[0]->getNom()}</option>
HTML;
        foreach ($categories as $c) {
            $html .= '<option value="' . $c->getId() . '">' . $c->getNom() . '</option>';
        }

        $html .= <<<HTML
			</select>
		</div>
		</div>
		  </div>
            <div style="height:15px;"></div>
           <div class="input-group">
                <button id="editCatg" type="submit" class="btn btn-success offset-sm-4 col-sm-4">Valider</button>
            </div>
            
            <div style="height:15px;"></div>
        </form>

HTML;
        }
        else{
            header('Location: panel.php');
        }
    } else {
        $html .= '<h1>Erreur observable introuvable</h1>';
    }


    $w->appendContent($html);
    $w->appendContent(footer());
    echo($w->toHTML());
}
else{
    header('Location: index.php');
}