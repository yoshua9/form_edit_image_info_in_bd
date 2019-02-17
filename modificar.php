<?php
// Incluimos los datos de conexión y las funciones:
include("conexion.php");
include("funciones.php");

// Verificamos la presencia del codigo esperado:
if (isset($_GET["codigo"]) and $_GET["codigo"]<>"" ){
	$codigo = $_GET["codigo"];

// Nos conectamos:
if ($mysqli = conectarBase("localhost", "root", "","bd_productos")){
	$consulta = "SELECT * FROM Productos_19 WHERE id='$codigo'";

if ( $paquete = consultar($mysqli,$consulta)) { 
	// Aquí llamaremos a una función que muestre esos datos dentro de atributos value de un formulario:
	$resultado = editarRegistro($paquete);
	echo $resultado;

} else {
	echo "<p>No se encontraron datos</p>";
}
} else {
	echo '<p>No se ha indicado cuál registro desea modificar.</p>'; 
}
	echo '<p>Regresar al <a href="listado.php">listado</a></p>';
}
?>