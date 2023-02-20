<?php


namespace Controllers;
use Lib\Pages;
use Lib\ResponseHttp;
use Controllers\ApiUsuarioController;


class UsuarioController{


    private Pages $pages;
    private ApiUsuarioController $api;

    public function __construct(){

        ResponseHttp::setHeaders();
        $this -> pages = new Pages();
        $this -> api = new ApiUsuarioController();
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = json_encode($_POST['data']);
            $this -> api -> register($datos);
        }
        
        $this -> pages -> render('usuario/register');

    }

    public function login(){

        $this -> pages -> render('login');
    }
}