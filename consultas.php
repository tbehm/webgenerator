<?php
/*
	$sql="SELECT * FROM `usuarios` WHERE email=$email";
	$respuesta= mysqli_query($conexion,$sql);

	if (mysqli_num_rows($respuesta)>0) {
		while ($fila= mysqli_fetch_array($respuesta,MYSQLI_ASSOC)) {
			echo $fila['aa'];
		}
	}

*/

	function IssetEmail($email){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql="SELECT * FROM `usuarios` WHERE email='$email'";
		$respuesta= mysqli_query($conexion,$sql);

		if (mysqli_num_rows($respuesta)>0) {
			return true;
		}
		else{
			return false;
		}
	}

	function ValidPassword($email,$pass){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql = "SELECT idUsuario FROM `usuarios` WHERE email='$email' AND password='$pass'";
		$respuesta= mysqli_query($conexion,$sql);
		$respuesta = mysqli_fetch_array($respuesta,MYSQLI_ASSOC);
		return $respuesta['idUsuario'];
	}

	function DisponibleUser($email){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql="SELECT * FROM `usuarios` WHERE email='$email'";
		$respuesta= mysqli_query($conexion,$sql);
		if(mysqli_num_rows($respuesta) == 0){
			return true;
		}
	}
	function SetUser($email,$pass,$fecha){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql = "INSERT INTO `usuarios` (`Email`,`password`,`fechaRegistro`) VALUES ('$email', '$pass', '$fecha')";
		mysqli_query($conexion,$sql);

	}
	function DisponibleDomain($domain){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql = "SELECT * FROM `web` WHERE dominio='$domain'";
		$respuesta = mysqli_query($conexion,$sql);
		if(mysqli_num_rows($respuesta) == 0){
			return true;
		}
	}
	function SetWeb($domain,$idUsuario,$fecha){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql = "INSERT INTO `web` (`idUsuario`,`dominio`,`fechaCreacion`) VALUES ('$idUsuario', '$domain', '$fecha')";
		mysqli_query($conexion,$sql);
	}
	function GetWebs($idUsuario){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql = "SELECT * FROM `web` WHERE idUsuario='$idUsuario'";
	return mysqli_query($conexion,$sql);
	}
	function GetAllWebs(){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql = "SELECT dominio FROM `web`";
		return mysqli_query($conexion,$sql);
	}

	function DeleteWeb($idWeb){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql = "DELETE FROM web WHERE idWeb='$idWeb'";
		mysqli_query($conexion,$sql);
	}
	function GetDomainById($idWeb){
		$conexion=mysqli_connect("localhost","adm_webgenerator","webgenerator2024","webgenerator");
		$sql = "SELECT dominio FROM `web` WHERE idWeb='$idWeb'";
		$respuesta= mysqli_query($conexion,$sql);
		$respuesta = mysqli_fetch_array($respuesta,MYSQLI_ASSOC);
		return $respuesta['dominio'];
	}
