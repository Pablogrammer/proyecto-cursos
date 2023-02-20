<?php


namespace Controllers;
use Lib\Pages;
use Lib\ResponseHttp;
use Controllers\ApiponenteController;


class PonenteController{


    private Pages $pages;
    private ApiponenteController $api;

    public function __construct(){

        ResponseHttp::setHeaders();
        $this -> pages = new Pages();
        $this -> api = new ApiponenteController();
    }

    public function getAll(){

        $respuesta = $this -> api -> getAll();
        $respuesta = json_decode($respuesta);
        $this -> pages -> render('read',['response' => $respuesta]);
    }
}


?>