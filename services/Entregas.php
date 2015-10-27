<?php 

class Entregas
{

	public $idProyecto;
	public $idEntrega;
	public $nombre;
	public $fecha;
	public $descripcion;
	public $titulo;
	public $Listado;

	//Conector
	private $Con;
	
	public function Entregas()
	{
		$this->Con = new Conector("alquimia", "root", "", null); 
	}
	
	public function Agregar()
	{
		$sql = "INSERT INTO entregas (idEntrega, idProyecto, titulo, descripcion) 
		VALUES ('$this->idEntrega', '$this->idProyecto', '$this->titulo', '$this->descripcion')";
		
		
	
		
		return $this->Con->EjecutarABM($sql); //obtengo un boolean
	}
	
	public function Modificar()
	{
		$sql = "UPDATE entregas SET  fotoPortada = '$this->fotoPortada', descripcion = '$this->descripcion', titulo= '$this->titulo'
		WHERE idProyecto = '$this->idProyecto'";
		
		return $this->Con->EjecutarABM($sql);
	}
	
	public function Eliminar()
	{
		$sql = "DELETE FROM entregas WHERE idProyecto= $this->idProyecto";
		 return $this->Con->EjecutarABM($sql);
	}
	
	public function Listar($filtro = null)
	{
		$sql = "SELECT * FROM entregas ";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idProyecto = '.$filtro;
		}
		
		$orden = " order by idProyecto DESC";
		$sql = $sql.$orden;
		
		$this->Listado = $this->Con->Select($sql);
	}
	
	
	public function ListarPorProyecto($filtro = null)
	{
		$sql = "SELECT * FROM entregas";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idProyecto = '.$filtro;
		}
		
		

		$this->Listado = $this->Con->Select($sql);
	}
	
	
}
?>