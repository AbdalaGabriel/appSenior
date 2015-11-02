<?php
header('Content-Type: text/javascript; charset=UTF-8'); 

include 'services/Conector.php';
include 'services/Comentario.php';

$resultados = array();


if(isset($_GET['idTarea'])) {

	$idTarea = $_GET['idTarea'];
	$idUsuario = $_GET['idUsuario'];
	$coment = urldecode($_GET['comentario']);

	$now = new DateTime();
	$now->setTimezone(new DateTimeZone('America/Buenos_Aires'));    // Another way
	$hora = $now->format('H:i');

	$resultados["validacion"] = "ok";

	$comentario = new Comentario();
	$comentario->mensaje = $coment;
	$comentario->idUsuario = $idUsuario;
	$comentario->idTarea =$idTarea ;
	$comentario->hora = $hora ;
	$comentario->fecha = date("Y-m-d");
	$comentario->Agregar();


	$comentario->ComentariosEnTarea($idTarea);
	$max = count($comentario->Listado);


	//Obtener ultimo coment

	 		
	 		$comFila = $comentario->Listado[$max-1];
	 	
	 		$resultados["nuevoComent"] = array(

								[
			 					'comentario' => utf8_encode($comFila["comentario"]),
			 					'fecha' =>  utf8_encode($comFila["fechaComentario"]),
			 					'usuario' =>utf8_encode($comFila["nombre"]),
			 				    ],
							 
			 				);

	

	

} else{

	$resultados["validacion"] = "error";
}


$resultadosJson = json_encode($resultados);

echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>