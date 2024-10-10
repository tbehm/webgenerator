<?php
	session_start();
if(isset($_SESSION['log'])){
	require 'consultas.php';
	echo"<center><h1>Bienvenido a tu panel</h1><br>";
	if($_SESSION['log'] != "admin"){
		if(isset($_GET['download'])){
				$nom = GetDomainById($_GET['id']);
				shell_exec('zip -r '.$nom.'.zip '.$nom);
				header('location:'.$nom.'.zip');
			}
			if(isset($_GET['del'])){
					$nom = GetDomainById($_GET['id']);
					shell_exec('rm -r '.$nom);
					DeleteWeb($_GET['id']);
			}
		echo"<a href='logout.php'>Cerrar sesion de ".$_SESSION['log']."</a><p>";
		echo"<form action='panel.php' method='post'>
			Crear web de:
			<p>
			<input type='text' name='nombre' required>
			<p>
			<input type='submit' name='submit' value='Crear web'></form>";
		if(isset($_POST['submit'])){
			$domain=$_SESSION['log'].$_POST['nombre'];
			if(DisponibleDomain($domain)){
				date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
				$fecha = date("Y-m-d");
				SetWeb($domain,$_SESSION['log'],$fecha);
				shell_exec("./wix.sh ".$domain);
			}
			else{
				echo"<script>alert('El dominio ya esta en uso')</script>";
			}
		}
		$datos = GetWebs($_SESSION['log']);
		if(!empty($datos)){

			echo"<table border ='1'><tr><td>Your Webs</td></tr>";
			while ($web= mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
				echo"<tr><td><a href='".$web['dominio']."'>".$web['dominio']."</a></td><td><a href='panel.php?download=true&id=".$web['idWeb']."'>Download</a></td><td><a href='panel.php?del=true&id=".$web['idWeb']."'>Eliminar</a></td></tr>";
			}
			echo"</table></h3></center>";
		}
	}
	else{
		$datos = GetAllWebs();
			echo"<a href='logout.php'>Cerrar sesion de ".$_SESSION['log']."</a>
			";
	if(!empty($datos)){
		echo"<p><table border='0'><thead><th>AllWebs</th></thead><tbody>";
			while ($web= mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
			echo"<tr><td><a href='".$web['dominio']."'>".$web['dominio']."</a></td></tr>";
		}
		echo"</tbody></table>";
	}
	}
}
else{
	header('location:login.php');
}

?>
