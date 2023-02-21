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


    //Llama a la ApiPonenteController y muestra en una vista todos los ponentes después de hacer un json_decode ya que la respuesta es un JSON
    public function getAll(){

        $response = $this -> api -> getAll();
        $response = json_decode($response);

        $this -> pages -> render('index',['response' => $response]);
    }

    //Llama a la ApiPonenteController y muestra en una vista al ponente solicitado después de hacer un json_decode
    public function getPonente($id){

        $response = $this -> api -> getPonente($id);
        $response = json_decode($response);

        $this -> pages -> render('ponentes/obtenerPonente',['response' => $response]);
    }


    //Llama a la ApiPonenteController y crea un ponente con los datos que le pasamos, 
    //luego muestra una vista después de hacer un json_decode ya que los datos vienen en JSON.

    public function crear($datos){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            
            
            $response = $this -> api -> crear($datos);
            $this -> pages -> render('ponentes/crearPonente',['validacion' => $response]);

            
        }
        else{
        $this -> pages -> render('ponentes/crearPonente');

        }   

    }

    //Llama a ApiPonenteController y este borra el ponente con la $id que le pasamos, luego muestra la vista.
    public function borrar($id){
        $response = $this -> api -> borrar($id);
        

        header("Refresh: 1; url=".$_ENV['BASE_URL']);
        $this -> pages -> render('ponentes/borrado',['response' => $response]);
    }

    //Llama a ApiPonenteController y este actualiza el ponente de la $id que le pasamos, luego muestra la vista.
    public function actualizar($id){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = $_POST['data'];
            
            $response = $this -> api -> actualizar($datos);

            $this -> pages -> render('ponentes/actualizado',['response' => $response]);

        }
        else{
        $this -> pages -> render('ponentes/actualizado', ['id' => $id]);

        }
        
    }
}


?>