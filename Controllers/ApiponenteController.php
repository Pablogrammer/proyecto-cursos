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
            ResponseHttp::setHeaders();
            $this -> ponente = new Ponente("","","","","","");
            $this -> pages = new Pages();
        }


        public function getAll(){
            $ponentes = $this -> ponente->findAll();
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
            $this -> pages -> render('read',['response' => $response]);
            
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
            $this -> pages -> render('read',['response' => $response]);
        }

        //Crea un ponente a partir de un json que le pasemos con los datos de el mismo
        public function crear(){

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents("php://input"));
                 var_dump($data);
    
                $id = 'null';
                $nombre = $data->nombre;
                $apellidos = $data->apellidos;
                $correo = $data->correo;
                $imagen = $data->imagen;
                $tags = $data->tags;
                $redes = $data->redes;

                if($this->ponente->comprobarCorreo($correo)){
                    echo "El correo ya existe en la base de datos";
                }else{
                    $this->ponente->crearPonente($id, $nombre, $apellidos, $correo, $imagen, $tags, $redes);
                    echo "Ponente insertado correctamente";
                }
            }
        }

        //Borra un ponente con una id que le pasemos mediante GET
        public function borrar($id){
            $ponentes = $this -> ponente->findOne($id);
            $PonenteArr = [];
            if(!empty($ponentes)){
                $this->ponente->borrarPonente($id);

            }
            if($PonenteArr==[]){
                $response = json_encode(ResponseHttp::statusMessage(400,'No hay ningun ponente con esa id'));
            }else{
                $response = json_encode($PonenteArr);
            }
            $this -> pages -> render('read',['response' => $response]);
        }

        public function actualizar(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {


                $data = json_decode(file_get_contents("php://input"));
                 var_dump($data);
    
                $id = $data->id;
                $nombre = $data->nombre;
                $apellidos = $data->apellidos;
                $correo = $data->correo;
                $imagen = $data->imagen;
                $tags = $data->tags;
                $redes = $data->redes;
                

                if($this->ponente->comprobarId($id)){
                    $this->ponente->actualizarPonente($id, $nombre, $apellidos, $correo, $imagen, $tags, $redes);
                    echo "Ponente actualizado en la base de datos";
                    

                }else{
                    echo "La id del ponente no existe en la base de datos ";
                }
                
                
                }
            }

        }
            
        
        

    


