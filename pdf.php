<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/06/17
 * Time: 01:47
 */

require_once 'vendor/autoload.php';
require_once('vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ecole du pré vers l\'Aisne');
$pdf->SetTitle('Fiche de l\'élève');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor

// add a page
$pdf->AddPage();

$pdf->Image('img/noavatar.png', "130", "35", "50", "50");

$html = '
<center><h1> Livret scolaire </h1></center>
<div class="col-sm-6">
    Nom :
</div>
<div class="col-sm-6">
    Prénom :
</div>
<div class="col-sm-6">
    Date de naissance :
</div>
<div class="col-sm-6">
    Classe :
</div>
<div class="col-sm-6">
    Adresse CP Ville
</div>
<div class="col-sm-6">
    Email : (Parent)
</div>
<div class="col-sm-6">
    Numéro de téléphone : (parent)
</div>

<div style="height:50px;" >

</div>

<div class="offset-sm-1 col-sm-10 offset-sm-1 " >

      <table class="table" border="1">
        <thead class="thead-default">
          <tr>
            <th colspan="8"> <center> NOM categorie mere <center> </th>
          </tr>

          <thead>
                          <tr>
                            <th colspan="2">Categorie fille niv 1 </th>
                            <th colspan="2"> non-validé </th>
                            <th colspan="2"> en cours d\'acquisation </th>
                            <th colspan="2"> Validé </th>

                          </tr>
                </thead>
                <thead class="table table-bordered">
                        <tr >
                          <th colspan="7" style="text-align : center;">Categorie fille niv 2 </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>


                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>

                <thead  class="table table-bordered">
                        <tr>
                            <td colspan="4" style="text-align : right;">  Nom observable </td>
                            <td > </td>
                            <td >  </td>
                            <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                        </tr>
                </thead>
                      <thead  class="table table-bordered">
                              <tr>
                                <td colspan="4" style="text-align : right;">  Nom observable </td>
                                <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                                <td >  </td>
                                <td > </td>
                              </tr>
                      </thead>

          </thead>
      </table>


      <table class="table">
        <thead class= "thead-inverse ">
          <tr>
            <th colspan="7"> <center> NOM categorie mere <center> </th>
          </tr>

          <thead class="thead-default">
                          <tr>
                            <th colspan="4">Categorie fille niv 1 </th>
                            <th width="15%" > Validé </th>
                            <th  width="15%"  > en cours d\'acquisation </th>
                            <th  width="15%" > non-validé </th>
                          </tr>
                </thead>
                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>


                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>
                <thead  class="table table-bordered">
                        <tr>
                            <td colspan="4" style="text-align : right;">  Nom observable </td>
                            <td > </td>
                            <td >  </td>
                            <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                        </tr>
                </thead>
                      </thead>
                      <thead  class="table table-bordered">
                              <tr>
                                  <td colspan="4" style="text-align : right;">  Nom observable </td>
                                  <td > </td>
                                  <td >  </td>
                                  <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                              </tr>
                      </thead>

          </thead>
      </table><table class="table">
        <thead class= "thead-inverse ">
          <tr>
            <th colspan="7"> <center> NOM categorie mere <center> </th>
          </tr>

          <thead class="thead-default">
                          <tr>
                            <th colspan="4">Categorie fille niv 1 </th>
                            <th width="15%" > Validé </th>
                            <th  width="15%"  > en cours d\'acquisation </th>
                            <th  width="15%" > non-validé </th>
                          </tr>
                </thead>
                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>


                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>
                <thead  class="table table-bordered">
                        <tr>
                            <td colspan="4" style="text-align : right;">  Nom observable </td>
                            <td > </td>
                            <td >  </td>
                            <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                        </tr>
                </thead>
                      </thead>
                      <thead  class="table table-bordered">
                              <tr>
                                  <td colspan="4" style="text-align : right;">  Nom observable </td>
                                  <td > </td>
                                  <td >  </td>
                                  <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                              </tr>
                      </thead>

          </thead>
      </table><table class="table">
        <thead class= "thead-inverse ">
          <tr>
            <th colspan="7"> <center> NOM categorie mere <center> </th>
          </tr>

          <thead class="thead-default">
                          <tr>
                            <th colspan="4">Categorie fille niv 1 </th>
                            <th width="15%" > Validé </th>
                            <th  width="15%"  > en cours d\'acquisation </th>
                            <th  width="15%" > non-validé </th>
                          </tr>
                </thead>
                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>


                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>
                <thead  class="table table-bordered">
                        <tr>
                            <td colspan="4" style="text-align : right;">  Nom observable </td>
                            <td > </td>
                            <td >  </td>
                            <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                        </tr>
                </thead>
                      </thead>
                      <thead  class="table table-bordered">
                              <tr>
                                  <td colspan="4" style="text-align : right;">  Nom observable </td>
                                  <td > </td>
                                  <td >  </td>
                                  <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                              </tr>
                      </thead>

          </thead>
      </table>
      <table class="table">
        <thead class= "thead-inverse ">
          <tr>
            <th colspan="7"> <center> NOM categorie mere <center> </th>
          </tr>

          <thead class="thead-default">
                          <tr>
                            <th colspan="4">Categorie fille niv 1 </th>
                            <th width="15%" > Validé </th>
                            <th  width="15%"  > en cours d\'acquisation </th>
                            <th  width="15%" > non-validé </th>
                          </tr>
                </thead>
                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>


                <thead class="table table-bordered">
                        <tr >
                          <th colspan="4" style="text-align : center;">Categorie fille niv 2 </th>
                          <th  colspan="3">  </th>
                        </tr>

                </thead>

                <thead  class="table table-bordered">
                        <tr>
                          <td colspan="4" style="text-align : right;">  Nom observable </td>
                          <td > <i class="fa fa-check" aria-hidden="true"></i>  </td>
                          <td >  </td>
                          <td > </td>
                        </tr>
                </thead>
                <thead  class="table table-bordered">
                        <tr>
                            <td colspan="4" style="text-align : right;">  Nom observable </td>
                            <td > </td>
                            <td >  </td>
                            <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                        </tr>
                </thead>
                      </thead>
                      <thead  class="table table-bordered">
                              <tr>
                                  <td colspan="4" style="text-align : right;">  Nom observable </td>
                                  <td > </td>
                                  <td >  </td>
                                  <td > <i class="fa fa-check" aria-hidden="true"></i> </td>
                              </tr>
                      </thead>

          </thead>
      </table>
</div>

<div class="offset-sm-1 col-sm-10 offset-sm-1" style="border:1px solid lightgrey; height:100px" >
       Appréciation générale :
</div>

<div class="offset-sm-8 col-sm-3 offset-sm-1" style="height:10px;" >
       Date et signature de l\'enseignant :
</div>
';

$pdf->writeHTML($html, true, false, true, false, '');
// add a page
$pdf->AddPage();

// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');