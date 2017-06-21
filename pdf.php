<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/06/17
 * Time: 01:47
 */

require_once 'vendor/autoload.php';
require_once('vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');
require_once 'Eleve.class.php';
require_once 'Categorie.class.php';
require_once 'Observable.class.php';
require_once 'Classe.class.php';
require_once 'Validation.class.php';
require_once 'functionSelect.php';

if (isset($_COOKIE['profId']) && !empty($_COOKIE['profId'])){

    $mois = date('n');
    $annee2 = date('Y');
    $annee1 = $annee2 - 1;
    if($mois >= 9 && $mois < 12){
        $annee1 = date('Y');
        $annee2 = $annee1 + 1;
    }

    $tab ='';

    if (isset($_GET['id']) && !empty($_GET['id'])){

        $id = $_GET['id'];

        $student = Eleve::createFromId($id);

        if($student != null) {

            $imgPath = "img/noavatar.png";
            if($student[0]->getImgPath() != null){
                $imgPath = $student[0]->getImgPath();
            }
            $categories = Categorie::getFirst();
            $classe = Classe::createFromId($student[0]->getIdClass());


            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Ecole du pré vers l\'Aisne');
            $pdf->SetTitle("Fiche de {$student[0]->getNom()}");

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            $pdf->setPrintFooter(false);
            $pdf->setPrintHeader(false);

            // set margins
            $pdf->SetMargins(10, 10, 10);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, 10);

            // add a page
            $pdf->AddPage();

            $pdf->Image($imgPath, "130", "40", "50", "50");

            //génération de la table

            $tab = '<table style="border: 1px solid black;">';

            $catg = Categorie::getFirst();

            $catg = $catg[0]->getCatg();

//Pour toutes catg mères
            foreach ($catg as $category){
                $tab .= '<tr><th colspan="12" style="background-color: #000000;"><p style="color: #FFFFFF; text-align: center">'.$category->getNom().'</p></th></tr>';
                $categories = $category->getCatg();
                if(count($categories) == 0){
                    $obs = $category->getObs();
                    foreach ($obs as $o){
                        $tab .= '<tr><td colspan="1"></td><td colspan="5">'.$o->getNom().'</td>';
                        $num = Validation::createFrom2Param($id, $o->getId());
                        $tab .= selectContentPDF($num[0]->getValide());
                    }

                }
                else{
                    foreach ($categories as $categorie){
                        $tab .= '<tr style="background-color: #eceeef"><td colspan="6" style="border-right: 1px solid black; border-left: 1px solid black;"><p style="text-align: left;"> '.$categorie->getNom().'</p></td>
<td colspan="2" style="border-right: 1px solid black; border-left: 1px solid black;"><p style="text-align: center;">Non acquis</p></td>
<td colspan="2" style="border-right: 1px solid black; border-left: 1px solid black;"><p style="text-align: center;">En cours d\'acquisition</p></td>
<td colspan="2" style="border-right: 1px solid black; border-left: 1px solid black;"><p style="text-align: center;">Acquis</p></td></tr>';
                        $catgF = $categorie->getCatg();
                        if(count($catgF) == 0) {
                            $obs = $categorie->getObs();
                            foreach ($obs as $o) {
                                $tab .= '<tr><td colspan="1" style="border-bottom: 1px solid black; border-top: 1px solid black;"></td><td colspan="5" style="border-bottom: 1px solid black; border-top: 1px solid black;">'.$o->getNom().'</td>';
                                $num = Validation::createFrom2Param($id, $o->getId());
                                $tab .= selectContentPDF($num[0]->getValide());
                            }
                        }

                        else{
                            foreach ($catgF as $catfille){
                                $tab .= '<tr><td colspan="1" style="border-bottom: 1px solid black; border-top: 1px solid black;"></td><th colspan="11" style="border-bottom: 1px solid black; border-top: 1px solid black;"><p style="text-align: left;"><strong>'.$catfille->getNom().'</strong></p></th></tr>';
                                $cf = $catfille->getCatg();
                                if(count($cf) == 0) {
                                    $obs = $catfille->getObs();
                                    foreach ($obs as $o) {
                                        $tab .= '<tr><td colspan="1" style="border-bottom: 1px solid black; border-top: 1px solid black;"></td><td colspan="5" style="border-bottom: 1px solid black; border-top: 1px solid black;">'.$o->getNom().'</td>';
                                        $num = Validation::createFrom2Param($id, $o->getId());
                                        $tab .= selectContentPDF($num[0]->getValide());
                                    }
                                }

                            }
                        }
                    }
                }

            }

            $tab .= '</table>';

            $html = <<<HTML
    <center><h1> Livret scolaire école du pré vers l'Aisne {$annee1} - {$annee2}</h1></center>
    <div class="col-sm-6">
        Nom : {$student[0]->getNom()}
    </div>
    <div class="col-sm-6">
        Prénom : {$student[0]->getPrenom()}
    </div>
    <div class="col-sm-6">
        Date de naissance : {$student[0]->getDateNaissance()}
    </div>
    <div class="col-sm-6">
        Classe : {$classe[0]->getNom()}
    </div>
    <div class="col-sm-6">
        Adresse : {$student[0]->getRue()}
    </div>
    <div class="col-sm-6">
        CP : {$student[0]->getCodePostal()}
    </div>
    <div class="col-sm-6">
        Ville : {$student[0]->getVille()}
    </div>
    <div class="col-sm-6">
        Numéro de téléphone : {$student[0]->getNumeroTel()}
    </div>
    
    <div style="height:50px;" >
    
    </div>
    
    <div>
              {$tab}
    </div>
    
    <table style="border:1px solid black;">
    <tr>
    <th>Appréciation générale</th><th></th>
    </tr>
    <tr>
    <td></td>
    </tr>
    <tr>
    <td></td>
    </tr>
    <tr>
    <td></td>
    </tr>
    <tr>
    <td></td>
    </tr>
    </table>
    
    <div class="offset-sm-8 col-sm-3 offset-sm-1" style="height:10px;" >
           Date et signature de l'enseignant :
    </div>
HTML;

            $pdf->writeHTML($html, true, false, true, false, '');

            // reset pointer to the last page
            $pdf->lastPage();
            //Close and output PDF document
            $pdf->Output("{$student[0]->getNom()}{$student[0]->getPrenom()}.pdf", "I");
        }
        else{
            header('Location: panel.php');
        }
    }
    else{
        header('Location: panel.php');
    }

}
else{

    header('Location: index.php');

}