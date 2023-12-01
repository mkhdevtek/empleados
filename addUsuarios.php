<?php
	include("conexion.php");
	session_start();

	if(!isset($_SESSION['username'])){
		header ("location: index.php");
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<!--
Project      : Datos de empleados con PHP, MySQLi y Bootstrap CRUD  (Create, read, Update, Delete) 
Author		 : Obed Alvarado
Website		 : http://www.obedalvarado.pw
Blog         : https://obedalvarado.pw/blog/
Email	 	 : info@obedalvarado.pw
-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Latihan MySQLi</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>

	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Datos del usuario &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['save'])){
                $iduser		     = mysqli_real_escape_string($con,(strip_tags($_POST["iduser"],ENT_QUOTES)));//Escanpando caracteres 
				$usuario		     = mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));//Escanpando caracteres 
				$password	 = mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre	 = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$apellidos	     = mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));//Escanpando caracteres 
				$fechanac		 = mysqli_real_escape_string($con,(strip_tags($_POST["fechanac"],ENT_QUOTES)));//Escanpando caracteres 
				$correo		 = mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));//Escanpando caracteres 
				$telefono			 = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres  
				$poblacion			 = mysqli_real_escape_string($con,(strip_tags($_POST["poblacion"],ENT_QUOTES)));//Escanpando caracteres  
				$rol			 = mysqli_real_escape_string($con,(strip_tags($_POST["rol"],ENT_QUOTES)));//Escanpando caracteres  
				
			 $miConsulta = "SELECT * FROM usuarios where iduser =".$iduser; //crear consulta que seleccione el registro donde el campo codigo sea igual a la variable $codigo

				$cek = mysqli_query($con, $miConsulta);
				if(mysqli_num_rows($cek) == 0){
                        $miConsulta = "INSERT INTO usuarios (usuario, password, nombre, apellidos, fechanac, correo, telefono, poblacion, rol) VALUES ( '$usuario', '$password', '$nombre', '$apellidos', '$fechanac', '$correo', '$telefono', '$poblacion', '$rol')"; //crear la consulta del INSERT INTO 
						$insert = mysqli_query($con, $miConsulta) or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

<form class="form-horizontal" action="" method="post">
<div class="form-group">
        <label class="col-sm-3 control-label">ID</label>
        <div class="col-sm-4">
            <input type="text" name="iduser" class="form-control" placeholder="iduser" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Usuario</label>
        <div class="col-sm-4">
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
        </div>
    </div>
    <div class="form-group">
    <label class="col-sm-3 control-label">Password</label>
    <div class="col-sm-4">
        <input type="text" name="password" class="form-control" placeholder="Password" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Nombre</label>
    <div class="col-sm-4">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Apellidos</label>
    <div class="col-sm-3">
        <textarea name="apellidos" class="form-control" placeholder="Apellidos"></textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Fecha Nacimiento</label>
    <div class="col-sm-3">
        <input type="text" name="fechanac" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Correo</label>
    <div class="col-sm-3">
        <input type="text" name="correo" class="form-control" placeholder="Correo" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Telefono</label>
    <div class="col-sm-3">
        <input type="text" name="telefono" class="form-control" placeholder="Telefono" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Poblacion</label>
    <div class="col-sm-3">
        <input type="text" name="poblacion" class="form-control" placeholder="Poblacion" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Rol</label>
    <div class="col-sm-3">
        <input type="text" name="rol" class="form-control" placeholder="Rol" required>
    </div>
</div>

    <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-6">
            <input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
            <a href="usuarios.php" class="btn btn-sm btn-danger">Cancelar</a>
        </div>
    </div>
</form>

		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>