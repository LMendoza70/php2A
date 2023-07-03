<?php
//documento enrutador de nuestro proyecto
//definimos una constante que almacene la ruta de todos nuestros controladores
define('controladores','app/Controller/');
//para enrutar se van a manejar 2 variables c para invocar un controlador y 
//m para invocar al metodo deseado de ese controlador, las variable se pasan por la url (como si fuesen get)
//vamos a verficar que se hayan pasado correctamente las variables 
//if comun y corriente mas corriente que comun 
/*if(isset($_GET['c'])){
    $control=$_GET['c'];
}else{
    $control='';
}*/
//operador ternario  variable=condicion?verdadero:falso
//verifica si es que se le paso la variable c desde la url en ese 
//caso la variable control toma ese valor 
$control=isset($_GET['c'])? $_GET['c']:'';
//creamos la reuta al controlador que queremos invocar 
$file=controladores.$control.'.php';
//verificamos si la rita creada es correcta
if(!empty($control) && file_exists($file)){
    //si existe la ruta y existe el archivo creamos un objeto del controlador 
    include_once $file;
    $objeto=new $control();
    //verificamos si le pasamos desde la url la variable m
    $metodo=isset($_GET['m'])?$_GET['m']:'';
    //preguntamos si el metdo fue definido
    if(method_exists($objeto,$metodo) && !empty($metodo)){
        $objeto->$metodo();
    }
}else{
    //si el controlador o el metodo son incorrectos o no fueron definidos 
    //llamamos al controlador por default que muestra el index de nuestra app
    require_once('app/Controller/DefaultController.php');
    //hacemos una instancia de el 
    $def=new DefaultController();
    //invocamos el metodo index de nuestro controlador por default
    $def->index();
}



?>