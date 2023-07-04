<?php
    class VarietalsController{
        private $vista;
        public function index(){
            $vista='app/View/admin/varietals/IndexVarietalsView.php';
            include_once('app/view/admin/PlantillaView.php');
        }
    }
?>