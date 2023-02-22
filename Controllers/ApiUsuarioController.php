<?php 

namespace Controllers;

use Lib\Pages;
use Models\Usuario;
use Lib\Security;
use Lib\ResponseHttp;

class ApiUsuarioController{

    private Usuario $usuario;
    private Pages $pages;
    private Security $security;



    public function __construct(){
        $this -> usuario = new Usuario();
        $this -> pages = new Pages();
        $this -> security = new Security();
    }

    //Registra a un usuario en la base de datos, los datos los pasamos en JSON y devuelve un mensaje de respuesta en JSON
    //----------- VALIDADO --------------

    public function register($datos){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(gettype($this->usuario->validarDatosRegister($datos)) == 'boolean'){

                $nombre = $datos['nombre'];
                $apellidos = $datos['apellidos'];
                $email = $datos['email'];
                $passw = $datos['passw'];
                $passw_s = $this -> security -> encriptaPassw($passw);

                if(empty($this->usuario->comprobarCorreo($email))){
                    
                    $this->usuario->crear($nombre,$apellidos, $email, $passw_s);
                    $response = json_decode(ResponseHttp::statusMessage(200, 'Usuario Creado Correctamente'));
    
                }else{
                    $response = json_decode(ResponseHttp::statusMessage(400, 'El correo ya existe en la base de datos'));
    
                }
            }else{
                $response = $this->usuario->validarDatosRegister($datos);
            }   
            $response = json_decode(ResponseHttp::statusMessage(400, 'Metodo incorrecto prueba con POST'));
        }
        
        return $response; 
    }

    public function login($datos){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(gettype($this->usuario->validarDatosLogin($datos)) == 'boolean'){

                $email = $datos['email'];
                $passw = $datos['passw'];


                if($this->usuario->comprobarCorreo($email)){
                    $passw_enc = $this->usuario->obtenerPassword($email);

                    // $response = 'contraseña incorrecta';
                    if($this->security->validaPassw($passw,$passw_enc[0]['password'])){

                        session_start();
                        $_SESSION['usuario'] = $email;
                        $response = json_decode(ResponseHttp::statusMessage(200, 'Sesion iniciada correctamente'));

                    }
                    

                }else{
                    $response = json_decode(ResponseHttp::statusMessage(400, 'El correo no existe en la base de datos'));
                }

            }else{
                $response = $this->usuario->validarDatosLogin($datos);
            }
        }else{
            $response = json_decode(ResponseHttp::statusMessage(400, 'Metodo incorrecto prueba con POST'));

        }

        return $response;
    }


    
}

?>