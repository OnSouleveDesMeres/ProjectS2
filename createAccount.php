<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/06/17
 * Time: 22:34
 */

require_once 'PHPMailer/PHPMailerAutoload.php';

function emailActivation($to, $user, $pass){

    $mail = new PHPMailer;

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;



}