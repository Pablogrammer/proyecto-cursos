<?php

    require_once __DIR__.'../../vendor/autoload.php';
    use Dotenv\Dotenv;
    use Models\Ponente;
    use Lib\ResponseHttp;
    use Lib\Router;
    use Controllers\ApiponenteController;
    use Controllers\ApiUsuarioController;


    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    // http_response_code(202);
    // $array = ["estado" => '202', "mensaje" => 'Estamos en el index public'];
    // echo json_encode($array);
    

    Router::add('GET','auth',function(){
        require '../views/auth.php';
    });

    Router::add('GET','ponente',function(){
        (new ApiponenteController()) -> getAll();
    });

    Router::add('GET','ponente/:id',function(int $ponenteid){
         (new ApiponenteController()) -> getPonente($ponenteid);
    });

    Router::add('POST','ponente/crear', function(){
        (new ApiponenteController()) -> crear();
    });

    Router::add('POST', 'usuario/register', function(){
        (new ApiUsuarioController()) -> register();
    });

    Router::add('GET','ponente/borrar/:id', function($ponenteid){
        (new ApiponenteController()) -> borrar($ponenteid);    
    });

    Router::add('POST', 'ponente/actualizar', function(){
        (new ApiPonenteController()) -> actualizar();
    });

    Router::dispatch();

?>