<?php>

require_once "Clases/conexion/conexion.php"
$conexion = new conexion;
$query= "select * from categoria"
print_r($conexion->obtenerDatos($query))

?>