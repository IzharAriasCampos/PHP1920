<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>ALTA PRODUCTOS - Nombre del alumno</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 

	$categorias = obtenerCategorias($db);
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">
		<div class="form-group">
        ID PRODUCTO <input type="text" name="idproducto" placeholder="idproducto" class="form-control">
        </div>
		<div class="form-group">
        NOMBRE PRODUCTO <input type="text" name="nombre" placeholder="nombre" class="form-control">
        </div>
		<div class="form-group">
        PRECIO PRODUCTO <input type="text" name="precio" placeholder="precio" class="form-control">
        </div>
	<div class="form-group">
	<label for="categoria">Categorías:</label>
	<select name="categoria">
		<?php foreach($categorias as $categoria) : ?>
			<option> <?php echo $categoria ?> </option>
		<?php endforeach; ?>
	</select>
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
	$id=$_POST['idproducto'];
	$n=$_POST['nombre'];
	$p=$_POST['precio'];
	$cat=$_POST['categorias'];
	crearProducto($db,$n,$p,$id,$cat);
}
?>

<?php

function obtenerCategorias($db) {
		$categorias = array();
	
		$sql = "SELECT ID_CATEGORIA, NOMBRE FROM categoria";
	
		$resultado = mysqli_query($db, $sql);
		if ($resultado) {
			while ($row = mysqli_fetch_assoc($resultado)) {
				$categorias[] = $row['NOMBRE'];
			}
		}
		return $categorias;
	}
	function crearProducto($db,$n,$p,$id,$cat){
		$sql = "SELECT ID_CATEGORIA FROM categoria WHERE nombre='$cat'";
		$resultado = mysqli_query($db,$sql);
		if ($resultado){
			$row = mysqli_fetch_assoc($resultado);
			$sql1 = "INSERT INTO producto (ID_PRODUCTO, NOMBRE, PRECIO, ID_CATEGORIA) VALUES ('$id','$n',$p,'".$row['ID_CATEGORIA']."')";
			mysqli_query($db, $sql1);
		}
	}

?>



</body>

</html>