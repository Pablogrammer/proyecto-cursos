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

    public function __construct(){

        $this -> conexion = new BaseDatos();
		$this -> security = new Security();

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

	//Comprueba que el correo no existe ya en la base de datos
	public function comprobarCorreo($email){
		$statement = "SELECT email FROM usuarios WHERE email = '$email'";

		try{
			$statement = $this -> conexion -> consulta($statement);    
			return $statement -> fetchAll(\PDO::FETCH_ASSOC);
		}catch(\PDOException $e){
			exit($e -> getMessage());
		}
	}
	
	//Crea un usuario en la base de datos con los datos que le pasamos
	public function crear($nombre, $apellidos, $email, $passw){  
		
		$statement = "INSERT INTO usuarios (nombre, apellidos, email, password, rol, confirmado) VALUES ('$nombre', '$apellidos', '$email', '$passw', 'user', 0)";

		try{
			$statement = $this -> conexion -> consulta($statement);    
			return $statement -> fetchAll(\PDO::FETCH_ASSOC);
		}catch(\PDOException $e){
			exit($e -> getMessage());
		}
	
	}

	public function validarDatos($datos_usuario):string|bool{

		$nombreval = "/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";
		$emailval = "/^[A-z0-9\\.-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9-]+)*\\.([A-z]{2,6})$/";
		$passwval = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,14}$/";

		if(empty($datos_usuario['nombre']) ||
			preg_match($nombreval, $datos_usuario['nombre']) === 0){
			$message = "El nombre solo puede contener letras y espacios";
		}

		else if(empty($datos_usuario['apellidos']) ||
			preg_match($nombreval, $datos_usuario['apellidos']) === 0){
			$message = "El apellido solo puede contener letras y espacios";
		}

		else if(!preg_match($emailval, $datos_usuario['email'])){
			return "Correo no valido";
		}

		else if(!preg_match($passwval,$datos_usuario['passw'])){
			return "La contrasena debe medir entre 6 y 14 caracteres, al menos tener un numero, al menos una minuscula y al menos una mayuscula";
		}

		if(isset($message)){
			return $message;
		}else{
			return true;
		}

	}
}

?>