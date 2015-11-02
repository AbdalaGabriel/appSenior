

		

$('#formulario').submit(function() {

					alert("h");
					$.mobile.pageContainer.pagecontainer({ defaults: true });
					var home = $("#home" );
					$( ":mobile-pagecontainer" ).pagecontainer( "change", home, { reload:true, transition:'flow', changeHash:true });
				
					var datosUsuario = $("#nombredeusuario").val()
					var datosPassword = $("#clave").val()
					archivoValidacion = "validacionReal2.php?jsoncallback=?"
					 
					$.getJSON( archivoValidacion, { usuario:datosUsuario ,password:datosPassword}) 
					
					.done(function(respuestaServer) {

						if(respuestaServer.validacion == "ok"){ 

							console.log("bienvenido");
							getProjects(respuestaServer);

							
						 } else{

						 	console.log("lo sentimos ha habido un problema");
						 } 


						var datosLocales = JSON.stringify(respuestaServer);
				        //alert(datosLocales);
						localStorage.setItem("datos", datosLocales);
						var datosGuardados = localStorage.getItem("datos");
					  	var datosObjeto = JSON.parse(datosGuardados); 
						var usuario = datosObjeto.usuario;
						
						/* ESTO ES PARA LEER LO QUE ESTA ALMACENADO LOCALMENTE CUANDO TENGAN QUE MOSTRARLO:

						var datosGuardados = localStorage.getItem("datos");
					  	var datosObjeto = JSON.parse(datosGuardados); 

						*/
						// esto muestra un dato como ejemplo:
						//	alert(datosObjeto[0].nombre);

						});

				});


// JavaScript Document
function getProjects(objetodeDatos)	{


				$("#home").on("pageshow", function(){ //al mostrarse esa pagina pasa algo.
							
							console.log(respuestaServer);

							var datosLocales = JSON.stringify(respuestaServer);
					        //alert(datosLocales);
							localStorage.setItem("datos", datosLocales);


							datosGuardados = localStorage.getItem("datos");
						  	var datosObjeto = JSON.parse(datosGuardados); 

							var usuario = datosObjeto.usuario;
							alert(datosGuardados);




							$("#titulo").append("Bienvenido, "+ respuestaServer.usuario);
							
							var elementos = (Object.keys(respuestaServer).length)-2;

							for(var i=0; i<elementos; i++){

								$("#proyectos").append('<div class="proyWp"><a class="proToggle" data-idProy="'+i+'" href="#">' + respuestaServer[i][0].nombre + '</a></div>');
							
							}


							$(".proToggle").click(function(){

								var idProyecto =  $(this).attr("data-idProy");
								var tituloPro =  $(this).text();

								$.mobile.changePage("#projects");

								$("#tituloProyectos").append(tituloPro);

								var entregas =  (Object.keys(respuestaServer[idProyecto].entregas).length);

								
								for(var j=0; j<entregas; j++){

									$("#entregas").append('<a class="entregaToggle" data-numEntrega="'+j+'" href="#">' + respuestaServer[idProyecto].entregas[j][0].titulo + '</a>');

									var tareas =  (Object.keys(respuestaServer[idProyecto].entregas[j].tareas).length);

									if(tareas>0){

										for(var k=0; k<tareas; k++){

											$("#entregas").append('<div class="tareasWp"><div class="hiden"><input class="check" type="checkbox" name="'+respuestaServer[idProyecto].entregas[j].tareas[k][0].titulo+'" value=""><p class="tarea">'+respuestaServer[idProyecto].entregas[j].tareas[k][0].titulo +'</p></div ><div class="tagsWp"><span class="fecha">'+respuestaServer[idProyecto].entregas[j].tareas[k][0].entrega+'</span></div><div class="comentsWp"><span class="coments"><a class="com" href="#">'+respuestaServer[idProyecto].entregas[j].tareas[k][0].numComentarios+' comentarios</a></span></div></div>');
										

											$("#entregas").append('');
										

										}


									}



								}
							});

						});

