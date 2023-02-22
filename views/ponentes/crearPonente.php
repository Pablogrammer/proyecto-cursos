<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/styles/style-form.css">
    <title>Document</title>
</head>
<body>
    <h1>Crear ponente</h1>
    <?php if( isset($validacion) && gettype($validacion) == 'string'){
            echo '<p class="validacion">&#10071;'.$validacion.'&#10071;</p>';
        }?>
    
        <form action= "<?php $_ENV['BASE_URL']?>" method="post">
        <label for="nombre">Nombre: </label><input type="text" name="data[nombre]" id="nombre"><br>
        <label for="apellidos">Apellidos: </label><input type="text" name="data[apellidos]" id="apellidos"><br>
        <label for="correo">Correo: </label><input type="correo" name="data[correo]" id="correo"><br>
        <label for="imagen">Imagen: </label><input type="imagen" name="data[imagen]" id="imagen"><br>
        <label for="tags">Tags: </label><input type="tags" name="data[tags]" id="tags"><br>
        <label for="redes">Redes: </label><input type="redes" name="data[redes]" id="redes"><br>

        <input type="submit" value="Enviar">

        

        <br><a href="<?php $_ENV['BASE_URL']?>../">&#9194;Volver</a>
</body>
</html>