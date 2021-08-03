<?php 
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
	@font-face{
		font-family: 'Century Gothic';
	}
	body{
		font-family: 'Century Gothic';
		background-color: #212121;
		background-attachment: fixed;
		background-size: cover
	}
	.text-gold{ color: #F1BD02 !important }
	.bg-dark{
		background-size: cover; background-repeat: no-repeat;
		height: 100vh; padding: 25vh 15%; margin: 0 !important
	}
	.contenido{
		height: 280px;
	}
	@media screen(max-width: 800px){
		.modal-bg-dark{ padding: 25vh 5% }
	}
	.pointer{ cursor: pointer }
	.checked{ color: orange }
</style>
</head>
<body>
	<main id="app">
		<?php if ($_GET): $_SESSION['categoria']= $_GET['category'];?>
			<section class="container-fluid p-0">
				<section class="row py-sm-5 px-5 bg-dark">
					<div class="col-12 pb-5 text-center">
						<a href="index.php"><h3 class="text-gold"><strong>ESTAMOS EN</strong></h3></a>
					</div>
					<form class="col-md-4 px-lg-5 pb-2" method="POST" action="perfil.php">
						<input type="hidden" name="ciudad" value="buga"/>
						<button class="bg-transparent" type="submit"><img src="img/boton-buga.png" class="img-fluid"></button>
					</form>
					<form class="col-md-4 px-lg-5 pb-2" method="POST" action="perfil.php">
						<input type="hidden" name="ciudad" value="palmira"/>
						<button class="bg-transparent" type="submit"><img src="img/boton-palmira.png" class="img-fluid"></button>
					</form>
					<form class="col-md-4 px-lg-5 pb-2" method="POST" action="perfil.php">
						<input type="hidden" name="ciudad" value="tulua"/>
						<button class="bg-transparent" type="submit"><img src="img/boton-tulua.png" class="img-fluid"></button>
					</form>
				</section>
			</section>
			<?php  if (isset($_SESSION['message2'])) { ?>
				<?= $_SESSION['message2']?>
				<?php $_SESSION['message2'] = "";} ?>
			<?php endif ?>
			<?php 
			if($_POST):
				$ciudad = $_POST['ciudad'];
				$categoria = $_SESSION['categoria'];
				$estado = 1;
				$sentencia = $mysqli->prepare("SELECT * FROM maestro WHERE ciudad=? AND ocupacion=? AND estado=?");
				$sentencia->bind_param("ssi", $ciudad,$categoria,$estado);
				$sentencia->execute();  
				$resultado = $sentencia->get_result();
				$fila = $resultado->fetch_assoc();
				if(!$fila){
					$_SESSION['message2']= "<script type='text/javascript'>alert('¡MUY PRONTO INFORMACIÓN! BUSCA EN OTRA CIUDAD');</script>";
					header("location:perfil.php?category=".$categoria);
				}
				?>
				<section class="container-fluid px-5">
					<section class="row justify-content-center" id="cabecera">
						<div class="col-md-6 text-center mb-1 mt-0s">
							<a href="index.php"><img src="img/logo-constructorio.png" class="img-fluid px-5"></a>
							<p class="h4 text-white"><strong>¡AQUÍ LO ENCUENTRAS TODO!</strong></p>
						</div>
					</section>
					<div id="myCarousel" class="carousel carousel-dark slide" data-ride="carousel">
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
								<div class="row">
									<div class="col-md-12">
										<section class="row pt-5 justify-content-center" id="contenido">
											<div class="col-md-3 mb-1">
												<div>
													<a href="https://tienda.ferremaster.com/"><img src="https://ecommerce.ferremaster.com/backend/admin/backend/web/archivosDelCliente/anuncios/images/47112710108.jpg" class="img-fluid"></a>
												</div>
												
											</div>
											<div class="col-md-6 px-3">
												<div class="row pl-3">
													<div class="col-md-4">
														<img src="<?php echo "img/maestros/".$fila['imagen']?>" class="img-fluid" style="border-radius: 25px 0 25px 0">
													</div>
													<div class="col-md-8">
														<div id="stars">
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span><br>
															<span class="text-gold">100 estrellas</span>
														</div>
														<h1 class="text-white py-2"><?php echo $fila['nombres']." ".$fila['apellidos'] ?></h1>
														<p class="text-white py-1"><?php echo $fila['especialidad']?></p>
														<ul class="text-white">
															<li class="text-muted">Email: <strong class="text-white"><?php echo $fila['correo']?></strong></li>
															<li class="text-muted">Profesión: <strong class="text-white"><?php echo $categorias[$fila['ocupacion']-1]?></strong></li>
															<li class="text-muted">Ciudad: <strong class="text-white"><?php echo $fila['ciudad']?></strong></li>
														</ul>
														<a href="https://wa.me/57<?php echo $fila['telefono']?>" class="btn btn-outline-success">Contactar &nbsp; <i class="fab fa-whatsapp"></i></a>
													</div>
												</div>
												<div class="row pl-3">
													<div class="col-md-12">
														<div class="row">
															<div class="col-md-12 mb-3 text-center pt-3">
																<span class="text-white h3">Trabajos Realizados</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-3 mb-1">
												<div>
													<a href="https://tienda.ferremaster.com/catalogo-ferreteria-master"><img src="https://ecommerce.ferremaster.com/backend/admin/backend/web/archivosDelCliente/anuncios/images/4711324974.jpg" class="img-fluid">
													</a>
												</div>
											</div>
										</section>
										<section class="row justify-content-center" id="similares">
											<?php $datos = unserialize($fila['fotos']);
											for ($i=0; $i < count($datos); $i++):?>
												<div class="col-md-4 pb-1">
													<img src="<?php echo "img/maestros/".$datos[$i] ?>" class="w-100"style="object-fit:cover; height: 200px;"/>
												</div>
											<?php endfor ?>
										</section>
									</div>
								</div>
							</div>
							<?php while($fila = $resultado->fetch_assoc()): ?>
								<div class="carousel-item">
									<div class="row">
										<div class="col-md-12">
											<section class="row pt-5 justify-content-center" id="contenido">
												<div class="col-md-3 mb-1">
													<div>
														<a href="https://tienda.ferremaster.com/"><img src="https://ecommerce.ferremaster.com/backend/admin/backend/web/archivosDelCliente/anuncios/images/47112710108.jpg" class="img-fluid"></a>
													</div>
												</div>
												<div class="col-md-6 px-3">
													<div class="row pl-3">
														<div class="col-md-4">
															<img src="<?php echo "img/maestros/".$fila['imagen']?>" class="img-fluid" style="border-radius: 25px 0 25px 0">
														</div>
														<div class="col-md-8">
															<div id="stars">
																<span class="fa fa-star checked"></span>
																<span class="fa fa-star"></span>
																<span class="fa fa-star"></span>
																<span class="fa fa-star"></span>
																<span class="fa fa-star"></span><br>
																<span class="text-gold">100 estrellas</span>
															</div>
															<h1 class="text-white py-2"><?php echo $fila['nombres']." ".$fila['apellidos'] ?></h1>
															<p class="text-white py-1"><?php echo $fila['especialidad']?></p>
															<ul class="text-white">
																<li class="text-muted">Email: <strong class="text-white"><?php echo $fila['correo']?></strong></li>
																<li class="text-muted">Profesión: <strong class="text-white"><?php echo $categorias[$fila['ocupacion']-1]?></strong></li>
																<li class="text-muted">Ciudad: <strong class="text-white"><?php echo $fila['ciudad']?></strong></li>
															</ul>
															<a href="https://wa.me/57<?php echo $fila['telefono']?>" class="btn btn-outline-success">Contactar &nbsp; <i class="fab fa-whatsapp"></i></a>
														</div>
													</div>
													<div class="row pl-3">
														<div class="col-md-12">
															<div class="row">
																<div class="col-md-12 mb-3 text-center pt-3">
																	<span class="text-white h3">Trabajos Realizados</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-3 mb-1">
													<div>
														<a href="https://tienda.ferremaster.com/catalogo-ferreteria-master"><img src="https://ecommerce.ferremaster.com/backend/admin/backend/web/archivosDelCliente/anuncios/images/4711324974.jpg" class="img-fluid">
														</a>
													</div>
												</div>
											</section>
											<section class="row justify-content-center" id="similares">
												<?php $datos = unserialize($fila['fotos']);
												for ($i=0; $i < count($datos); $i++):?>
													<div class="col-md-4 pb-1">
														<img src="<?php echo "img/maestros/".$datos[$i] ?>" class="w-100"style="object-fit:cover; height: 200px; width:200px;"/>
													</div>
												<?php endfor ?>
											</section>
										</div>
									</div>
								</div>
							<?php endwhile ?>
						</div>
						<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" style="background-image: url('img/nav-prev.png');"></span>
						</a>
						<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
							<span class="carousel-control-next-icon" style="background-image: url('img/nav-next.png');"></span>
						</a>
					</div>
				</section>
			<?php endif ?>
		</main>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	</body>
	</html>