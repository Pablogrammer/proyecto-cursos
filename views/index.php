
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponentes</title>
</head>
<nav>
    <a href="<?php $_ENV['BASE_URL']?>usuario/register/">Registrarse</a>    
</nav>
<body>
    <style>
        table{
            border: black 1px solid;
        }

        th{
            border: black 1px solid;
        }

        td{
            border: black 1px solid;
        }

    </style>
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
    echo '<td><a href='. $_ENV['BASE_URL'].'ponente/borrar/'. $ponente ->id. ' >Borrar</a></td>';
    echo '<td><a href='. $_ENV['BASE_URL'].'ponente/actualizar/'. $ponente->id .'>Actualizar</a></td>';
    
    echo "</tr>";
}

echo '</table>';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo $response->message;
} 
?>


</body>
</html>

