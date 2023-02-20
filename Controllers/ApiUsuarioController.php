<?php 

namespace Controllers;

use Lib\Pages;
use Models\Usuario;

class ApiUsuarioController{

    private Usuario $usuario;
    private Pages $pages;



    public function __construct(){
        $this -> usuario = new Usuario();
        $this -> pages = new Pages();
    }

    public function register(){
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data = json_decode(file_get_contents("php://input"));
            // var_dump($data);


            $nombre = $data->nombre;
            $apellidos = $data->apellidos;
            $email = $data->email;
            $passw = $data->passw;

            var_dump($data);

            if(empty($this->usuario->comprobarCorreo($email))){
                
                $this->usuario->crear($nombre,$apellidos, $email, $passw);


            }else{
                echo "este correo: $email ya existe en la base de datos";
            }

            echo "Nombre: " .$nombre. "<br> Email: " .$email. "<br> Contraseña: " .$passw; //TODO Ahora comprobar que no existe en la base de datos y en ese caso meterlo

        }

        //TODO Hacer también el login con los mismos pasos

    }
}

?>