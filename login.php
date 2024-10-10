<?php
	session_start();
				
	if(isset($_SESSION['log'])){
		header('location:panel.php');
	}
	else{
		echo"<center><h1>WebGenerator_Behm_Tiziano</h1><h3><br><form action='login.php' method='post'>
			Ingrese su Email
			<p>
			<input type='text' name='email' required>
			<p>
			Ingrese su clave
			<p>
			<input type='password' name='pass' required>
			<p>
			<input type='submit' value='Ingresar'></form>
			<p>
			<a href='register.php'>Registrate</a>
			<p>";
		if(isset($_POST['email'])){
			include_once 'consultas.php';
			$email = $_POST['email'];
			$pass=$_POST['pass'];
			$userExist = IssetEmail($email);
			if($email=="admin@server.com"){
				if($pass=="serveradmin"){
					$_SESSION['admin'] = true;
					header('location:panel.php');
					$_SESSION['log']="admin";
				}
				else{
					echo'<script>alert("Admin, su clave es incorrecta")</script>';
				}
			}
			else{
				if($userExist){
				$log = ValidPassword($email,$pass);
					if(!empty($log)){
						$_SESSION['log'] = $log;
						header('location:panel.php');
					}
					else{
						echo"Clave Incorrecta, intentelo nuevamente";
					}
				}
				else{
					echo"Usuario no encontrado, intentelo nuevamente";
				}
			}
			echo"</h3></center>";
		}
		
	}
?>