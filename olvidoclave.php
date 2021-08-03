<?php 
ob_start();
session_start(); 
include_once'include/conexion.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <title>Constructorio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
  <div style="text-align: center;">
    <br>
    <img src="img/Captura.PNG" height="100">
    <br>
    <h1>Constructorio</h1>
    <form class="container-fluid col-md-3" action="olvidoclave.php" method="POST">
      <h2>¿Olvidaste tu contraseña?</h2>
      <p class="small">Ingrese el correo electrónico de su cuenta para restablecer la nueva contraseña</p>
      <div class="row my-3">
        <div class="col-xs-1 pt-1 d-none d-md-block">
          <span class="fas fa-envelope-open"></span>
        </div>
        <div class="col-md-11">
          <input type="email" name="email" placeholder="@" required class="form-control rounded-0 input-icon">
        </div>
      </div>
      <div class="row my-3">
        <div class="col-md-12">
          <button type="submit" name="olvidoclave" class="btn btn-warning btn-block">Enviar</button>
        </div>
      </div>
      <h3 style="color: red">
        <?php if (isset($_SESSION['message'])) { ?>
         <?= $_SESSION['message']?>
         <?php session_unset(); } ?>
       </h3>
       <a href="login.php">Regresar a la pagina de inicio</a>
     </form>
   </div>
 </body>
 </html>
 <?php 
 if(isset($_POST['olvidoclave'])){
  if(!empty($_POST['email'])){
    $email = $_POST['email'];
    $sentencia3 = $mysqli->prepare('SELECT * FROM usuario WHERE email = ?');
    $sentencia3->bind_param("s",$email);
    $sentencia3->execute(); 
    $res2= $sentencia3->get_result();
    $resultado2 = $res2->fetch_assoc();
    if($resultado2){
      $uniqidStr = md5(uniqid(mt_rand()));
      $sql_insertar = $mysqli->prepare("UPDATE usuario SET olvidoclave=? WHERE email=?");
      $sql_insertar->bind_param("ss",$uniqidStr,$email);
      $sql_insertar->execute();
      $mail = new PHPMailer();
      $mail->isSMTP();
      $mail->SMTPDebug = 2;
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->SMTPAuth = true;
      $mail->Username = 'sstferremaster@gmail.com';
      $mail->Password = 'vengadoresunidos';
      $mail->setFrom('sstferremaster@gmail.com', 'Admin');
      $mail->addAddress($email);
      $mail->Subject = 'Solicitud de actualizacion de contrasena';
      $mail->msgHTML('Estimado usuario con identificacion '.$resultado2['nombre'].', 
        <br/>Recientemente se envio una solicitud para restablecer una contrasena para su cuenta en el portal el Constructorio. Si esto fue un error, simplemente ignore este correo electronico y no sucedera nada.
        <br/>Para restablecer su contrasena, visite el siguiente enlace: <a href="http://localhost/constructorio/resetclave.php?fp_code='.$uniqidStr.'">http://localhost/constructorio/resetclave.php?fp_code='.$uniqidStr.'</a>
        <br/><br/>');

      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );
      if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        echo 'Message sent!';
      }

      function save_mail($mail)
      {
        $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
        $imapStream = imap_open($path, $mail->Username, $mail->Password);
        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);
        return $result;
      }
      $_SESSION['message'] = 'Por favor revise su correo electrónico, le hemos enviado un enlace de restablecimiento de contraseña a su correo electrónico registrado.';
    }else{
      $_SESSION['message'] = 'Ocurrió algún problema, inténtelo de nuevo.';
    } 
    header("Location:olvidoclave.php");
  }
}
?>
