
<?php 

class Comentario
{


	public $idTarea;
	public $idUsuario;
	public $mensaje;
	public $Listado;
	public $verificar;
	public $hora;
	public $ListarProyeUs;
	public $fecha;
	//Conector
	private $Con;
	
	public function Comentario()
	{
		$this->Con = new Conector("alquimia", "root", "", null); 
	}
	
	public function Agregar()
	{
		$sql = "INSERT INTO `alquimia`.`comentarios` (`comentario`, `fechaComentario`, `idTarea`, `idUsuario`,`hora`) 
		VALUES ('$this->mensaje','$this->fecha', '$this->idTarea', '$this->idUsuario', '$this->hora')";


		return $this->Con->EjecutarABM($sql);
	}
	
	public function Modificar()
	{
		$sql = 

		 "UPDATE usuarios
		 SET nombre = 'this->Nombre', foto = '$this->FotoUrl' , empresa = '$this->Empresa', password =  '$this->Password', mail =  '$this->Email', apellido = '$this->Apellido',  
		 WHERE idUsuario = $this->Id";
		
		return $this->Con->EjecutarABM($sql);
	}
	
	public function Eliminar()
	{
		$sql = "DELETE FROM usuarios WHERE idUsuario = $this->Id";
		 return $this->Con->EjecutarABM($sql);
	}
	
	public function ListarporProyecto($filtro = null)
	{
		$sql = "Select * from usuarios inner join proyectos on usuarios.idUsuario = proyectos.idUsuario";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idProyecto = '.$filtro;
		}

		$this->ListarProyeUs = $this->Con->Select($sql);
	}
	
	
	public function Listar($filtro = null)
	{
		$sql = "SELECT * from comentarios";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idTarea = '.$filtro;
		}

		$this->Listado = $this->Con->Select($sql);
	}
	
	
	public function ComentariosEnTarea($idTarea){
		
		$sql = "SELECT * FROM comentarios INNER JOIN usuarios ON comentarios.idUsuario=usuarios.idUsuario AND comentarios.`idTarea`=".$idTarea;	
		
	
		$this->Listado  = $this->Con->Select($sql);
		
	
	}


	public function VerificarCliente($nombre,$pass){
		
		$sql = "SELECT * FROM usuarios WHERE nombre='$nombre' and password = '$pass' ";	
		
	
		$this->Verificar  = $this->Con->Select($sql);
		
	
	}
}
?>