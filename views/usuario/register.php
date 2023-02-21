<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action= "$_ENV[BASE_URL].ponente/borrar/" method="post">
        <label for="nombre">Nombre: </label><input type="text" name="data[nombre]" id="nombre"><br>
        <label for="apellidos">Apellidos: </label><input type="text" name="data[apellidos]" id="apellidos"><br>
        <label for="email">Email: </label><input type="email" name="data[email]" id="email"><br>
        <label for="password">Contraseña: </label><input type="password" name="data[passw]" id="passw"><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>