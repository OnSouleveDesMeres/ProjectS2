<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/06/17
 * Time: 21:02
 */
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Eleve.class.php';
require_once 'Categorie.class.php';
require_once 'Insert.class.php';
require_once 'Professeur.class.php';
require_once 'contentAdmin.php';
require_once 'createAccount.php';
require_once 'myPDO.class.php';
require_once 'randomGenerator.php';
require_once 'initObsStudent.php';
require_once 'Update.class.php';

if(isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"]) && isset($_COOKIE["profId"]) && !empty($_COOKIE["profId"])){

    $datas = null;

    if (isset($_GET) && !empty($_GET)) {
        if (isset($_GET["deleteStudent"]) && !empty($_GET["deleteStudent"])) {
            $requete = <<<SQL
    DELETE FROM ELEVE WHERE IDELEVE = ?
SQL;

            $pdo = myPDO::getInstance()->prepare($requete);

            $pdo->execute(array($_GET["deleteStudent"]));

        }
        if (isset($_GET["deleteObs"]) && !empty($_GET["deleteObs"])) {
            $requete = <<<SQL
    DELETE FROM OBSERVABLE WHERE IDOBS = ?
SQL;

            $pdo = myPDO::getInstance()->prepare($requete);

            $pdo->execute(array($_GET["deleteObs"]));

        }
        if (isset($_GET["deleteCatg"]) && !empty($_GET["deleteCatg"])) {
            $requete = <<<SQL
    DELETE FROM CATEGORIE WHERE IDCATG = ?
SQL;

            $pdo = myPDO::getInstance()->prepare($requete);

            $pdo->execute(array($_GET["deleteCatg"]));

        }
        if (isset($_GET["deleteProf"]) && !empty($_GET["deleteProf"])) {
            $requete = <<<SQL
    DELETE FROM PROFESSEUR WHERE IDPROF = ?
SQL;

            $pdo = myPDO::getInstance()->prepare($requete);

            $pdo->execute(array($_GET["deleteProf"]));

        }

        if(isset($_GET['categorie']) && !empty($_GET['categorie']) && isset($_GET['nom']) && !empty($_GET['nom'])){

            Update::updateCategory($_GET['categorie'], 'LIBCATG', $_GET['nom']);

        }

            if(isset($_GET['search']) && !empty($_GET['search'])){

                        $rq =<<<SQL
SELECT *
FROM ELEVE
WHERE IDCLASSE = ?
SQL;

            $pdo = myPDO::getInstance()->prepare($rq);

            $pdo->setFetchMode(PDO::FETCH_CLASS, 'Eleve');

            $res = $pdo->execute(array($_GET['search']));

            if ($res){

                $datas = $pdo->fetchAll();

            }

        }

    }
    if (isset($_POST) && !empty($_POST)){
        if (isset($_POST["nome"]) && !empty($_POST["nome"]) && isset($_POST["prenome"]) && !empty($_POST["prenome"])
            && isset($_POST["datense"]) && !empty($_POST["datense"]) && isset($_POST["classe"]) && !empty($_POST["classe"])
            && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["ville1"]) && !empty($_POST["ville1"])
            && isset($_POST["cp1"]) && !empty($_POST["cp1"]) && isset($_POST["ad1"]) && !empty($_POST["ad1"])
            && isset($_POST["telephone"]) && !empty($_POST["telephone"])){

            Insert::insertIntoStudent($_POST["classe"], $_POST["nome"], $_POST["prenome"], $_POST["email"], $_POST["telephone"], $_POST["ville1"], $_POST["cp1"], $_POST["ad1"], $_POST["datense"], $_POST["email2"], $_POST["telephone2"], $_POST["ville2"], $_POST["cp2"], $_POST["ad2"]);
            $e = Eleve::getLastInsert();
            initObs($e[0]->getId());

        }
        if (isset($_POST["idCatg"]) && !empty($_POST["idCatg"]) && isset($_POST["nomObs"]) && !empty($_POST["nomObs"])){

            Insert::insertIntoObservable($_POST["idCatg"], $_POST["nomObs"]);
            $o = Observable::getLastInsert();
            initStud($o[0]->getId());

        }
        if (isset($_POST["idCatgSup"]) && !empty($_POST["idCatgSup"]) && isset($_POST["nomCatg"]) && !empty($_POST["nomCatg"])){

            Insert::insertIntoCategorie($_POST["idCatgSup"], $_POST["nomCatg"]);

        }
        if (isset($_POST["nomp"]) && !empty($_POST["nomp"]) && isset($_POST["prenomp"]) && !empty($_POST["prenomp"])
            && isset($_POST["datensp"]) && !empty($_POST["datensp"]) && isset($_POST["profSup"]) && !empty($_POST["profSup"])
            && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["ville"]) && !empty($_POST["ville"])
            && isset($_POST["cp"]) && !empty($_POST["cp"]) && isset($_POST["ad"]) && !empty($_POST["ad"])
            && isset($_POST["telephone"]) && !empty($_POST["telephone"])){

            Insert::insertIntoProfessor($_POST["profSup"], $_POST["nomp"], $_POST["prenomp"], $_POST["email"], $_POST["telephone"], $_POST["ville"], $_POST["cp"], $_POST["ad"], $_POST["datensp"]);
            $rnd = randomPassGenerating(25);
            $rq =<<<SQL
    SELECT *
    FROM PROFESSEUR
    WHERE NOM = ?
    AND PRNM = ?
SQL;

            $pdo = myPDO::getInstance()->prepare($rq);

            $pdo->setFetchMode(PDO::FETCH_CLASS, 'Professeur');

            if($pdo->execute(array($_POST["nomp"], $_POST["prenomp"]))){
                $d = $pdo->fetchAll();
                $id = $d[0]->getId();
                Insert::insertIntoUSer($id, sha1($rnd));
                emailActivation($_POST["email"], $id, $rnd);

            }
            else{
                throw new Exception('Erreur innopinée');
            }

        }
    }

        $html = new WebPage('Panel administratif');
        $html->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
        $html->appendCssUrl('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
        $html->appendCssUrl('font-awesome-4.7.0/css/font-awesome.min.css');
        $html->appendCssUrl('css/style-paneladmin.css');

        $html->appendContent(navbar());

        $students = Eleve::getAll();

        if($datas != null){

            $students = $datas;

        }
        $liste = '';
        foreach ($students as $eleve){

            $liste .= "<tr><td><a href='eleve.php?id={$eleve->getId()}'>{$eleve->getNom()}</a></td>
    <td><a href='eleve.php?id={$eleve->getId()}'>{$eleve->getPrenom()}</a></td><td>{$eleve->getVille()}</td>
    <td>{$eleve->getCodePostal()}</td><td>{$eleve->getRue()}</td><td>{$eleve->getEmail()}</td><td>{$eleve->getNumeroTel()}</td>
    <td>{$eleve->getDateNaissance()}</td>
    <td><a href='profileEleve.php?id={$eleve->getId()}'>Editer</a></td>
    <td><a href='panel.php?deleteStudent={$eleve->getId()}'>Supprimer</a></td>";
        }

        $observables = Observable::getAll();
        $listeObs = '';
        $catego = Categorie::getAllExpectFirst();
        foreach ($observables as $obs){
            $cat = Categorie::createFromId($obs->getIdCatg());
            $c= "<option value='{$obs->getIdCatg()}'>{$cat[0]->getNom()}</option>";
            $listeObs .= "<tr><td><a href='observableForStudent.php?id={$obs->getId()}'>{$obs->getNom()}</a></td>
            <td> <a href='categorie.php?id={$obs->getIdCatg()}' > {$cat[0]->getNom()} </a>  </td>
            <td><a href='observable.php?id={$obs->getId()}'>Modifier</a></td><td><a href='panel.php?deleteObs={$obs->getId()}'>Supprimer</a></td></tr>";
        }

        $listeCatg = '';
        $tabCatg = '';
        foreach ($catego as $category){
            $listeCatg .= "<option value='{$category->getId()}'>{$category->getNom()}</option>";
            $mere = "<option vale='{$category->getIdSup()}'>{$category->getNom()}</option>";
            $fille = $category->getNom();
            $tabCatg .= "<tr><td>{$fille}</td><td style>{$mere}</td><td><a href='categorie.php?id={$category->getId()}'>Modifier</a></td><td><a href='panel.php?deleteCatg={$category->getId()}'>Supprimer</a></td></tr>";
        }

        $content = '';
        $links = '';

        $professeur = Professeur::createFromId($_COOKIE["profId"]);
        if($professeur[0]->getIdSup() == null){
            $content = getContent();
            $links = getNavLinks();
        }
        $imgUser = $professeur[0]->getImgPath();

        if($imgUser == null){
            $imgUser="img/noavatar.png";
        }

        $page =<<<HTML
    <div class="col-sm-12">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
    
            <div style="height:25px;"></div>
    
            <center>
                <img src="{$imgUser}"  alt="photoprofil" width="50%" class="img-circle">
                <div style="height:25px;"></div>
                <a href="profile.php"><button type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Éditer le profil</button></a>
            </center>
    
            <div style="height:25px;"></div>
    
            <ul class="nav nav-pills flex-column" id="tabprincipale" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#recapeleve" role="tab" aria-controls="Récap des élèves">Récapitulatif des élèves</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ajoutereleve" role="tab" aria-controls="Ajouter un élève">Ajouter un élève</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recapobservable" role="tab" aria-controls="Modifier un élève">Récapitulatif des observables</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ajouterobservable" role="tab" aria-controls="Ajouter un observable">Ajouter un observable</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recapcatg" role="tab" aria-controls="Modifier un élève">Récapitulatif des catégories</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ajoutcatg" role="tab" aria-controls="Ajouter un observable">Ajouter une catégorie</a></li>
                {$links}
            </ul>
    
        </nav>
    
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
            <div style="height:55px;"></div>
    
            <div class="tab-content">
                <!---------------------------------------------------------->
                <div class="tab-pane active" id="recapeleve" role="tabpanel">
                    <h1>Affichage des élèves :</h1>
            
                    <div style="height:25px;"></div>
                        <div class="row">
                            <div style="overflow-x:auto;" class="col-md-5 offset-md-2" role="group" aria-label="bouton trier par...">
                                <input id="searchbarStudent" type="text" class="search form-control" placeholder="Rechercher un élève ?">
                            </div>
                            <div style="overflow-x:auto;" class="btn-group col-md-3" role="group" aria-label="bouton trier par...">
                                <form method="get" action="panel.php" class="class="form-group"col-sm-4">
                                    <select name="search" class="form-control" id="classe">
                                        <option value="" disabled selected>Chercher par classe</option>
                                        <option value="">Afficher toutes les classes</option>
                                        <option value="1">Petite section</option>
                                        <option value="2">Moyenne section</option>
                                        <option value="3">Grande section</option>
                                        <option value="4">Archive</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    <section class="row text-center placeholders">
                        <div style="overflow-x:auto;" class="col-sm-12 placeholder">
                        <table class="table table-hover" id="studentList">
                                <thead class="thead-inverse  text-center">
                                    <tr id="titleTableStudent">
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Ville</th>
                                        <th>Code Postal</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Numéro téléphone</th>
                                        <th>Date de naissance</th>
                                        <th>Editer profil</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {$liste}
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
                <!---------------------------------------------------------->
                <div class="tab-pane" id="ajoutereleve" role="tabpanel">
                    <h1>Ajouter un élève :</h1>
            
                    <div style="height:25px;"></div>
    
                    <section class="row text-center placeholders">
                        <div class="offset-sm-2 col-sm-8 offset-sm-2 placeholder">
                            <form action="panel.php" method="post">
    
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="text" name="nome" class="form-control" placeholder="Nom" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="prenome" class="form-control" placeholder="Prénom" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="date" name="datense" class="form-control" placeholder="Date de naissance (AAA-MM-JJ)" required pattern="19[0-9]{2}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="selectclasse" class="custom-select" name="classe" required>
                                            <option value="" selected>Choisissez une classe</option>
                                            <option value="1">Petite section</option>
                                            <option value="2">Moyenne section</option>
                                            <option value="3">Grande section</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4><label for="parentsepare" class="col-form-label">Parent 1</label></h4>
                                        <input type="email" name="email" class="form-control" placeholder="unemail@exemple.com">
                                    </div>
                                    <div class="col-sm-6">
                                        <h4><label for="parentsepare" class="col-form-label">(Parent 2 si séparé)</label></h4>
                                        <input type="email" name="email2" class="form-control" placeholder="unemail@exemple.com">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="tel"  name="telephone" class="form-control" placeholder="N° de téléphone" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="tel"  name="telephone2" class="form-control" placeholder="N° de téléphone" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="ville1" class="form-control" placeholder="Ville" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="ville2" class="form-control" placeholder="Ville">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="ad1" class="form-control" placeholder="Adresse" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="ad2" class="form-control" placeholder="Adresse">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="cp1" class="form-control" placeholder="Code postal" pattern="[0-9]{5}" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="cp2" class="form-control" placeholder="Code postal" pattern="[0-9]{5}">
                                    </div>
                                </div>
                                <div>
                                    <button id="sendstudent" type="submit" class="btn btn-primary">Ajouter l'élève</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <!---------------------------------------------------------->
                <div class="tab-pane" id="recapobservable" role="tabpanel">
                    <h1>Affichage des observables :</h1>
            
                    <div style="height:25px;"></div>
    
                    <div class="tab-pane active" id="recapobservable" role="tabpanel">
    
                    <div style="height:25px;"></div>
                        <div class="row">
                            <div style="overflow-x:auto;" class="col-md-6 offset-md-3" role="group" aria-label="bouton trier par...">
                                <input id="searchbarObservable" type="text" class="search form-control" placeholder="Rechercher un observable ?">
                            </div>
                        </div>
        
                        <section class="row text-center placeholders">
                        <div style="overflow-x:auto;" class="col-sm-12 placeholder">
                        <table class="table table-hover" id="ObservableList">
                                <thead class="thead-inverse  text-center">
                                    <tr id="titleTableObservable">
                                            <th>Nom observable</th>
                                            <th>Categorie </th>
                                            <th>Modifier</th>
                                            <th>Supprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {$listeObs}
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
                <!---------------------------------------------------------->
                <div class="tab-pane" id="ajouterobservable" role="tabpanel">
                    <h1>Ajouter un observable :</h1>
            
                    <div style="height:25px;"></div>
    
                    <section class="row text-center placeholders">
                        <div class="offset-sm-2 col-sm-8 offset-sm-2 placeholder">
                            <form action="panel.php" method="post">
    
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <select class="custom-select" name="idCatg" required>
                                            <option value="" selected>Choisissez une catégorie</option>
                                            {$listeCatg}
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="nomObs" class="form-control" placeholder="Nom" required>
                                    </div>
                                </div>
                                <div>
                                    <button id="sendstudent" type="submit" class="btn btn-primary">Ajouter l'observable</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <!---------------------------------------------------------->
                <div class="tab-pane" id="recapcatg" role="tabpanel">
                    <h1>Affichage des catégories :</h1>
            
                    <div style="height:25px;"></div>
                        <div class="row">
                            <div style="overflow-x:auto;" class="col-md-6 offset-md-3" role="group" aria-label="bouton trier par...">
                                <input id="searchbarCategory" type="text" class="search form-control" placeholder="Rechercher une catégorie ?">
                            </div>
                        </div>
    
                    <div class="tab-pane active" id="recapcatg" role="tabpanel">

                        <section class="row text-center placeholders">
                            <div style="overflow-x:auto;" class="col-sm-12 placeholder">
                        <table class="table table-hover" id="CategoryList">
                                <thead class="thead-inverse  text-center">
                                    <tr id="titleTableCategory">
                                            <th>Nom catégorie</th>
                                            <th>Catégorie mère</th>
                                            <th>Modifier</th>
                                            <th>Supprimer</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        {$tabCatg}
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
                <!---------------------------------------------------------->
                <div class="tab-pane" id="ajoutcatg" role="tabpanel">
                    <h1>Ajouter une catégorie :</h1>
            
                    <div style="height:25px;"></div>
    
                    <section class="row text-center placeholders">
                        <div class="offset-sm-2 col-sm-8 offset-sm-2 placeholder">
                            <form action="panel.php" method="post">
    
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <select class="custom-select" name="idCatgSup" required>
                                            <option value="" selected>Choisissez une catégorie mère</option>
                                            {$listeCatg}
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="nomCatg" class="form-control" placeholder="Nom" required>
                                    </div>
                                </div>
                                <div>
                                    <button id="sendstudent" type="submit" class="btn btn-primary">Ajouter la catégorie</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            
                {$content}
                <!---------------------------------------------------------->
            </div>
    
        </main>
    </div>
HTML;


        $html->appendContent($page);

        $html->appendContent(footer());

        $html->appendJsUrl('https://code.jquery.com/jquery-3.1.1.slim.min.js');
        $html->appendJsUrl('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
        $html->appendJsUrl('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js');
        $html->appendJsUrl('js/javascript.js');
        $html->appendContent('<script type="text/javascript">
  jQuery(function() {
    jQuery("#classe").change(function() {
        this.form.submit();
    });
});
</script>');

        echo $html->toHTML();

}
else{

    header('Location: login.php');

}
