<?php
	require 'consultas.php';
	echo"<center><h1>Registrarte es facil</h1><br><h3>
		<form action='' method='post'>
		Ingrese su email
		<p>
		<input type='email' name='email' required>
		<p>
		Ingrese su clave
		<p>
		<input type='password' name='psw1' required>
		<p>
		Repita su clave
		<p>
		<input type='password' name='psw2' required>
		<p>
		<input type='submit' value='Registrarme'></form>";
	if(isset($_POST['email'])){#si el email esta seteado
		if($_POST['psw1']=$_POST['psw2']){#si las contraseñas 	  coinciden
			if(DisponibleUser($_POST['email'])){#si el email esta disponible
				date_default_timezone_set("AMerica/Argentina/Buenos_Aires");
				$fecha = date("Y-m-d");
				SetUser($_POST['email'],$_POST['psw1'],$fecha);#setea el user
				echo"<script>alert('el registro fue exitoso')</script>";
				header('location:login.php');
			}
			else{#si el email ya esta en uso
				echo"<script>alert('email no disponible')</script>";
			}
		}
		else{#si las contraseñas no coinciden
			echo'<script>alert("las contraseñas no coinciden")</script>';
		}
		
	}
	echo"</h3></center>";
?>