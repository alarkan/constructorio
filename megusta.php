<?php 
include_once'include/conexion.php';
session_start();
$voto = htmlentities($_GET['voto']);
$id = (int) $_GET['id'];
$sentencia = $mysqli->prepare("SELECT id,ips,megusta FROM maestro WHERE id=?");
$sentencia->bind_param("i", $id);
$sentencia->execute();  
$resultado = $sentencia->get_result();
$row = $resultado->fetch_assoc();
$ip = $row['ips'];
$ipp = getenv('REMOTE_ADDR');
$megusta = $row['megusta'];
switch($voto)
{
	case "positivo";
	if($row)
	{
		$var = explode(",", $ip);
		$arr = in_array($ipp, $var);
		if(!$arr)
		{
			$megusta = $megusta+1;
			$ips = $ip.",".$ipp;
			$sentencia = $mysqli->prepare("UPDATE maestro SET megusta=?, ips=? WHERE id=?");
			$sentencia->bind_param("isi",$megusta,$ips,$id);
			$sentencia->execute(); 
		}
	}
	break;	
	case "negativo";
	if($row)
	{
		$var = explode(",", $ip);
		$arr = in_array($ipp, $var);
		//$arr = array_search($ipp, $var);
		//unset($var[$arr]);
		//$var = implode($var);
		if(!$arr)
		{
			$megusta = $megusta-1;
			$ips = $ip.",".$ipp;			
			$sentencia = $mysqli->prepare("UPDATE maestro SET megusta=?, ips=? WHERE id=?");
			$sentencia->bind_param("isi",$megusta,$ips,$id);
			$sentencia->execute();
		}
	}
	break;
}
header('location:perfil.php?category='.$_SESSION['categoria']);
?>