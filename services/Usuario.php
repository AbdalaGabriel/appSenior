
<?php 

class Usuario
{

	public $Id;
	public $Nombre;
	public $Apellido;
	public $Password;
	public $FotoUrl;
	public $Empresa;
	public $Descripcion;
	public $FechaAlta;
	public $Email;
	public $IdTipo;
	public $Listado;
	public $verificar;
	public $ListarProyeUs;
	//Conector
	private $Con;
	
	public function Usuario()
	{
		$this->Con = new Conector("alquimia", "root", "", null); 
	}
	
	public function Agregar()
	{
		$sql = 

		"INSERT INTO `alquimia`.`usuarios` (`nombre`, `foto`, `empresa`, `alta`, `password`, `mail`, `apellido`) 
		VALUES ('$this->Nombre','$this->FotoUrl', '$this->Empresa',	'$this->FechaAlta', '$this->Password', '$this->Email', '$this->Apellido')";
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
		$sql = "SELECT * from usuarios";
	
		if(isset($filtro))
		{
			$sql = $sql.' WHERE idUsuario = '.$filtro;
		}

		$this->Listado = $this->Con->Select($sql);
	}
	
	
	public function VerficarUsuario($correo,$pass){
		
		$sql = "SELECT * FROM usuarios WHERE mail='$correo' and password = '$pass' ";	
		
	
		$this->Verificar  = $this->Con->Select($sql);
		
	
	}


	public function VerificarCliente($nombre,$pass){
		
		$sql = "SELECT * FROM usuarios WHERE nombre='$nombre' and password = '$pass' ";	
		
	
		$this->Verificar  = $this->Con->Select($sql);
		
	
	}
}
?>