<?php 

namespace Controllers;

use Lib\Pages;
use Models\Usuario;
use Lib\Security;
use Lib\ResponseHttp;
use Lib\Email;


class ApiUsuarioController{

    private Usuario $usuario;
    private Security $security;
    private Email $mailer;



    public function __construct(){
        $this -> usuario = new Usuario();
        $this -> security = new Security();
    }

    //Registra a un usuario en la base de datos, envia un correo de registro. Los datos los pasamos en JSON y devuelve un mensaje de respuesta en JSON
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
                    $this -> mailer = new Email($email);
                    $this->mailer->sendMail();
                    $response = json_decode(ResponseHttp::statusMessage(200, 'Usuario Creado Correctamente'));
    
                }else{
                    $response = json_decode(ResponseHttp::statusMessage(400, 'El correo ya existe en la base de datos'));
    
                }
            }else{
                $response = $this->usuario->validarDatosRegister($datos);
            }   
            $response = json_decode(ResponseHttp::statusMessage(400, 'Inserta todos los datos'));
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