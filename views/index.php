
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/style-index.css">
    <title>Ponentes</title>
</head>
<nav class="navbar">
    <?php 
    session_start();
    if(isset($_SESSION['usuario']) && $_SESSION['usuario'] != ''):?>
        <a href="<?php $_ENV['BASE_URL']?>usuario/logout/">Cerrar Sesion</a>  
        <?php else:?>
            <a href="<?php $_ENV['BASE_URL']?>usuario/register/">Registrarse</a>  
            <a href="<?php $_ENV['BASE_URL']?>usuario/login/">Login</a>
        <?php endif;?>
</nav>
<body>
<?php if(isset($_SESSION['usuario']) && $_SESSION['usuario'] != ''):?>
    <h1 class="bienvenido">Bienvenido <?php echo $_SESSION['usuario']?></h1>
    <?php endif;?>


    <div class="container">

    <h1>Lista Ponentes</h1>
<?php 



$ponentes = $response -> Ponentes;



echo '<table><tr><th>Id</th><th>Nombre</th><th>Apellidos</th><th>Correo</th><th>Imagen</th><th>Tags</th><th>Redes</th></tr>';

foreach($ponentes as $ponente){
    echo '<tr><td>'. $ponente -> id.'</td>';
    echo '<td>'. $ponente -> nombre.'</td>';
    echo '<td>'. $ponente -> apellidos.'</td>';
    echo '<td>'. $ponente -> correo.'</td>';
    echo '<td>'. $ponente -> imagen.'</td>';
    echo '<td>'. $ponente -> tags.'</td>';
    echo '<td>'. $ponente -> redes.'</td>';
    if(isset($_SESSION['usuario']) && $_SESSION['usuario'] != ''){
    echo '<td><a href='. $_ENV['BASE_URL'].'ponente/borrar/'. $ponente ->id. ' style="color:red" >&#9940; Borrar &#9940;</a></td>';
    echo '<td><a href='. $_ENV['BASE_URL'].'ponente/actualizar/'. $ponente->id .' style="color:orange">&#9935;&#65039; Editar &#9935;&#65039;</a></td>';
    }
    
    echo "</tr>";
}

echo '</table>';

if(isset($_SESSION['usuario']) && $_SESSION['usuario'] != ''){
    echo '<br><a href='. $_ENV['BASE_URL'].'ponente/crear class="crear"> &#10133; Crear &#10133; </a>';
}  
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo $response->message;
} 
?>
</div>

</body>
</html>

