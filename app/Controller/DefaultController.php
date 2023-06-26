<?php
//definimos la clase default controller que sera la que se 
//invoque al al abrir la pagina en un inicio
    class DefaultController{
        private $vista;
    //feinimos el metodo index que es el metodo que se va a invocar cuando entremos a la pagina principal
        public function index(){
            //inicializamos el atributo vista que contendra la ruta de pa pantalla a 
            //mostrar dentro de nuestra plantilla 
            $vista="app/View/HomeView.php";
            //incluimos al archivo de la plantilla para que este sea llmado y lleve como variable a vista
            include_once("app/View/PlantillaView.php");
        }
    }
?>
