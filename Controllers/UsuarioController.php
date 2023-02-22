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

    public function login(){

        $this -> pages -> render('login');
    }
}