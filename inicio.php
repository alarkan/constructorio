<?php
ob_start();
session_start();
include_once'include/conexion.php';
if(!isset($_SESSION['usuario'])) {
	header('location:login.php');
} 
if ($_SESSION['usuario']!=$_SESSION['usuario']) {
	header('location:login.php');
}
$id = $_SESSION['usuario'];
$sentencia = $mysqli->prepare("SELECT * FROM maestro WHERE cedula=?");
$sentencia->bind_param("i", $id);
$sentencia->execute();  
$res= $sentencia->get_result();
$resultado = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Constructorio</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<style>
	@font-face{
		font-family: 'Century Gothic';
	}
	body{
		font-family: 'Century Gothic';
	}
	.text-gold{ color: #F1BD02 !important }
</style>
</head>
<body>
	<main class="col-md-12">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand"><img width="50%" height="50%" src="img/Captura.PNG"></a>
			<div class="navbar-collapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link">Bienvenido <?php echo $resultado['nombres'] ?></a>
					</li>
				</ul>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link"><?php  if (isset($_SESSION['message3'])) { ?>
							<?= $_SESSION['message3']?>
							<?php $_SESSION['message3'] = "";} ?></a>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0">
						<a href="cerrar_sesion.php">Cerrar Sesi&oacute;n</a>
					</form>
				</div>
			</nav>
			<div class="row">
				<div class="col-lg-4 col-md-12 container-fluid px-5">
					<img src="img/logo-constructorio.png" class="img-fluid px-5">
					<form action="inicio.php" method="POST" >
						<table class="table table-striped table-bordered">
							<tbody>
								<tr>
									<td><label>Cedula:</label></td>
									<td><input class="form-control-plaintext" readonly name="cedula" type="text" value="<?php echo $resultado['cedula'] ?>"></td>
								</tr>
								<tr>
									<td><label>Nombres:</label></td>
									<td><input class="form-control-plaintext" readonly name="nombres" type="text" value="<?php echo $resultado['nombres'] ?>"></td>
								</tr>
								<tr>
									<td><label>Apellidos:</label></td>
									<td><input class="form-control-plaintext" name="apellidos" type="text" value="<?php echo $resultado['apellidos'] ?>"></td>
								</tr>
								<tr>
									<td><label>Correo:</label></td>
									<td><input class="form-control" name="correo" type="text" value="<?php echo $resultado['correo'] ?>"></td>
								</tr>
								<tr>
									<td><label>Telefono:</label></td>
									<td><input class="form-control" name="telefono" type="text" value="<?php echo $resultado['telefono'] ?>"></td>
								</tr>
								<tr>
									<td><label>Ocupacion:</label></td>
									<td>
										<select  class="form-control" name="ocupacion">
											<option value="<?php echo $resultado['ocupacion']?>"><?php echo $categorias[$resultado['ocupacion'] - 1] ?></option>
											<?php for ($i=0; $i < 15; $i++): ?>
												<option value="<?php echo $i+1;?>"><?php echo $categorias[$i];?></option>
											<?php endfor ?>
										</select>
									</td>
								</tr>
								<tr>
									<td><label>Ciudad:</label></td>
									<td>
										<select class="form-control" name="ciudad">
											<option value="<?php echo $resultado['ciudad'] ?>"><?php echo $resultado['ciudad'] ?></option>
											<?php $count = count($valleCauca); for ($i=0; $i < $count; $i++): ?>
											<option value="<?php echo $valleCauca[$i];?>"><?php echo $valleCauca[$i];?></option>
										<?php endfor ?>
									</select>
								</td>
							</tr>
							<tr>
								<td><label>Especialidad:</label></td>
								<td><input class="form-control" name="especialidad" type="text" value="<?php echo $resultado['especialidad'] ?>"></td>
							</tr>
							<input name="id" type="hidden" value="<?php echo $resultado['id'] ?>">
						</tbody>
						<tfoot>
							<tr><td style="text-align: center;" colspan="2"><button class="btn btn-warning" name="actualizardatos" type="submit">Actualizar Datos</button></td></tr>
						</tfoot>
					</table>	
				</form>
			</div>

			<div class="col-md-8 container-fluid px-5">
				<form action="inicio.php" method="POST" enctype="multipart/form-data">
					<h4 class="text-gold">Foto de Perfil</h4>
					<img class="img-thumbnail" style="height: 200px;width: 200px;"src="img/maestros/<?php echo $resultado['imagen'] ?>">
					<div class="input-group mb-3">
						<div class="custom-file">
							<input type="file" name="archivo">
						</div>
						<div class="input-group-prepend">
							<button class="btn btn-warning" name="actualizarfoto" type="submit">Actualizar Foto de perfil</button>
						</div>
					</div>
					<input name="identificador" type="hidden" value="<?php echo $resultado['id'] ?>">
				</form>
				<form action="inicio.php" method="POST" enctype="multipart/form-data">
					<h4 class="text-gold">Trabajos Realizados</h4>

					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Informacion Importante:</strong> Si cargas nuevas imagenes borraras las anteriores
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php 
					$datos = unserialize($resultado['fotos']);
					for ($i=0; $i < count($datos); $i++):?>
						<img class="img-thumbnail" src="<?php echo "img/maestros/".$datos[$i] ?>" style="height: 200px;width: 200px;">
					<?php endfor ?>
					<div class="input-group mb-3">
						<div class="custom-file">
							<input required class="form-control" type="file" multiple name="file[]">
						</div>
						<div class="input-group-prepend">
							<button class="btn btn-warning" name="actualizartrabajos" type="submit">Actualizar Foto de Trabajos</button>
						</div>
					</div>
					<input name="identificador" type="hidden" value="<?php echo $resultado['id'] ?>">
				</form>
			</div>
		</div>
	</main>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>

