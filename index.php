<?php
// Incluimos los datos de conexión y las funciones:
include("conexion.php");
include("funciones.php");

// Usamos esas variables:
if($mysqli = conectarBase("localhost", "root", "", "bd_productos")){
$consulta = "SELECT * FROM Productos_19";
if ($paquete = consultar($mysqli,$consulta)){

// Llamamos a una función que muestre esos datos
$codigoTabla = tabular($paquete);
echo $codigoTabla;
} else {
echo "<p>No se encuentraron datos</p>";
}
} else {
echo "<p>Servicio interrumpido</p>"; 
}

die("hola");