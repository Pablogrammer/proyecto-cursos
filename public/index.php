<?php

    require_once __DIR__.'../../vendor/autoload.php';
    use Dotenv\Dotenv;
    use Models\Ponente;
    use Lib\ResponseHttp;
    use Lib\Router;
    use Controllers\ApiponenteController;
    use Controllers\PonenteController;
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
        (new PonenteController()) -> getAll();
    });

    Router::add('GET','ponente/:id',function(int $ponenteid){
         (new PonenteController()) -> getPonente($ponenteid);
    });

    Router::add('POST','ponente/crear', function(){
        (new PonenteController()) -> crear();
    });

    Router::add('GET','ponente/borrar/:id', function($ponenteid){
        (new PonenteController()) -> borrar($ponenteid);    
    });

    Router::add('POST', 'ponente/actualizar', function(){
        (new PonenteController()) -> actualizar();
    });

    Router::add('POST', 'usuario/register', function(){
        (new ApiUsuarioController()) -> register();
    });

    Router::dispatch();

?>