<?php
if(isset($_POST['actualizardatos'])){
	$cedula = $_POST['cedula'];
	$id = $_POST['id'];
	$nombres= $_POST['nombres'];
	$apellidos= $_POST['apellidos'];
	$telefono= $_POST['telefono'];
	$correo= $_POST['correo'];
	$ocupacion= $_POST['ocupacion'];
	$ciudad= $_POST['ciudad'];
	$especialidad= $_POST['especialidad'];
	$estado= 0;
	$sentencia2 = $mysqli->prepare("UPDATE maestro SET nombres=?,apellidos=?,correo=?,telefono=?,ocupacion=?,ciudad=?,especialidad=?, estado=? WHERE id=?");
	$sentencia2->bind_param("ssssissis",$nombres,$apellidos,$correo,$telefono,$ocupacion,$ciudad,$especialidad,$estado,$id);
	$sentencia2->execute();
	$_SESSION['message3'] ="<script type='text/javascript'>alert('Actualizacion Exitosa');</script>";
	header('location:inicio.php');

}elseif(isset($_POST['actualizarfoto'])){
	$estado= 0;
	$id2 = $_POST['identificador'];
	$archivo = $_FILES['archivo']['name'];
	if (isset($archivo) && $archivo != "") {
		$tipo = $_FILES['archivo']['type'];
		$tamano = $_FILES['archivo']['size'];
		$temp = $_FILES['archivo']['tmp_name'];
		if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))){
			$_SESSION['message3']= "<script type='text/javascript'>alert('Error. La extensión o el tamaño de los archivos no es correcta, solo se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.');</script>";
			header("location:inicio.php");
			die();
		}
		else{
			move_uploaded_file($temp, 'img/maestros/'.time().$archivo);
			$archivo = time().$_FILES['archivo']['name'];
		}
	}else{
		$archivo = "profile-default.png";
	}
	$sentencia3 = $mysqli->prepare("UPDATE maestro SET imagen=?,estado=? WHERE id=?");
	$sentencia3->bind_param("sis",$archivo,$estado,$id2);
	$sentencia3->execute();
	var_dump($archivo);
	$_SESSION['message3'] ="<script type='text/javascript'>alert('Actualizacion Exitosa de Foto de Perfil');</script>";
	header('location:inicio.php');

}elseif(isset($_POST['actualizartrabajos'])){
	$id2 = $_POST['identificador'];
	$datos2 = unserialize($resultado['fotos']);
	$estado= 0;
	$countfiles = count($_FILES['file']['name']);
	if ($countfiles > 6) {
		$countfiles = 6;
	}
	for($i=0;$i<$countfiles;$i++){
		$filename = time().$_FILES['file']['name'][$i];

		if (isset($filename) && $filename != "") {
			$tipo2 = $_FILES['file']['type'][$i];
			$tamano2 = $_FILES['file']['size'][$i];
			$temp2 = $_FILES['file']['tmp_name'][$i];
			if (!((strpos($tipo2, "gif") || strpos($tipo2, "jpeg") || strpos($tipo2, "jpg") || strpos($tipo2, "png")) && ($tamano2 < 2000000))){
				echo "<script type='text/javascript'>alert('Error. La extensión o el tamaño de los archivos no es correcta, solo se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.');</script>";
			}
			else{
				move_uploaded_file($_FILES['file']['tmp_name'][$i],'img/maestros/'.$filename);
				$fotos[$i] = $filename;
			}
		}
	}
	for ($i=0; $i < count($datos2); $i++){
		unlink('img/maestros/'.$datos2[$i]);
	}
	$fotos = serialize($fotos);
	$sentencia4 = $mysqli->prepare("UPDATE maestro SET fotos=?,estado=? WHERE id=?");
	$sentencia4->bind_param("sis",$fotos,$estado,$id2);
	$sentencia4->execute();
	$_SESSION['message3'] ="<script type='text/javascript'>alert('Actualizacion Exitosa de Fotos de Trabajos Realizados');</script>";
	header('location:inicio.php');
}
ob_end_flush();
?>
