<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/06/17
 * Time: 10:07
 */

require_once 'webpage.class.php';
require_once 'Validation.class.php';
require_once 'Observable.class.php';
require_once 'Eleve.class.php';
require_once 'navbar.php';
require_once 'footer.php';

if(isset($_COOKIE['profId']) && !empty($_COOKIE['profId'])){

    if ((isset($_GET['id']) && !empty($_GET['id'])) || (isset($_COOKIE['observable']) && !empty($_COOKIE['observable']))){

        $id = null;
        if (isset($_GET['id']) && !empty($_GET['id'])){
            setcookie('observable', $_GET['id'], 0);
            $id = $_GET['id'];
        }
        elseif (isset($_COOKIE['observable']) && !empty($_COOKIE['observable'])){
            $id = $_COOKIE['observable'];
        }

        $obs = Observable::createFromId($id);

        $datas = null;

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

        $html = new WebPage('Valider une observalbe');

        $html->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
        $html->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
        $html->appendCssURL('css/style-accueil.css');
        $html->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
        $html->appendContent(navbar());
        $html->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
        $html->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
        $html->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
        $html->appendJsURL('js/javascript.js');

        $page =<<<HTML
<div style="height:25px;"></div>
<div class="row">
    <div class="offset-md-2 col-md-8 offset-md-2 offset-sm-2 col-sm-8 offset-sm-2">
        <h1 class="text-center">Validation : {$obs[0]->getNom()} pour un groupe d'élèves</h1>
    </div>
    <div style="height:25px;"></div>
    <div class="offset-md-2 col-md-8 offset-md-2 offset-sm-2 col-sm-8 offset-sm-2">
        <div style="height:25px;"></div>
        <form method="get" action="observableForStudent.php" class="class="form-group"col-sm-4">
            <select name="search" class="form-control" id="classe">
                <option value="" disabled selected>Chercher par classe</option>
                <option value="1">Petite section</option>
                <option value="2">Moyenne section</option>
                <option value="3">Grande section</option>
            </select>
        </form>
    </div>
</div>
HTML;

        $select =<<<HTML
            <select name="level" class="form-control" id="level" required>
                <option value="1">Non acquis</option>
                <option value="2">En cours d'acquisition</option>
                <option value="3">Acquis</option>
            </select>
HTML;


        $html->appendContent($page);
        if ($datas != null){
            $check = '<div style="height:40px;"></div><div class="col-sm-12 offset-md-2 col-md-8"><form action="validateObs.php" method="post"><div class="row"><div class="col-md-6"><input type="checkbox" name="checkAll" id="checkAll"/> Tout cocher';
            foreach ($datas as $data){
                    $check .= "<div><input type='checkbox' name='{$data->getId()}' value='{$data->getId()}'/>{$data->getNom()} {$data->getPrenom()}</div>";
            }
            $check .= "</div><div class='col-md-5'>{$select}<div style='height:50px;'></div><button type='submit' class='btn btn-primary offset-md-3'>Valider</button></div></form></div></div><div style='height:80px;'></div>";

            $html->appendContent($check);
        }

        $html->appendContent(footer());

        $html->appendContent('<script type="text/javascript">
  jQuery(function() {
    jQuery("#classe").change(function() {
        this.form.submit();
    });
});
$("#checkAll").click(function(event) {   
if(this.checked) {
    // Iterate each checkbox
    $(":checkbox").each(function() {
        this.checked = true;                        
    });
}
});
</script>');

        echo $html->toHTML();

    }
    else{
        header('panel.php');
    }

}
else{
    header('Location: login.php');
}