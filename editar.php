<?php
ob_start();
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
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
	<div style="text-align: center;">
		<h1>Editar Maestro</h1>
		<a href="home.php">Regresar a Inicio</a>
		<?php  if (isset($_SESSION['message3'])) { ?>
			<?= $_SESSION['message3']?>
			<?php $_SESSION['message3'] = "";} ?>
		</div>
		<br>
		<form action="editar.php" method="POST">
			<table style="margin: 0 auto;" border>
				<tbody>
					<tr>
						<td><label>Cedula:</label></td>
						<td><input readonly name="cedula" type="text" value="<?php echo $resultado['cedula'] ?>"></td>
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
						<td>
							<select name="ciudad">
								<option value="<?php echo $resultado['ciudad'] ?>"><?php echo $resultado['ciudad'] ?></option>
								<?php $count = count($valleCauca); for ($i=0; $i < $count; $i++): ?>
								<option value="<?php echo $valleCauca[$i];?>"><?php echo $valleCauca[$i];?></option>
							<?php endfor ?>
						</select>
					</td>
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
			<tfoot>
				<tr><td style="text-align: center;" colspan="2"><button type="submit">Actualizar Datos</button></td></tr>
			</tfoot>
		</table>	
	</form>

	<table  style="margin: 0 auto;">
		<tr>
			<td>
				<p>Foto de Perfil</p>
				<img style="height: 100px;width: 100px;"src="img/maestros/<?php echo $resultado['imagen'] ?>">
			</td>
		</tr>
		<tr>
			<td>
				<p>Trabajos Realizados</p>
				<?php 
				$datos = unserialize($resultado['fotos']);
				for ($i=0; $i < count($datos); $i++):?>
					<img src="<?php echo "img/maestros/".$datos[$i] ?>" style="height: 100px;width: 100px;">
				<?php endfor ?>
			</td>
		</tr>
	</table>
</body>
</html>
<?php
if ($_POST) {
	$cedula = $_POST['cedula'];
	$id = $_POST['id'];
	$nombres= $_POST['nombres'];
	$apellidos= $_POST['apellidos'];
	$telefono= $_POST['telefono'];
	$correo= $_POST['correo'];
	$ocupacion= $_POST['ocupacion'];
	$ciudad= $_POST['ciudad'];
	$especialidad= $_POST['especialidad'];
	$estado= $_POST['estado'];
	$sentencia2 = $mysqli->prepare("UPDATE maestro SET nombres=?,apellidos=?,correo=?,telefono=?,ocupacion=?,ciudad=?,especialidad=?,estado=? WHERE id=?");
	$sentencia2->bind_param("ssssissss",$nombres,$apellidos,$correo,$telefono,$ocupacion,$ciudad,$especialidad,$estado,$id);
	$sentencia2->execute();
	if($estado == 1){
		$sentencia3 = $mysqli->prepare('SELECT * FROM usuario WHERE nombre = ?');
		$sentencia3->bind_param("s", $cedula);
		$sentencia3->execute(); 
		$res2= $sentencia3->get_result();
		$resultado2 = $res2->fetch_assoc();
		if(!$resultado2){
			$uniqidStr = md5(uniqid(mt_rand()));
			$sql_insertar = $mysqli->prepare("INSERT INTO usuario(nombre, contrasena, olvidoclave, email) VALUES (?,?,?,?)");
			$sql_insertar->bind_param("ssss",$cedula,$uniqidStr,$uniqidStr,$correo);
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
			$mail->addAddress($correo);
			$mail->Subject = 'Registro Exitoso en Constructorio Master';
			$mail->msgHTML('Estimado '.$nombres.', <br/>Recientemente se envio una solicitud para ser parte del constructorio de ferreteria Master Si esto fue un error, simplemente ignore este correo electronico y no sucedera nada.
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
		}
	}  
	$_SESSION['message3'] ="<script type='text/javascript'>alert('Actualizacion Exitosa');</script>";
	header('location:editar.php?id='.$id);
}
ob_end_flush();
?>
