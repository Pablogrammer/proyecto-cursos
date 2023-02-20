<?php


namespace Controllers;
use Lib\Pages;
use Lib\ResponseHttp;
use Controllers\ApiponenteController;


class PonenteController{


    private Pages $pages;
    private ApiponenteController $api;

    public function __construct(){

        
        $this -> pages = new Pages();
        $this -> api = new ApiponenteController();
    }

    public function getAll(){

        $response = $this -> api -> getAll();
        $response = json_decode($response);

        $this -> pages -> render('index',['response' => $response]);
    }

    public function getPonente($id){

        $response = $this -> api -> getPonente($id);
        $response = json_decode($response);

        $this -> pages -> render('ponentes/obtenerPonente',['response' => $response]);
    }

    public function crear(){

        $response = $this -> api -> crear();

        $this -> pages -> render('ponentes/crearPonente',['response' => $response]);
    }

    public function borrar($id){
        $response = $this -> api -> borrar($id);
        
    
        $this -> pages -> render('ponentes/borrado',['response' => $response]);
    }

    public function actualizar(){
        $response = $this -> api -> actualizar();

        $this -> pages -> render('ponentes/actualizado',['response' => $response]);
    }
}


?>