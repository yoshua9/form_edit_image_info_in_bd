<?php

// conexión con las base de datos o diferentes base de datos
function conectarBase($host,$usuario,$clave,$bd){

$mysqli = mysqli_connect($host,$usuario,$clave,$bd);

return $mysqli;

}