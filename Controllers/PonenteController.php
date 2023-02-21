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
        

        header("Refresh: 1; url=".$_ENV['BASE_URL']);
        $this -> pages -> render('ponentes/borrado',['response' => $response]);
    }

    public function actualizar($id){

        

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            
            $response = $this -> api -> actualizar($datos);
            
            header("Refresh: 1; url=".$_ENV['BASE_URL']);
            $this -> pages -> render('ponentes/obtenerPonente',['response' => $response]);

        }
        else{
        $this -> pages -> render('ponentes/actualizado', ['id' => $id]);

        }
        
    }
}


?>