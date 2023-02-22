<?php   

    namespace Lib;

    use Dotenv\Dotenv;
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use PDOException;

    class Security{

        //Devuelve secret key de el fichero .env
        final public static function clavesecreta(){
            $dotenv=Dotenv::createImmutable(dirname(__DIR__.'/'));
            $dotenv->load();
            return $_ENV['SECRET_KEY'];
        }

        //Encripta un string
        final public static function encriptaPassw(string $passw): string {
            $passw= password_hash($passw, PASSWORD_DEFAULT);
            return $passw;
        }
    
        //Comprueba que un string($passw) sea igual que una contraseña encriptada ($passwash)
        final public static function validaPassw(string $passw, string $passwash): bool {
            if (password_verify($passw, $passwash)) {
                return true;
            }
            else {
                return false;
            }
        }

        //crea un token
        final public static function crearToken(string $key, array $data) {
            $time= strtotime("now");
            $token= array(
                "iat"=>$time,
                "exp"=>$time + 3600,
                "data"=>$data
            );
            return JWT::encode($token, $key, 'HS256') ;
        }



    }
?>