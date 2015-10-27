<?php 

class Proyecto
{

	public $idProyecto;
	public $idUsuario;
	public $nombre;
	public $fecha;
	public $descripcion;
	public $titulo;
	public $Listado;

	//Conector
	private $Con;
	
	public function Proyecto()
	{
		$this->Con = new Conector("alquimia", "root", "", null); 
	}
	
	public function Agregar()
	{
		$sql = "INSERT INTO proyectos (idProyecto, nombre, descripcion, idUsuario) 
		VALUES ('$this->idProyecto', '$this->nombre', '$this->descripcion', '$this->idUsuario')";
		
		
	
		
		return $this->Con->EjecutarABM($sql); //obtengo un boolean
	}
	
	public function Modificar()
	{
		$sql = "UPDATE proyectos SET  fotoPortada = '$this->fotoPortada', descripcion = '$this->descripcion', titulo= '$this->titulo'
		WHERE idProyecto = '$this->idProyecto'";
		
		return $this->Con->EjecutarABM($sql);
	}
	
	public function Eliminar()
	{
		$sql = "DELETE FROM proyectos WHERE idProyecto= $this->idProyecto";
		 return $this->Con->EjecutarABM($sql);
	}
	
	public function Listar($filtro = null)
	{
		$sql = "SELECT * FROM proyectos ";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idUsuario = '.$filtro;
		}
		
		$orden = " order by idProyecto DESC";
		$sql = $sql.$orden;
		
		$this->Listado = $this->Con->Select($sql);
	}
	
	
	public function ListarPorProyecto($filtro = null)
	{
		$sql = "SELECT * FROM proyectos ";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idProyecto = '.$filtro;
		}
		
		$this->Listado = $this->Con->Select($sql);
	}
	
	
}
?>