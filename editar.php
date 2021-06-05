<?php
ob_start();
session_start();
include_once'include/conexion.php'; 
if ($_SESSION['usuario']!='mercadeo.palmira') {
	header('location:login.php');
}
if($_GET){
	$id = $_GET['id'];
	$sentencia = $mysqli->prepare("SELECT * FROM maestro WHERE id=?");
	$sentencia->bind_param("i", $id);
	$sentencia->execute();  
	$res= $sentencia->get_result();
	$resultado = $res->fetch_assoc();
} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Constructorio</title>
</head>
<body>
	<div class="container" style="text-align: center;">
		<h1>Editar Maestro</h1>
		<form action="editar.php" method="POST">
			<table style="margin: 0 auto;">
				<tbody>
					<tr>
						<td><label>Cedula:</label></td>
						<td><input name="cedula" type="text" value="<?php echo $resultado['cedula'] ?>"></td>
					</tr>
					<tr>
						<td><label>Nombres:</label></td>
						<td><input name="nombres" type="text" value="<?php echo $resultado['nombres'] ?>"></td>
					</tr>
					<tr>
						<td><label>Apellidos:</label></td>
						<td><input name="apellidos" type="text" value="<?php echo $resultado['apellidos'] ?>"></td>
					</tr>
					<tr>
						<td><label>Correo:</label></td>
						<td><input name="correo" type="text" value="<?php echo $resultado['correo'] ?>"></td>
					</tr>
					<tr>
						<td><label>Telefono:</label></td>
						<td><input name="telefono" type="text" value="<?php echo $resultado['telefono'] ?>"></td>
					</tr>
					<tr>
						<td><label>Ocupacion:</label></td>
						<td>
							<select name="ocupacion">
								<option value="<?php echo $resultado['ocupacion']?>"><?php echo $categorias[$resultado['ocupacion'] - 1] ?></option>
								<?php for ($i=0; $i < 15; $i++): ?>
									<option value="<?php echo $i+1;?>"><?php echo $categorias[$i];?></option>
								<?php endfor ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label>Ciudad:</label></td>
						<td><input name="ciudad" type="text" value="<?php echo $resultado['ciudad'] ?>"></td>
					</tr>
					<tr>
						<td><label>Especialidad:</label></td>
						<td><input name="especialidad" type="text" value="<?php echo $resultado['especialidad'] ?>"></td>
					</tr>
					<tr>
						<td><label>Cambiar estado:</label></td>
						<td>
							<select name="estado" id="select" required>
								<option value="0">Valor por defecto pendiente</option>
								<option value="0">Pendiente</option>
								<option value="1">Publicado</option>
							</select>
						</td>
					</tr>
					<input name="id" type="hidden" value="<?php echo $resultado['id'] ?>">
				</tbody>
			</table>
			<button type="submit">Actualizar</button>
		</form>
		<br>
		<a href="home.php">Regresar a Inicio</a>
		<?php  if (isset($_SESSION['message3'])) { ?>
			<?= $_SESSION['message3']?>
			<?php $_SESSION['message3'] = "";} ?>
		</div>
	</body>
	</html>

	<?php
	if ($_POST) {
		$id = $_POST['id'];
		$nombres= $_POST['nombres'];
		$apellidos= $_POST['apellidos'];
		$cedula= $_POST['cedula'];
		$telefono= $_POST['telefono'];
		$correo= $_POST['correo'];
		$ocupacion= $_POST['ocupacion'];
		$ciudad= $_POST['ciudad'];
		$especialidad= $_POST['especialidad'];
		$estado= $_POST['estado'];
		$sentencia2 = $mysqli->prepare("UPDATE maestro SET cedula=?,nombres=?,apellidos=?,correo=?,telefono=?,ocupacion=?,ciudad=?,especialidad=?,estado=? WHERE id=?");
		$sentencia2->bind_param("sssssissss", $cedula,$nombres,$apellidos,$correo,$telefono,$ocupacion,$ciudad,$especialidad,$estado,$id);
		$sentencia2->execute();  

		$_SESSION['message3']= "<script type='text/javascript'>alert('Actualizacion Exitosa');</script>";
		header('location:editar.php?id='.$id);	
	}
	ob_end_flush();
	?>
