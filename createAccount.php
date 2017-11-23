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

    $mail->Username = 'compte.asfeld@gmail.com';

    $mail->Password = '6edb53506f062ec8b774f30fcd6dea3fd376a713';

    $mail->SMTPSecure = 'tls';

    $mail->Port = 587;

    $mail->setFrom('compte.asfeld@gmail.com', 'Facebook');

    $mail->addAddress($to);

    $mail->isHTML(true);

    $mail->CharSet = 'UTF-8';

    $mail->Subject = 'Un nouvel appareil s\'est connecté sur votre compte';

    $mail->Body    = "Voici vos identifiants pour le site <a href='http://ecoledupreverslaisne.tk'>ecoledupreverslaisne.tk</a> ne les divulguez surtout pas. Si vous perdez votre mot de passe, envoyez un mail au support support@ecoledupreverslaisne.com.<br>
                        =====================<br>
                        Login : {$user}<br>
                        ---------------------<br>
                        Mot de passe : {$pass}<br>
                        =====================";

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
}