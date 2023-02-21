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
        
        //TODO No funciona esta validación
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(gettype($this->usuario->validarDatos($datos)) == 'boolean'){

                $data = json_decode($datos);

                $nombre = $data->nombre;
                $apellidos = $data->apellidos;
                $email = $data->email;
                $passw = $data->passw;
                $passw_s = $this -> security -> encriptaPassw($passw);

                echo 'entra';
                if(empty($this->usuario->comprobarCorreo($email))){
                    echo 'correo ya existe';
                    $response = json_decode(ResponseHttp::statusMessage(200, 'Usuario Creado Correctamente'));
                    $this->usuario->crear($nombre,$apellidos, $email, $passw_s);
    
                }else{
                    $response = json_decode(ResponseHttp::statusMessage(400, 'El correo ya existe en la base de datos'));
    
                }
            }else{
                $response = $this->usuario->validarDatos($datos);
    
            }
           
        }
        return $response;


        //TODO Hacer el login 

    }

    
}

?>