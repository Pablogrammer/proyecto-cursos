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
    public function register($datos){
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = json_decode($datos);

            $nombre = $data->nombre;
            $apellidos = $data->apellidos;
            $email = $data->email;
            $passw = $data->passw;
            $passw_s = $this -> security -> encriptaPassw($passw);


            if(empty($this->usuario->comprobarCorreo($email))){

                $response = json_decode(ResponseHttp::statusMessage(200, 'Usuario Creado Correctamente'));
                $this->usuario->crear($nombre,$apellidos, $email, $passw_s);


            }else{
                $response = json_decode(ResponseHttp::statusMessage(400, 'El correo ya existe en la base de datos'));

            }
        }else{
            $response = json_decode(ResponseHttp::statusMessage(404, 'El Metodo no es correcto prueba con POST'));

        }
        return $response;


        //TODO Hacer también el login con los mismos pasos

    }

    
}

?>