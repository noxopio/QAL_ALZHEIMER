<!DOCTYPE html>
<html>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloqal.css">
	<meta name="viewpor" content="whidth_device_width, initial-scale=1.0">
	<meta http-equiv="X-Compatible" content="ie-edge">
	<head>	
	<title>LOGIN QAL</title>
	

        <style>
        	body{
        		background: url(fondoqal.jpg);
        	}
                table{
                        border: 2px solid #FF69B4;
                        background-color:#C8B9E8 ;
                }
                input[type=text],input[type=password]{
                        width: 100%;
                        padding: 8px 20px;
                        border: 2px solid #7B68EE;
                        box-sizing: border-box;
                }
                
                
                label{
                        font-size: 14px;
                        font-weight: bold;
                        font-family: arial;
                }
                input[type=submit]{
                        background-color: #7B68EE;
                        color: white;
                        padding: 8px 10px;
                        margin: 8px 0px;
                        border: solid;
                        cursor: pointer;
                        width: 40%;
                }

        </style>
	
</head>
<body>
	<header >
		<div class="wrapper">
			<div class="logo">
				<img src="qalimg.jpg">
			</div>
			<div class="btn" onclick="location.href='login.php'"></div>
			<div class="btn1" onclick="location.href='registrousuario.php'"></div>
			<nav>
				<a href="cabecera.html">Inicio</a>
				<!--<a href="#">Agenda</a>
				<a href="#">Ejercicios</a>
				<a href="#">Recordatorio</a>
				<a href="#">Medicamentos</a>
				<a href="#">Citas Medicas</a>
				<a href="#">Contacto</a>-->


			</nav>
		</div>
	</header>
	 <center>
	    <table>
	    	<form action="#" method="POST">
	            <tr><td colspan="2" style="background-color: #C8B9E8 ; padding-bottom: 5px;padding-top: 5px;"><label>Login</label></td></tr>
	            <tr><td align="center" rowspan="5"><img src="candado.jpg"/></td><td>
	            <label>Usuario</label></td></tr>
	            <tr><td><input type="text" name="usuario"/></td></tr>
	            <tr><td><label>Password</label></td></tr>
	            <tr><td><input type="password" name="clave"/></td></tr>
	            <tr><td><input type="submit" value="Ingresar"></td></tr>

	    </table>
	</form>
	</center>
	<?php 
include_once'conexion.php';
session_start();
if (isset($_POST['cerrar_sesion']))
	{
		session_unset();
		session_destroy();
	}
if (isset($_SESSION['rol']))
	{
		switch ($_SESSION['rol']) 
		{
			case 1:
				header('Location:paciente.php');
				break;
			case 2:
				header('Location:invitado.php');
				break;
			case 3:
				header('Location:administrador.php');
				break;
			
			default:
				echo "no estoy en nada";
				break;
		}
	}
	if (isset($_POST['usuario'])&& isset($_POST['clave'])) 
	{
		$username = $_POST['usuario'];
		$password = $_POST['clave'];
		$db = new Database();
		$query = $db->connect()->prepare('SELECT *FROM registro WHERE usuario= :usuario AND clave = :clave');
		$query-> execute (['usuario'=>$username,'clave'=>$password]);
		$arreglofila = $query-> fetch(PDO::FETCH_NUM);

		if ($arreglofila == true)
		{
			$rol = $arreglofila[1];
			$_SESSION['rol'] = $rol;
			switch ($rol)
			{
			case 1:
				header('location:paciente.php');
				break;
			case 2:
				header('location:invitado.php');
				break;
			case 3:
				header('location:administrador.php');
				break;
			
			default:
				echo "no estoy en nada";
				break;
			}
		$usuario=$arreglofila[2];
		$_SESSION['nombre'] = $usuario;
		$ingreso=$arreglofila[0];
		$_SESSION['id'] = $ingreso;
				
		}   
	else
	{
		echo "Nombre de usuario o contraseña invalido!";
	}
}
?>

	<br><br><section class="contenido wrapper" style="background-color:  #b65bda;">
		<div class="contenedor"style="height: 200px; width: 900px; background-color: #f3d3ff; " >
			<h1>BIENVENIDO</h1>
			<hr>
			<p>Para nosotros es un placer poder ser de gran ayuda en este proceso </p>
		</div>
	
		
	</section>

</body>
</html>