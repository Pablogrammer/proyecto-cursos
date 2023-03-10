<?php


namespace Controllers;
use Lib\Pages;
use Lib\ResponseHttp;
use Controllers\ApiUsuarioController;


class UsuarioController{


    private Pages $pages;
    private ApiUsuarioController $api;

    public function __construct(){

        $this -> pages = new Pages();
        $this -> api = new ApiUsuarioController();
    }

    //Llama al método register de ApiUsuarioController y muestra la vista de registro
    public function register(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            
            $response = $this -> api -> register($datos);
           
            
            $this -> pages -> render('usuario/register', ['response' => $response]);

        }
        else{
        $this -> pages -> render('usuario/register');

        }
    }

    //Llama al método login de ApiUsuarioController o devuelve la vista de el formulario
    public function login(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            
            $response = $this -> api -> login($datos);
            
            $this -> pages -> render('usuario/login', ['response' => $response]);

        }
        else{
        $this -> pages -> render('usuario/login');

        }
    }

    //Cierra la sesión del usuario y le devuelve a la vista principal
    public function logout(){
        session_start();
        if(isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' ){
            $_SESSION['usuario'] = '';
            header("Refresh: 0.1; url=".$_ENV['BASE_URL']);
        }
    }
}