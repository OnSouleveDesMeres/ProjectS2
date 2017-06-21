<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/06/17
 * Time: 18:31
 */

function selectContentPDF($num){
    $html = '<td colspan="2" style="border: 1px solid black"><h1 style="text-align: center;">X</h1></td>
<td colspan="2" style="border: 1px solid black"></td>
<td colspan="2" style="border: 1px solid black"></td></tr>';
    if($num == '2'){
        $html ='<td colspan="2" style="border: 1px solid black"></td>
<td colspan="2" style="border: 1px solid black"><h1 style="text-align: center;">X</h1></td>
<td colspan="2" style="border: 1px solid black"></td></tr>';
    }
    else if($num == '3'){
        $html ='<td colspan="2" style="border: 1px solid black"></td>
<td colspan="2" style="border: 1px solid black"></td>
<td colspan="2" style="border: 1px solid black"><h1 style="text-align: center;">X</h1></td></tr>';

    }

    return $html;

}