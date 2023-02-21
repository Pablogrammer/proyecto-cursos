<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo $response->message;}
        else{
            echo 'Actualizar ponente '. $id;
            
        }
        
        ?>
        <form action= "<?php $_ENV['BASE_URL']?>" method="post">
        <label for="id">ID: </label><input type="text" name="data[id]" id="id" value="<?= $id; ?>" readonly><br>
        <label for="nombre">Nombre: </label><input type="text" name="data[nombre]" id="nombre"><br>
        <label for="apellidos">Apellidos: </label><input type="text" name="data[apellidos]" id="apellidos"><br>
        <label for="correo">Correo: </label><input type="correo" name="data[correo]" id="correo"><br>
        <label for="imagen">Imagen: </label><input type="imagen" name="data[imagen]" id="imagen"><br>
        <label for="tags">Tags: </label><input type="tags" name="data[tags]" id="tags"><br>
        <label for="redes">Redes: </label><input type="redes" name="data[redes]" id="redes"><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>