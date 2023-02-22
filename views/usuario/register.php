<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/styles/style-form.css">
    <title>Register</title>
</head>
<body>
    <h1>Registro</h1>
    <form action= "<?php $_ENV['BASE_URL']?>" method="post">
        <label for="nombre">Nombre: </label><input type="text" name="data[nombre]" id="nombre"><br>
        <label for="apellidos">Apellidos: </label><input type="text" name="data[apellidos]" id="apellidos"><br>
        <label for="email">Email: </label><input type="email" name="data[email]" id="email"><br>
        <label for="password">Contraseña: </label><input type="password" name="data[passw]" id="passw"><br>
        <input type="submit" value="Enviar">
    </form>

    <p><?php if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(isset($response)){
            echo '<p class="validacion">'.$response->message.'</p>';  
        }
     } ?></p>

<br><a href="<?php $_ENV['BASE_URL']?>../../">&#9194;Volver</a>


</body>
</html>