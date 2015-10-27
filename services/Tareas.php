<?php 

class Tareas
{

	public $idProyecto;
	public $idTarea;
	public $idEntrega;
	public $nombre;
	public $fecha;
	public $descripcion;
	public $titulo;
	public $Listado;

	//Conector
	private $Con;
	
	public function Tareas()
	{
		$this->Con = new Conector("alquimia", "root", "", null); 
	}
	
	public function Agregar()
	{
		$sql = "INSERT INTO tareas (idEntrega, idProyecto, titulo, descripcion) 
		VALUES ('$this->idEntrega', '$this->idProyecto', '$this->titulo', '$this->descripcion')";
		
		
	
		
		return $this->Con->EjecutarABM($sql); //obtengo un boolean
	}
	
	public function Modificar()
	{
		$sql = "UPDATE tareas SET  fotoPortada = '$this->fotoPortada', descripcion = '$this->descripcion', titulo= '$this->titulo'
		WHERE idProyecto = '$this->idProyecto'";
		
		return $this->Con->EjecutarABM($sql);
	}
	
	public function Eliminar()
	{
		$sql = "DELETE FROM tareas WHERE idProyecto= $this->idProyecto";
		 return $this->Con->EjecutarABM($sql);
	}
	
	public function Listar($filtro = null)
	{
		$sql = "SELECT * FROM tareas ";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idEntrega = '.$filtro;
		}
		
		$orden = " order by idEntrega DESC";
		$sql = $sql.$orden;
		
		$this->Listado = $this->Con->Select($sql);
	}
	
	
	public function ListarPorEntrega($filtro = null)
	{
		$sql = "SELECT * FROM tareas";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idEntrega = '.$filtro;
		}
		


		$this->Listado = $this->Con->Select($sql);
	}
	
	
}
?>