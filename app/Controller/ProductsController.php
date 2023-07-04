<?php
    class ProductsController{
        private $vista;

        public function index(){
            $vista='app/View/admin/products/IndexProductsView.php';
            include_once('app/view/admin/PlantillaView.php');
        }
    }
?>