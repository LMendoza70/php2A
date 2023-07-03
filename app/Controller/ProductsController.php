<?php
    class ProductsController{
        private $vista;

        public function index(){
            $vista='app/View/IndexProductsView.php';
            include_once('app/view/PlantillaView.php');
        }
    }
?>