<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>

    <form action="<?php $_ENV['BASE_URL']?>" method="post">
        <label for="nombre">Email: </label><input type="email" name="data[email]" id="email"><br>
        <label for="contraseña">Contraseña: </label><input type="password" name="data[passw]" id="passw"><br>
        <input type="submit" value="Enviar">
    </form>

    <p><?php if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($response) && gettype($response) == 'string'){
            echo '<p style="color:red;">'.$response.'</p>';
        }
     } ?></p>


<br><a href="<?php $_ENV['BASE_URL']?>../..">Volver</a>

</body>
</html>