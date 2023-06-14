<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta</title>
</head>
<body>
    <?php
        $us="luis";
        $ps="1234";
        $res="";
        $fus=$_POST['user'];
        $Fps=$_POST['password'];
        if($us==$fus && $ps==$Fps){
            $res="Correcto";
        }else{
            $res="Incorrecto";
        }
    ?>
    <h1>Respuesta...</h1>
    <h3>Hola : <?php echo($fus) ?> </h3>
    <h3>Tu logueo es : <?= $res ?> </h3>
</body>
</html>