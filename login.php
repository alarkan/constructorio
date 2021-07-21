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
    <form class="container-fluid col-md-3" action="login.php" method="POST">
      <h2>Iniciar Sesi&oacute;n</h2>
      <p class="small">Por favor ingrese sus datos de acceso</p>
      <div class="row my-3">
        <div class="col-xs-1 pt-1 d-none d-md-block">
          <span class="fas fa-user"></span>
        </div>
        <div class="col-md-11">
          <input name="nombre_usuario" type="text" placeholder="Ingrese su Usuario" required autofocus class="form-control rounded-0 input-icon">
        </div>
      </div>
      <div class="row my-3">
        <div class="col-xs-1 pt-1 d-none d-md-block">
          <span class="fas fa-lock"></span>
        </div>
        <div class="col-md-11">
          <input name="contrasena1" type="password" placeholder="Ingrese su Contrase&ntilde;a" required class="form-control rounded-0 input-icon">
        </div>
      </div>
      <div class="row my-3">
        <div class="col-md-12">
          <button class="btn btn-warning btn-block">Enviar</button>
        </div>
      </div>
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
?>