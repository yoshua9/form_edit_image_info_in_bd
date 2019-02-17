<?php
	
 //edita o modifica los datos de cada uno de los productos
 function editarRegistro($datos){

	// Extraeremos a $fila el registro:
	while ($fila = @mysqli_fetch_array($datos)){ 

		$nombreActual = utf8_encode($fila["nombre"]);
		$descripcion = utf8_encode($fila["descripcion"]);
		$imagen =$fila["imagen"]; //La imagen
		$codigoActual = $fila["id"];

		// Aqui acumularemos en $codigo cada dato de $fila ubicado dentro de atributos value de campos
		$codigo = '<form action="modificado.php" method="post" enctype="multipart/form-data">
		<fieldset><legend>Puede modificar los datos de este registro:</legend>
		<p>
		<label>Nombre:
		<input name="nombre" type="text" value="'.$nombreActual.'"/>
		</label>
		</p>
		<p>
		<label>Descripción:
		<input name="descripcion" type="text" value="'.$descripcion.'"/>
		</label>
		</p>
		<p>
		<label>Imagen Actual:
		<img src="data:image/jpeg;base64,'.base64_encode($imagen) .' "/>
		</label>
		</p>
		<label>Nueva Imagen:
		<input type="file" name="imagen" accept="image/x-png,image/jpeg" />
		</label>
		<p>
		</p>
		<input name="codigo" type="hidden" value="'.$codigoActual.'"/>
		<input type="submit" name="Submit" value="Guardar cambios"/>
		</p>
		</fieldset></form>';
	}

	return $codigo;
}

// lista el contenido de la primera pagina con lo que tenemos en base de datos en formato tabla
function tabular ($datos){
	//Abrimos la etiqueta table una sola vez:
	$codigo = '<table border="1" cellpadding="3">';

	//Vamos acumulando de a una fila "tr" por vuelta:
	while ($fila = @mysqli_fetch_array($datos) ) {

	$codigo .= '<tr>';

	//vamos acumulando tantos "td" como sea necesario:
	$codigo .= '<td>'.utf8_encode($fila["nombre"]).'</
	td>';
	$codigo .= '<td>'.utf8_encode($fila["descripcion"]).'</
	td>';
	$codigo .= '<td>
	<img src="data:image/jpeg;base64,'.base64_encode($fila["imagen"]) .' "/></
	td>';
	$codigo .='<td><a href="modificar.php?codigo='.$fila["id"].' ">MODIFICAR</a></td>';

	//cerramos un "tr":
	$codigo .= '</tr>';
	}
	//finalizandoell bucle, cerramos por unica vez la tabla:
	$codigo .='</table>';

	return $codigo;
}

 // función para lanzar queries sobre la BD
function consultar ($mysqli,$consulta){
	if (!$datos= mysqli_query($mysqli,$consulta) or mysqli_num_rows($datos) <1){
		return false;// si fue rechazada la consulta por errores de sintaxis, o ningún registro coincide con lo buscado, devolvemos false
	} else { 
		return $datos;// si se obtuvieron datos, los devolvemos al punto que fue llamada la función
	}
}
?>