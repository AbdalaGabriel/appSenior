<?php
header('Content-Type: text/javascript; charset=UTF-8'); 
$resultados = array();
$conexion = mysqli_connect("localhost", "root", "", "alquimia");

/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

/* revisar existencia del usuario con la contraseña en la bd */
$sqlCmd = "SELECT nombre, password, idUsuario
FROM usuarios
WHERE nombre = '".mysqli_real_escape_string($conexion,$usuarioEnviado)."' 
AND password ='".mysqli_real_escape_string($conexion,$passwordEnviado)."'
LIMIT 1";

mysqli_query($conexion,"SET NAMES 'utf8'");
$sqlQry = mysqli_query($conexion,$sqlCmd);

if(mysqli_num_rows($sqlQry)>0){

	$login=1;

	$fila = mysqli_fetch_array($sqlQry);

	$idUsuario =  $fila["idUsuario"];

	$sqlP = "SELECT * FROM proyectos where idUsuario = '$idUsuario'";
	
	mysqli_query($conexion,"SET NAMES 'utf8'");

	$sqlQryP = mysqli_query($conexion,$sqlP);


	while ($r = mysqli_fetch_assoc($sqlQryP)){ // tiene q ser assoc para que no me cree arrays multimedimensional, probar que muestra un echo con array y otro con assoc
			
		$resultados[] = $r;
	
	}
	
	//echo json_encode($array);

}else{

	$login=0;

}


$resultados["validacion"] = "neutro";

if( $login==1 ){

$resultados["validacion"] = "ok";

}else{

$resultados["validacion"] = "error";
}


$resultadosJson = json_encode($resultados);

/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>