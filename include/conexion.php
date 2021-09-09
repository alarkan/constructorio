<?php
$mysqli = new mysqli("localhost", "root", "admin", "constructorio");
if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	exit();
}
$categorias = array("Industria","Cerrajeria y Talleres","Metalmecanica","Arquitecto","Cubiertas y Tejados","Remodelacion","Dibujo profesional","Diseño de Interiores","Electricos","Enchapes","Estructura para Cubiertas","Estuco","Mantenimiento y Reparaciones","Pinturas","Plomeria");

$valleCauca = array(
	'Palmira',
	'Buga',
	'Tulua',
	'Alcalá',
	'Andalucía',
	'Ansermanuevo',
	'Argelia',
	'Bolívar',
	'Buenaventura',
	'Bugalagrande',
	'Caicedonia',
	'Cali',
	'Calima',
	'Candelaria',
	'Cartago',
	'Dagua',
	'El Águila',
	'El Cairo',
	'El Cerrito',
	'El Dovio',
	'Florida',
	'Ginebra',
	'Guacarí',
	'Jamundí',
	'La Cumbre',
	'La Unión',
	'La Victoria',
	'Obando',
	'Restrepo',
	'Riofrío',
	'Roldanillo',
	'San Pedro',
	'Sevilla',
	'Toro',
	'Trujillo',
	'Ulloa',
	'Versalles',
	'Vijes',
	'Yotoco',
	'Yumbo',
	'Zarzal');
?>