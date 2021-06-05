<?php
ob_start();
session_start();
include_once'include/conexion.php'; 
if ($_SESSION['usuario']!='mercadeo.palmira') {
	header('location:login.php');
}
$sentencia = $mysqli->prepare("SELECT * FROM maestro");
$sentencia->execute();  
$resultado = $sentencia->get_result();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Constructorio</title>
</head>
<body>
	<div class="container" style="text-align: center;">
		<h1>Lista de Maestros</h1>
		<input style="border:rgb(13,105,172) 5px outset;" id="buscar" type="text" placeholder="Barra de busqueda..." size="25">
		<table id="tabla" style="margin: 0 auto;" border="1">
			<thead>
				<tr> 
					<th>Cedula</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Correo</th>
					<th>Telefono</th>
					<th>Ocupacion</th>
					<th>Ciudad</th>
					<th>Especialidad</th>
					<th>Estado</th>
					<th>Editar</th>
				</tr>
			</thead>
			<tbody>
				<?php while($solicitud = $resultado->fetch_assoc()):?>
					<tr>
						<td>
							<?php echo $solicitud['cedula']; ?>
						</td>
						<td>
							<?php echo $solicitud['nombres']; ?>
						</td>
						<td>
							<?php echo $solicitud['apellidos']; ?>
						</td>
						<td>
							<?php echo $solicitud['correo']; ?>
						</td>
						<td>
							<?php echo $solicitud['telefono']; ?>
						</td>
						<td>
							<?php  echo $categorias[$solicitud['ocupacion'] - 1]; ?>
						</td>
						<td>
							<?php echo $solicitud['ciudad']; ?>
						</td>
						<td>
							<?php echo $solicitud['especialidad']; ?>
						</td>
						<td>
							<?php 
							if($solicitud['estado'] == 0){
								echo 'Pendiente';
							}else{
								echo 'Publicado';
							}
							?>
						</td>
						<td>
							<a href="editar.php?id=<?php echo $solicitud['id'];?>">Editar</a>
						</td>
					</tr>
				<?php endwhile?>
			</tbody>
		</table>
	</div>
</body>
</html>