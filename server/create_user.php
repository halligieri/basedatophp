<?php
require ('conector.php');

$con = new ConectorBD('localhost', 'halligieri', 'Vuelo5763');
if ($con -> initConexion('evaluacion_final') == 'OK') {
	for ($i = 1; $i <= 3; $i++) {
		$datos['email'] = "user" . $i . "@gmail.com";
		$datos['nombre'] = "Nombre de usuario " . $i;
		$datos['contrasena'] = password_hash("Vuelo5763" . $i, PASSWORD_DEFAULT);
		$datos['fecha_nacimiento'] = date('Y-m-d');
		if ($con -> insertData('Usuarios', $datos))
			echo "Se insertaron los datos correctamente del usuario " . $i . "<br/>";
		else
			echo "Se ha producido un error en la inserción " . $i . "<br/>";
	}
	$con -> cerrarConexion();
} else
	echo "Se presentó un error en la conexión";
?>
