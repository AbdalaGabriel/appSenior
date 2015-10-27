<?php
header('Content-Type: text/javascript; charset=UTF-8'); 

include 'services/Conector.php';
include 'services/Usuario.php';
include 'services/Proyecto.php';
include 'services/Tareas.php';
include 'services/Entregas.php';
include 'services/Comentario.php';

$resultados = array();


if(isset($_GET['idTarea'])) {

	$idTarea = $_GET['idTarea'];

	$resultados["validacion"] = "ok";

	$comentario = new Comentario();
	$comentario->ComentariosEnTarea($idTarea);
	$max = count($comentario->Listado);


	for ($i = 0; $i < $max; $i++) {
	 		
	 		$comFila = $comentario->Listado[$i];
	 	
	 		$resultados[$i] = array(

								[
			 					'comentario' => utf8_encode($comFila["comentario"]),
			 					'fecha' =>  utf8_encode($comFila["fechaComentario"]),
			 					'usuario' =>utf8_encode($comFila["nombre"]),
			 				    ],
							 
			 				);

	}





} else{

	$resultados["validacion"] = "error";
}


$resultadosJson = json_encode($resultados);

echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>