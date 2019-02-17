<?php

// Incluimos los datos de conexion y las funciones 
include ("conexion.php");
include ("funciones.php");

// Verificamos la presencia de los datos esperados(deveriamos validar sus valores, aunque acá no lo hagamos para abreviar):
var_dump($_POST);
if (isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["codigo"]) ){

// Nos conectamos:
if ($mysqli = conectarBase("localhost", "root", "","bd_productos")){

// Evitamos problemas con codificaciones:
//@mysqli_query("SET NAMES 'utf8'");
var_dump($_FILES['imagen']);
// Traspasamos a variables locales para evitar problemas con comillas:
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$codigo = $_POST["codigo"];

// Verificamos si el tipo de archivo es un tipo de imagen permitido.
$permitidos = array("image/jpg", "image/jpeg", "image/png");

// Comprobamos que se nos envie una nueva imagen
if(in_array($_FILES['imagen']['type'], $permitidos)){

	// Archivo temporal
    $imagen_temporal = $_FILES['imagen']['tmp_name'];

    // Tipo de archivo
    $tipo = $_FILES['imagen']['type'];

    // Leemos el contenido del archivo temporal en binario.
    $fp = fopen($imagen_temporal, 'r+b');
    $data = fread($fp, filesize($imagen_temporal));
    fclose($fp);
    
    //Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
    // $data=file_get_contents($imagen_temporal);

    // Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
    $data = mysqli_escape_string($mysqli,$data);

	$consulta = "UPDATE Productos_19 SET nombre='$nombre', descripcion='$descripcion', imagen='$data' WHERE id='$codigo'";
} else{
$consulta = "UPDATE Productos_19 SET nombre='$nombre', descripcion='$descripcion' WHERE id='$codigo'";

}

if ( mysqli_query($mysqli , $consulta)){
	echo"<p>Registro actualizado.</p>";
}
else {
	echo"<p>No se pudo actualizar</p>";
} 

}
else {
	echo"<p>Servicio interrumpido</p>";
} 

}else {
	echo '<p>No se ha indicado cual registro desea modificar.</p>';
}
	echo '<p>Regresar al <a href="/productos/">listado</a></p>';
?>