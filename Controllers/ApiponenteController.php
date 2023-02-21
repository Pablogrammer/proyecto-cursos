<?php


    namespace Controllers;
    use Models\Ponente;
    use Lib\ResponseHttp;
    use Lib\Pages;

    class ApiponenteController{

        private Pages $pages;
        private Ponente $ponente;


        public function __construct()
        {
            
            $this -> ponente = new Ponente("","","","","","");
            $this -> pages = new Pages();
        }


        public function getAll(){
            $ponentes = $this -> ponente -> findAll();
            $PonenteArr = [];
            if(!empty($ponentes)){
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(202,'OK'));
                $PonenteArr["Ponentes"] = [];
                foreach($ponentes as $fila){
                    $PonenteArr["Ponentes"][] = $fila;
                }
            }else{
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(400, 'No hay ponentes'));
                $PonenteArr["Ponentes"] = [];
            }
            if($PonenteArr==[]){
                $response = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
            }else{
                $response = json_encode($PonenteArr);
            }

            return $response;
            
        }

        public function getPonente($id){
            $ponentes = $this -> ponente->findOne($id);
            $PonenteArr = [];
            if(!empty($ponentes)){
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(202,'OK'));
                $PonenteArr["Ponentes"] = [];
                foreach($ponentes as $fila){
                    $PonenteArr["Ponentes"][] = $fila;
                }
            }else{
                $PonenteArr["message"] = json_decode(ResponseHttp::statusMessage(400, 'No hay ponentes'));
                $PonenteArr["Ponentes"] = [];
            }
            if($PonenteArr==[]){
                $response = json_encode(ResponseHttp::statusMessage(400,'No hay ponentes'));
            }else{
                $response = json_encode($PonenteArr);
            }
            return $response;
        }

        //Crea un ponente a partir de un json que le pasemos con los datos de el mismo
        public function crear(){
            $PonenteArr = [];


            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents("php://input"));

                $id = 'null';
                $nombre = $data->nombre;
                $apellidos = $data->apellidos;
                $correo = $data->correo;
                $imagen = $data->imagen;
                $tags = $data->tags;
                $redes = $data->redes;

                if(!empty($this -> ponente -> comprobarCorreo($correo))){
                    $response = json_decode(ResponseHttp::statusMessage(400, 'El correo ya existe en la base de datos'));
                    
                }else{
                    $this -> ponente -> crearPonente($id, $nombre, $apellidos, $correo, $imagen, $tags, $redes);
                    $response = json_decode(ResponseHttp::statusMessage(202,'Ponente creado correctamente'));  
                    
                }
            }else{
                $response = json_decode(ResponseHttp::statusMessage(400, 'El metodo empleado no es correcto prueba con POST'));
                
            }
            return $response;
        }

        //Borra un ponente con una id que le pasemos mediante GET
        public function borrar($id){
            $ponentes = $this -> ponente->findOne($id);
            $PonenteArr = [];
            if(!empty($ponentes)){
                $this -> ponente -> borrarPonente($id);

            }
            if($PonenteArr==[]){
                $response = json_decode(ResponseHttp::statusMessage(200,'Ponente borrado exitosamente'));
            }else{
                $response = json_decode(ResponseHttp::statusMessage(400,'Error al borrar ponente'));
            }
            return $response;
            
        }

        public function actualizar($datos){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
                var_dump($datos);
                
                $id = $datos['id'];
                $nombre = $datos['nombre'];
                $apellidos = $datos['apellidos'];
                $correo = $datos['correo'];
                $imagen = $datos['imagen'];
                $tags = $datos['tags'];
                $redes = $datos['redes'];
                

                if(!empty($this->ponente->comprobarId($id))){
                    $this->ponente->actualizarPonente($id, $nombre, $apellidos, $correo, $imagen, $tags, $redes);
                    $response = json_decode(ResponseHttp::statusMessage(200,'Ponente actualizado exitosamente'));

                }else{
                    $response = json_decode(ResponseHttp::statusMessage(400,'El ponente no existe en la base de datos'));

                }
                }else{
                    $response = json_decode(ResponseHttp::statusMessage(400,'El metodo no es correcto prueba con POST'));

                }

                return $response;
            }

        }
            
        
        

    


