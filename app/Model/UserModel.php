<?php
    class UserModel{
        //creamos la instancia para conectar con la base de datos 
        private $dbconnection;

        //creamos el constructos para conectar desde ahi con la base de datos 
        public function __construct(){
            //llamamos a la clase coneccion para vincular el model user con la base de datos 
            require_once('../config/BDConnection.php');
            //creamos la instancia de la coneccion a la base de datos en dbconnection
            $this->dbconnection=new BDConnection();
        }
    }
?>