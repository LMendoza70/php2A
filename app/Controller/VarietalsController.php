<?php
    class VarietalsController{
        private $vista;
        public function index(){
            $vista='app/View/IndexVarietalsView.php';
            include_once('app/view/PlantillaView.php');
        }
    }
?>