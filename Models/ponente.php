<?php
    namespace Models;

    use Exception;
    use PDO;
    use PDOException;
    use Lib\BaseDatos;


    class Ponente{
            private string $id;
            private string $nombre;
            private string $apellidos;
            private string $imagen;
            private string $tags;
            private string $redes;

            private BaseDatos $conexion;

            public function __construct(string $id,string $nombre,string $apellidos,string $imagen,string $tags,string $redes)
            {
                $this -> conexion = new BaseDatos();
                $this -> id = $id;
                $this -> nombre = $nombre;
                $this -> apellidos = $apellidos;
                $this -> imagen = $imagen;
                $this -> tags = $tags;
                $this -> redes = $redes;

            }

            /**
             * Get the value of id
             */ 
            public function getId()
            {
                        return $this->id;
            }

            /**
             * Set the value of id
             *
             * @return  self
             */ 
            public function setId($id)
            {
                        $this->id = $id;

                        return $this;
            }

            /**
             * Get the value of nombre
             */ 
            public function getNombre()
            {
                        return $this->nombre;
            }

            /**
             * Set the value of nombre
             *
             * @return  self
             */ 
            public function setNombre($nombre)
            {
                        $this->nombre = $nombre;

                        return $this;
            }

            /**
             * Get the value of apellidos
             */ 
            public function getApellidos()
            {
                        return $this->apellidos;
            }

            /**
             * Set the value of apellidos
             *
             * @return  self
             */ 
            public function setApellidos($apellidos)
            {
                        $this->apellidos = $apellidos;

                        return $this;
            }

            /**
             * Get the value of imagen
             */ 
            public function getImagen()
            {
                        return $this->imagen;
            }

            /**
             * Set the value of imagen
             *
             * @return  self
             */ 
            public function setImagen($imagen)
            {
                        $this->imagen = $imagen;

                        return $this;
            }

            /**
             * Get the value of tags
             */ 
            public function getTags()
            {
                        return $this->tags;
            }

            /**
             * Set the value of tags
             *
             * @return  self
             */ 
            public function setTags($tags)
            {
                        $this->tags = $tags;

                        return $this;
            }

            /**
             * Get the value of redes
             */ 
            public function getRedes()
            {
                        return $this->redes;
            }

            /**
             * Set the value of redes
             *
             * @return  self
             */ 
            public function setRedes($redes)
            {
                        $this->redes = $redes;

                        return $this;
            }

            //Saca en una consulta todos los datos de la tabla ponentes
            public function findAll(){
                $statement = "SELECT * FROM ponentes;";

                try{
                    $statement = $this -> conexion -> consulta($statement);
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            //Saca en una consulta todos los datos de un ponente
            public function findOne($id){
                $statement = "SELECT * FROM ponentes WHERE id=$id;";

                try{
                    $statement = $this -> conexion -> consulta($statement);
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            //Inserta un nuevo ponente en la base de datos
            public function crearPonente($id, $nombre, $apellidos, $correo, $imagen, $tags, $redes){

                $statement = "INSERT INTO ponentes VALUES ('$id','$nombre', '$apellidos', '$correo' , '$imagen', '$tags', '$redes')";

                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }

            }

            //Comprueba que en la base de datos mediante el correo que no hay otro ponente con el mismo correo
            public function comprobarCorreo($correo){
                $statement = "SELECT correo FROM ponentes WHERE correo LIKE '$correo'";

                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            //Saca todos los datos de un ponente mediante su id
            public function comprobarId($id){
                
                $statement = "SELECT * FROM ponentes WHERE id LIKE '$id'";

                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            //Borra un ponente mediante su id de la base de datos
            public function borrarPonente($id){
                $statement = "DELETE FROM `ponentes` WHERE `ponentes`.`id` =  '$id'";

                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            //Actualiza todos los datos de un ponente en la base de datos
            public function actualizarPonente($id, $nombre, $apellidos, $correo, $imagen, $tags, $redes){

                $statement = "UPDATE ponentes SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', imagen = '$imagen', tags = '$tags', redes = '$redes' WHERE ponentes.id = '$id'";
                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }

            }

            //Valida todos los datos que debe de tener un ponente, devuelve true si está bien o un string con el mensaje de error
            public function validarDatos($datos_ponente):string|bool{

                $nombreval = "/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";
                $tagval = "/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";
                $redesval = "/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s:_\-.,]+$/";
                $imgval = "/^.*\.(jpg|png|jpeg)$/";

                if(empty($datos_ponente['nombre']) ||
                    preg_match($nombreval, $datos_ponente['nombre']) === 0){
                    $message = "El nombre solo puede contener letras y espacios";
                }
        
                else if(empty($datos_ponente['apellidos']) ||
                    preg_match($nombreval, $datos_ponente['apellidos']) === 0){
                    $message = "El apellido solo puede contener letras y espacios";
                }

                else if(empty($datos_ponente['imagen']) ||
                    preg_match($imgval, $datos_ponente['imagen']) === 0){
                    $message = "La imagen debe tener el siguiente formato: nombreimagen.jpg/png/jpeg";
                }

                else if(empty($datos_ponente['tags']) ||
                    preg_match($tagval, $datos_ponente['tags']) === 0){
                    $message = "Al menos un tag es requerido y los tags deben tener el siguiente formato: Tag1 Tag2";

                }

                else if(empty($datos_ponente['redes']) ||
                    preg_match($redesval, $datos_ponente['redes']) === 0){
                    $message = "Al menos una red es requerida. No se admiten simbolos. Formato: red_1 red_2";
                }

                if(isset($message)){
                    return $message;
                }else{
                    return true;
                }

            }
        }