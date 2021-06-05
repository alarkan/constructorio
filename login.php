<?php
include_once'include/conexion.php';
session_start();
?>
<!doctype html>
  <html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Constructorio</title>
  </head>
  <body>
    <div style="text-align: center;">
      <img src="img/Captura.PNG" height="100">
      <h1>Constructorio</h1>
      <form action="login.php" method="POST">
        <h2>Iniciar Sesi&oacute;n</h2>
        <input name="nombre_usuario" type="text" placeholder="Usuario" required autofocus>
        <br>
        <input name="contrasena1" type="password" placeholder="Contrase&ntilde;a" required>
        <br>
        <br>
        <input type="submit" name="login" value="Entrar">
        <br>
        <br>
        <h3 style="color: red">
          <?php if (isset($_SESSION['message'])) { ?>
           <?= $_SESSION['message']?>
           <?php session_unset(); } ?>
         </h3>
       </form>
     </div>
   </body>
   </html>
   <?php
   if($_POST){
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena1'];
    $sentencia = $mysqli->prepare("SELECT * FROM usuario WHERE nombre = ?");
    $sentencia->bind_param("s", $nombre_usuario);
    $sentencia->execute();  
    $resultado = $sentencia->get_result();
    $fila = $resultado->fetch_assoc();
    if (!$fila) {
      $_SESSION['message'] = 'El usuario '.$nombre_usuario.' no existe';
      header('location:login.php');
      die();
    }

    if (password_verify($contrasena, $fila['contrasena'])) {
      $_SESSION['usuario'] = $nombre_usuario;
      header('location:home.php');

    }else{
      $_SESSION['message'] = 'Verificar la contrase&ntilde;a';
      header('location:login.php');
    }
  }