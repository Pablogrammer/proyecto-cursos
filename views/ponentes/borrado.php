<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponente Borrado</title>
</head>
<style>
    body{
        display: flex;
        width: 100%;
        height: 100%;
    }
    #texto{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

</style>
<body>
    <div id="texto">
        <?php 

        echo "<h1>". $response -> message ."</h1>";

        ?>
    </div>
</body>
</html>


