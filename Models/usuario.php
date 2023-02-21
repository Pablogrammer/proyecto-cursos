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

	public function validarDatos($datos_ponente):string|bool{

		$nombreval = "/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";
		$tagval = "/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";
		$redesval = "/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s:_\-.,]+$/";
		$imgval = "/^.*\.(jpg|png|jpeg)$/";

		if(empty($datos_ponente['nombre']) ||
			preg_match($nombreval, $datos_ponente['nombre']) === 0){
			$message = "El nombre solo puede contener letras y espacios";
		}

		else if(empty($datos_ponente['apellidos']) ||
			preg_match($nombreval, $datos_ponente['apellidos']) === 0){
			$message = "El apellido solo puede contener letras y espacios";
		}

		else if(empty($datos_ponente['imagen']) ||
			preg_match($imgval, $datos_ponente['imagen']) === 0){
			$message = "La imagen debe tener el siguiente formato: nombreimagen.jpg/png/jpeg";
		}

		else if(empty($datos_ponente['tags']) ||
			preg_match($tagval, $datos_ponente['tags']) === 0){
			$message = "Al menos un tag es requerido y los tags deben tener el siguiente formato: Tag1 Tag2";

		}

		else if(empty($datos_ponente['redes']) ||
			preg_match($redesval, $datos_ponente['redes']) === 0){
			$message = "Al menos una red es requerida. No se admiten simbolos. Formato: red_1 red_2";
		}

		if(isset($message)){
			return $message;
		}else{
			return true;
		}

	}
}

?>