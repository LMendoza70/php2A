<?php
class PresentsController
{
    private $vista;

    public function index()
    {
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            //incluimos al archivo de la plantilla para que este sea llmado y lleve como variable a vista
            $vista = 'app/View/admin/presents/IndexPresentsView.php';
            include_once("app/View/admin/PlantillaView.php");
        } else {
            $vista = "app/View/admin/HomeView.php";
            include_once("app/View/admin/Plantilla2View.php");
        }
    }
}
