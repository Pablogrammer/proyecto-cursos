<?php

    require_once __DIR__.'../../vendor/autoload.php';
    use Dotenv\Dotenv;
    use Models\Ponente;
    use Lib\ResponseHttp;
    use Lib\Router;
    use Controllers\PonenteController;
    use Controllers\ApiUsuarioController;
    use Controllers\UsuarioController;


    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    

    //Ruta de la vista principal. En mi caso la función getAll de ponente en la que muestra la lista de ponentes
    Router::add('GET','/',function(){
        (new PonenteController()) -> getAll();
    });

    //Ruta para obtener ponente mediante una id con el método GET
    Router::add('GET','ponente/:id',function(int $ponenteid){
         (new PonenteController()) -> getPonente($ponenteid);
    });

    //Ruta para crear un nuevo ponente mediante GET
    Router::add('GET','ponente/crear', function($datos){
        (new PonenteController()) -> crear($datos);
    });

    //Ruta para crear un nuevo ponente mediante POST
    Router::add('POST','ponente/crear', function($datos){
        (new PonenteController()) -> crear($datos);
    });

    //Ruta para borrar un ponente mediante GET
    Router::add('GET','ponente/borrar/:id', function($ponenteid){
        (new PonenteController()) -> borrar($ponenteid);    
    });

    //Ruta para actualizar un ponente mediante POST
    Router::add('GET', 'ponente/actualizar/:id', function($id){
        (new PonenteController()) -> actualizar($id);
    });

    //Ruta para actualizar un ponente mediante POST
    Router::add('POST', 'ponente/actualizar/:id', function($id){
        (new PonenteController()) -> actualizar($id);
    });

    //Ruta para registrar a un usuario mediante GET 
    Router::add('GET', 'usuario/register', function(){
        (new UsuarioController()) -> register();
    });

    //Ruta para registrar a un usuario mediante POST 
    Router::add('POST', 'usuario/register', function(){
        (new UsuarioController()) -> register();
    });

    //Ruta para logear a un usuario mediante GET 
    Router::add('GET', 'usuario/login', function(){
        (new UsuarioController()) -> login();
    });

    //Ruta para logear a un usuario mediante POST 
    Router::add('POST', 'usuario/login', function(){
        (new UsuarioController()) -> login();
    });

    //Ruta para cerrar sesion de un usuario mediante GET 
    Router::add('GET', 'usuario/logout', function(){
        (new UsuarioController()) -> logout();
    });


    Router::dispatch();

?>