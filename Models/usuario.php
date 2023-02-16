<?php 

namespace Models;

use Lib\BaseDatos;
use Lib\Security;
class Usuario{

    private string $id;
    private string $nombre;
    private string $apellidos;
    private string $email;
    private BaseDatos $conexion;
	private Security $security;
	private Usuario $usuario;

    public function __construct(){

        $this -> conexion = new BaseDatos();

    }

    


	/**
	 * @return string
	 */
	public function getId(): string {
		return $this->id;
	}

	/**
	 * @param string $id 
	 * @return self
	 */
	public function setId(string $id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getNombre(): string {
		return $this->nombre;
	}

	/**
	 * @param string $nombre 
	 * @return self
	 */
	public function setNombre(string $nombre): self {
		$this->nombre = $nombre;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getApellidos(): string {
		return $this->apellidos;
	}

	/**
	 * @param string $apellidos 
	 * @return self
	 */
	public function setApellidos(string $apellidos): self {
		$this->apellidos = $apellidos;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}
	
	/**
	 * @param string $email 
	 * @return self
	 */
	public function setEmail(string $email): self {
		$this->email = $email;
		return $this;
	}

	public function comprobarCorreo($email){
		$statement = "SELECT email FROM usuarios WHERE email = '$email'";

		try{
			$statement = $this -> conexion -> consulta($statement);    
			return $statement -> fetchAll(\PDO::FETCH_ASSOC);
		}catch(\PDOException $e){
			exit($e -> getMessage());
		}
	}
	
	public function crear($nombre, $apellidos, $email, $passw){  //TODO comprobar que no funciona
		$passw_s = $this->security->encriptaPassw($passw);

		$statement = "INSERT INTO usuarios (nombre, apellidos, email, password) VALUES ($nombre, $apellidos, $email, $passw_s)";

		try{
			$statement = $this -> conexion -> consulta($statement);    
			return $statement -> fetchAll(\PDO::FETCH_ASSOC);
		}catch(\PDOException $e){
			exit($e -> getMessage());
		}
	
	}
}

?>