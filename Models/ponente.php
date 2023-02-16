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

            public function findAll(){
                $statement = "SELECT * FROM ponentes;";

                try{
                    $statement = $this -> conexion -> consulta($statement);
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

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

            //Comprueba que en la base de datos no hay otro ponente con el mismo correo
            public function comprobarCorreo($correo){
                $statement = "SELECT correo FROM ponentes WHERE correo LIKE '$correo'";

                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            public function comprobarId($id){
                
                $statement = "SELECT * FROM ponentes WHERE id LIKE '$id'";

                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            public function borrarPonente($id){
                $statement = "DELETE FROM `ponentes` WHERE `ponentes`.`id` =  '$id'";

                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }
            }

            public function actualizarPonente($id, $nombre, $apellidos, $correo, $imagen, $tags, $redes){

                $statement = "UPDATE ponentes SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', imagen = '$imagen', tags = '$tags', redes = '$redes' WHERE ponentes.id = '$id'";
                try{
                    $statement = $this -> conexion -> consulta($statement);    
                    return $statement -> fetchAll(\PDO::FETCH_ASSOC);
                }catch(\PDOException $e){
                    exit($e -> getMessage());
                }

            }
        }