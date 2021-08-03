<?php 
ob_start();
session_start(); 
include_once'include/conexion.php';
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
    <form class="container-fluid col-md-3" action="resetclave.php" method="POST">
      <h2>Restablecer la contraseña de su cuenta</h2>
      <p class="small">Por favor ingrese sus datos de acceso</p>
      <div class="row my-3">
        <div class="col-xs-1 pt-1 d-none d-md-block">
          <span class="fas fa-lock"></span>
        </div>
        <div class="col-md-11">
          <input type="password" name="password" placeholder="Contraseña" equired autofocus class="form-control rounded-0 input-icon">
        </div>
      </div>
      <div class="row my-3">
        <div class="col-xs-1 pt-1 d-none d-md-block">
          <span class="fas fa-lock"></span>
        </div>
        <div class="col-md-11">
          <input type="password" name="confirm_password" placeholder="Confirmar contraseña" required class="form-control rounded-0 input-icon">
        </div>
      </div>
      <div class="row my-3">
        <div class="col-md-12">
          <button class="btn btn-warning btn-block">Enviar</button>
        </div>
      </div>
      <input type="hidden" name="fp_code" value="<?php echo $_REQUEST['fp_code']; ?>"/>
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

 if($_POST){
  $fp_code = '';

  if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
    $fp_code = $_POST['fp_code'];
    $nueva = $_POST['password'];
    $nuevaclave = password_hash($nueva, PASSWORD_DEFAULT);

    if($_POST['password'] !== $_POST['confirm_password']){
      $_SESSION['message'] = 'Confirme que las contraseñas deben coincidir.'; 

    }else{
      $sql3 = $mysqli->prepare('SELECT * FROM usuario WHERE olvidoclave = ?');
      $sql3->bind_param("s",$fp_code);
      $sql3->execute();
      $resultado3 = $sql3->get_result();
      $resultado3= $resultado3->fetch_assoc();

      if($resultado3){
        $sql_editar2 = $mysqli->prepare('UPDATE usuario SET contrasena=? WHERE olvidoclave=?');
        $sql_editar2->bind_param("ss",$nuevaclave,$fp_code);
        $sql_editar2->execute();
        $resultado4 = $sql_editar2->get_result();

        if(!$resultado4){
          $_SESSION['message'] = 'La contraseña de su cuenta se ha restablecido correctamente. Inicie sesión con su nueva contraseña.';

        }else{
          $_SESSION['message']= 'Ocurrió algún problema, inténtelo de nuevo.';
        }

      }else{
        $_SESSION['message'] = 'No tiene autorización para restablecer la nueva contraseña de esta cuenta.';
        header("Location:resetclave.php");
      }
    }
  }
  $redirectURL = 'resetclave.php?fp_code='.$fp_code;
  header("Location:".$redirectURL);
} 
?>