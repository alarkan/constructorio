<?php
$mysqli = new mysqli("localhost", "root", "admin", "constructorio");
if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	exit();
}
$categorias = array("Remodelacion","Reparacion Industria","Arquitecto","Cerrajeria","Cubiertas y Tejados","Dibujo Tecnico","Dibujo profesional","Diseño de Interiores","Electricos","Enchapes","Estructura para Cubiertas","Estuco","Mantenimiento y Reparaciones","Pinturas","Plomeria");
?>