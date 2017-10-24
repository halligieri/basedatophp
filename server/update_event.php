<?php

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

session_start();
if ($_SESSION['isLogin']) {
	require ('conector.php');

	$con = new ConectorBD('localhost', 'halligieri', 'Vuelo5763');
	$response['conexion'] = $con -> initConexion('evaluacion_final');
	if ($response['conexion'] == 'OK') {
		if(validateDate($_POST['start_date'], 'Y-m-d'))
			$datos['fecha_inicio'] = $_POST['start_date'];
		if(validateDate($_POST['start_hour'], 'H:i:s'))
			$datos['hora_inicio'] = $_POST['start_hour'];
		if(validateDate($_POST['end_date'], 'Y-m-d'))
			$datos['fecha_finalizacion'] = $_POST['end_date'];
		if(validateDate($_POST['end_hour'], 'H:i:s'))
			$datos['hora_finalizacion'] = $_POST['end_hour'];

		if ($con -> actualizarRegistro('Eventos', $datos, 'id = ' . $_POST['id']))
			$response['msg'] = 'OK';
		else
			$response['msg'] = 'Se ha producido un error al guardar el evento'. $_POST['id'];
	} else
		$response['msg'] = 'Problemas con la conexión a la base de datos';
} else
	$response['msg'] = 'Debe iniciar sesión';

echo json_encode($response);
?>
