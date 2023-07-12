<?php
//definimos la clase default controller que sera la que se 
//invoque al al abrir la pagina en un inicio
class DefaultController
{
    private $vista;
    //feinimos el metodo index que es el metodo que se va a invocar cuando entremos a la pagina principal
    public function index()
    {
        //inicio sesion
        $vista = "app/View/admin/HomeView.php";
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            //incluimos al archivo de la plantilla para que este sea llmado y lleve como variable a vista
            include_once("app/View/admin/PlantillaView.php");
        } else {
            include_once("app/View/admin/Plantilla2View.php");
        }
    }
}
