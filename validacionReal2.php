<?php
header('Content-Type: text/javascript; charset=UTF-8'); 

include 'services/Conector.php';
include 'services/Usuario.php';
include 'services/Proyecto.php';
include 'services/Tareas.php';
include 'services/Entregas.php';
include 'services/Comentario.php';

$resultados = array();
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];

$usuario = new Usuario();
$usuario->VerificarCliente($usuarioEnviado,$passwordEnviado);
$usuarioLogueado = $usuario->Verificar[0];


if($usuarioLogueado["nombre"]){

	$resultados["validacion"] = "ok";
	$resultados["usuario"] = $usuarioLogueado["nombre"];
	$resultados["idUsuario"] = $usuarioLogueado["idUsuario"];
	$idUsuario = $usuarioLogueado["idUsuario"];

	$proyecto = new Proyecto();
	$proyecto->Listar($idUsuario);
	$max = count($proyecto->Listado);


	for ($i = 0; $i < $max; $i++) {
	 		
	 		$proFila = $proyecto->Listado[$i];
	 		$idProyecto = $proFila["idProyecto"];

	 		$entregas = new Entregas();
	 		$entregas -> Listar($idProyecto);

	 		$max2 = count($entregas->Listado);

	 		$resultados[$i] = array(

								[
			 					'idProyecto' => utf8_encode($proFila["idProyecto"]),
			 					'nombre' =>  utf8_encode($proFila["nombre"]),
			 					'descripcion' =>utf8_encode($proFila["descripcion"]),
			 				    ],
							 
			 				);

	 	

	 		for ($j = 0; $j < $max2; $j++) {
			
				 $enFila = $entregas->Listado[$j];	
				 $idEntrega = $enFila["idEntrega"]; 				
				
				 $resultados[$i]["entregas"][$j] = array([
				 					  				 					  
									  'idEntrega' => utf8_encode($enFila["idEntrega"]),
									  'inicio' =>  utf8_encode($enFila["inicio"]),
									  'fechaEntrega' =>utf8_encode($enFila["fechaEntrega"]),
									  'titulo' =>utf8_encode($enFila["titulo"]),
									  'descripcion' =>utf8_encode($enFila["descr"]),
				 ]);


				 $tareas = new Tareas();
		 		 $tareas -> Listar($idEntrega);

		 		 $max3 = count($tareas->Listado);

		 		 for ($k = 0; $k < $max3; $k++) {

		 		 	$tarFila = $tareas->Listado[$k];
		 		 	$idTarea = $tarFila["idTarea"];

		 		 	//numero de comentarios

		 		 	$comentarios = new Comentario();
		 			$comentarios -> Listar($tarFila["idTarea"]);
		 			$max4 = count($comentarios->Listado);

		 		 		
		 		 		 $resultados[$i]["entregas"][$j]["tareas"][$k] = array([
				 					  
							  'inicio' => $tarFila["inicio"],
							  'entrega' =>utf8_encode($tarFila["entrega"]),
							  'progreso' =>utf8_encode($tarFila["progreso"]),
							  'titulo' =>utf8_encode($tarFila["titulo"]),
							  'descripcion' =>utf8_encode($tarFila["descripcion"]),
							  'numComentarios'=> $max4,
				 		
				 		]);

		 		 
		 		 };

			};

	}



} else{

	$resultados["validacion"] = "error";
}


$resultadosJson = json_encode($resultados);

echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';

?>