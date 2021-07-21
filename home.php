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
	<script src="include/busqueda.js"></script>
	<script type="text/javascript">btab('buscar', 'tabla'); // Iniciamos la funcion...</script>
	<div class="container" style="text-align: center;">
		<strong>Bienvenido <?php echo $_SESSION['usuario'];?></strong>
		<br>
		<br>
		<a href="cerrar_sesion.php"><button>Cerrar Sesi&oacute;n</button></a>
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
					<th>Perfil</th>
					<th>Trabajos</th>
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
							<img src="<?php echo "img/maestros/".$solicitud['imagen']; ?>" style="height: 100px;width: 100px;">
						</td>
						<td>
							<?php 
							$datos = unserialize($solicitud['fotos']);
							for ($i=0; $i < count($datos); $i++):?>
								<img src="<?php echo "img/maestros/".$datos[$i] ?>" style="height: 100px;width: 100px;">
							<?php endfor ?>
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