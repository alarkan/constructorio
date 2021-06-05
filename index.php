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
	<style>
	body{ font-family: 'Century Gothic'; margin: 0; padding: 0 }
	#banner{ background-image: url('img/fondo-banner-3.jpg');background-size:cover;height: 100vh;background-position: center}
	#services{ background-image: url('img/fondo-azul.jpg'); background-size: cover; background-position: center}
	.nav-link img{ width: 120px }
	#last-works{ background-color: #F1BD02 }
	#video{ background-image: url('img/fondo-video.jpg'); background-size: cover; background-position: center }
	.video-container{ position: relative; padding-bottom: 50%; padding-top: 30px;  height: 0; overflow: hidden; }
	.video-container iframe,
	.video-container object,
	.video-container embed{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
	.bg-smoke{ background-color: #f3f5f9 !important }
	a.bg-smoke{text-transform: none !important;text-decoration: none !important;color: inherit !important;height: 100% !important}
	.icon-fluid{ max-width: 100px !important; max-height: 100px !important }
</style>
</head>
<body>
	<div class="container-fluid" id="banner">
		<div class="row">
			<div class="col">
				<nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary pt-3">
					<button class="navbar-toggler bg-warning" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav text-center">
							<li class="nav-item mr-3 mt-lg-0 mt-3">
								<a class="nav-link scroll" href="#services">
									<img src="img/boton-nav-inicio.png">
								</a>
							</li>
							<li class="nav-item mr-3 mt-lg-0 mt-3">
								<a class="nav-link scroll" href="#register">
									<img src="img/boton-nav-registro.png">
								</a>
							</li>
							<li class="nav-item mr-3 mt-lg-0 mt-3">
								<a class="nav-link" href="#banner">
									<img src="img/boton-nav-agendate.png">
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<div class="col">
					<img src="img/logo-constructorio.png" class="img-fluid">
				</div>
			</div>

			<div class="row ml-5 pt-5">
				<div class="col-md-4 text-center">
					<img src="img/aqui-encuentras-todo.png" class="img-fluid">
				</div>
			</div>
		</div>

		<div class="container-fluid px-0" id="services">
			<div class="container py-5">
				<div class="row">
					<?php 
					for ($i=0; $i < 15; $i++):
						?>
						<div class="col-4 p-2">
							<a href="perfil.php?category=<?php echo $i+1;?>" class="btn btn-block bg-smoke">
								<div class="row">
									<div class="col-md-3">
										<img src="img/categorias/<?php echo $i ?>.png" class="img-fluid">
									</div>
									<div class="col text-left pt-3 pr-2">
										<span class="h5"><?php echo $categorias[$i];?></span>
									</div>
								</div>
							</a>
						</div>
					<?php endfor ?>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid bg-white">
		<div class="container" id="register">
			<div class="row py-5">
				<div class="col-md-6 pr-5">
					<img src="img/se-parte-de-nuestro-constructorio.png" class="img-fluid">
				</div>
				<div class="col-md-6">
					<form method="POST" action="index.php">
						<div class="row my-3">
							<div class="col-xs-1 pt-1 d-none d-md-block">
								<span class="fas fa-key"></span>
							</div>
							<div class="col-md-11"><input required type="text" class="form-control" id="cedula" name="cedula" placeholder="N. Identificación"></div>
						</div>
						<div class="row my-3">
							<div class="col-xs-1 pt-1 d-none d-md-block">
								<span class="fas fa-user"></span>
							</div>
							<div class="col-md-5"><input required type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres"></div>
							<div class="col-md-6"><input required type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos"></div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<div class="row">
									<div class="col-xs-1 pt-1 d-none d-md-block">
										<span class="fas fa-envelope-open"></span>
									</div>
									<div class="col-md-10">
										<input required type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-xs-1 pt-1 d-none d-md-block">
										<span class="fas fa-phone"></span>
									</div>
									<div class="col-md-10">
										<input required type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
									</div>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<div class="row">
									<div class="col-xs-1 pt-1 d-none d-md-block">
										<span class="fas fa-hammer"></span>
									</div>
									<div class="col-md-10">
										
										<select required class="form-control" id="ocupacion" name="ocupacion">
											<option value="">Ocupación</option>
											<?php for ($i=0; $i < 15; $i++): ?>
												<option value="<?php echo $i+1;?>"><?php echo $categorias[$i];?></option>
											<?php endfor ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-xs-1 pt-1 d-none d-md-block">
										<span class="fas fa-map-marker"></span>
									</div>
									<div class="col-md-10">
										<select required class="form-control" id="ciudad" name="ciudad">
											<option value="">Ciudad</option>
											<option value="Buga">Buga</option>
											<option value="Palmira">Palmira</option>
											<option value="Tulua">Tuluá</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-xs-1 pt-1 d-none d-md-block">
								<span class="fas fa-eye"></span>
							</div>
							<div class="col-md-11">
								<textarea required class="form-control" id="especialidad" name="especialidad" placeholder="Especialidad"></textarea>
							</div>
						</div>
						<div class="row justify-content-end">
							<div class="col-md-4 mr-4"><button class="btn btn-warning btn-block">Enviar</button></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="py-5 text-center full" id="last-works">
	<h1 class="text-center text-dark">
		<strong style="font-weight: 800">
			Proveemos a nuestros clientes <br> Materiales para la construcción
		</strong>
	</h1>
</div>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
		<li data-target="#myCarousel" data-slide-to="3"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="carousel-item active">
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_1.jpeg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_2.jpeg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_3.jpeg">
					</div>
				</div>
			</div>
		</div>
		<div class="carousel-item">
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_4.jpeg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_5.jpeg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_6.jpeg">
					</div>
				</div>
			</div>
		</div>
		<div class="carousel-item">
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_7.jpeg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_8.jpeg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_9.jpeg">
					</div>
				</div>
			</div>
		</div>
		<div class="carousel-item">
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_10.jpeg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_11.jpeg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img class="card-img" src="img/carousel_12.jpeg">
					</div>
				</div>
			</div>
		</div>
	</div>
	<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only"></span>
	</a>
	<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only"></span>
	</a>
</div>

<div class="container-fluid" id="video">
	<div class="row justify-content-center p-5">
		<div class="col-md-7">
			<div class="video-container sombra img-rounded">
				<iframe src="https://www.youtube.com/embed/44MCEFWyRrE" frameborder="0" width="560" height="315" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div id="myCarousel2" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel2" data-slide-to="1"></li>
			<li data-target="#myCarousel2" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<div class="row">
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-1.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-2.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-3.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-4.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-5.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-6.png">
						</div>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div class="row">
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-7.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-8.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-9.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-10.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-11.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-12.png">
						</div>
					</div>
				</div>
			</div>
			<div class="carousel-item">
				<div class="row">
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-13.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-10.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-15.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-16.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-17.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="card">
							<img class="card-img" src="img/logo-carousel-12.png">
						</div>
					</div>
				</div>
			</div>

		</div>
		<a class="carousel-control-prev" href="#myCarousel2" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only"></span>
		</a>
		<a class="carousel-control-next" href="#myCarousel2" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only"></span>
		</a>
	</div>
</div>
<?php  if (isset($_SESSION['message1'])) { ?>
	<?= $_SESSION['message1']?>
	<?php session_unset();} ?>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>

<?php
if ($_POST) {
	$cedula = $_POST['cedula'];
	$nombres = $_POST['nombres'];
	$apellidos = $_POST['apellidos'];
	$correo = $_POST['correo'];
	$telefono = $_POST['telefono'];
	$ocupacion = $_POST['ocupacion'];
	$ciudad = $_POST['ciudad'];
	$especialidad = $_POST['especialidad'];

	$sentencia = $mysqli->prepare("SELECT * FROM maestro WHERE cedula=?");
	$sentencia->bind_param("i", $cedula);
	$sentencia->execute();  
	$resultado = $sentencia->get_result();
	$fila = $resultado->fetch_assoc();
	if ($fila) {
		$_SESSION['message1']= "<script type='text/javascript'>alert('¡Error!.El Maestro con identificacion ".$cedula." ya existe verifique el valor ingresado');</script>";
		header("location:index.php");
	}else{
		$sql_insertar = $mysqli->prepare("INSERT INTO maestro(cedula,nombres,apellidos,correo,telefono, ocupacion,ciudad,especialidad) VALUES (?,?,?,?,?,?,?,?)");
		$sql_insertar->bind_param("ssssssss",$cedula,$nombres,$apellidos,$correo,$telefono,$ocupacion,$ciudad,$especialidad);
		$sql_insertar->execute(); 
		$_SESSION['message1']= "<script type='text/javascript'>alert('Registro Exitoso');</script>";
		header("location:index.php");
	}
} 
ob_end_flush();
?>