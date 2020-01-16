<h1>Empleado cambia departamento</h1>
<?php

/* Conexión BD */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'rootroot');
define('DB_DATABASE', 'empleadosnn');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
   if (!$db) {
		die("Error conexión: " . mysqli_connect_error());
	}

/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	/*Función que obtiene los departamentos de la empresa*/
	$departamentos = obtenerDepartamentos($db);
	$empleados = obtenerDni($db);
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
	<div>
	<label for="dni">Empleados:</label>
	<select name="dni">
		<?php foreach($empleados as $empleado) : ?>
			<option> <?php echo $empleado ?> </option>
		<?php endforeach; ?>
	</select>
	<label for="departamento">Departamentos:</label>
	<select name="departamento">
		<?php foreach($departamentos as $departamento) : ?>
			<option> <?php echo $departamento ?> </option>
		<?php endforeach; ?>
	</select>
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Mostrar Empleados"></div>
	</form>';
} else { 
	$dni=$_POST['dni'];
	$dp=$_POST['departamento'];
	cambiarContrato($db,$dni);
	contratoNuevo($db,$dp);
}
?>

<?php
// Funciones utilizadas en el programa

// Obtengo todos los departamentos para mostrarlos en la lista de valores
function obtenerDepartamentos($db) {
	$departamentos = array();
	
	$sql = "SELECT cod_dpto,nombre_dpto FROM departamento";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$departamentos[] = $row['nombre_dpto'];
		}
	}
	return $departamentos;
}
function obtenerDni($db) {
	$empleados = array();
	
	$sql = "SELECT dni FROM empleado";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$empleados[] = $row['dni'];
		}
	}
	return $empleados;
}
function cambiarContrato ($db,$dni){
	$fecha=gmdate('Y-m-d');
	$sql="SELECT cod_dpto from empleado_dpto where dni=$dni and fecha_fin='0000-00-00 00:00:00'";
	$resultado = mysqli_query($db,$sql);
	if ($resultado){
		$row = mysqli_fetch_assoc($resultado);
		$sql1= "UPDATE empleado_dpto SET fecha_fin='$fecha' WHERE dni='$dni' and cod_dpto='".$row['cod_dpto']."'";
		mysqli_query($db, $sql1);
	}
}
function contratoNuevo ($db,$dp){
$fecha_inc=getdate();
	$fecha=$fecha_inc['year']."-".$fecha_inc['mon']."-".$fecha_inc['mday'];
	$sql = "SELECT cod_dpto FROM departamento WHERE nombre_dpto='$dp'";
	$resultado = mysqli_query($db,$sql);
	if ($resultado){
		$row = mysqli_fetch_assoc($resultado);
		$sql1 = "INSERT INTO empleado_dpto (dni, cod_dpto, fecha_inic, fecha_fin) VALUES ('".$_POST['dni']."','".$row['cod_dpto']."','$fecha','')";
		mysqli_query($db, $sql1);
	}
}

	
