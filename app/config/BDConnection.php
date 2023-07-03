<?php
    class BDConnection{
        //creamos la instancia de coneccion (un atributo para manipular la coneccion )
        private $connection;

        //creamos el constructor de la clase coneccion en este metodo conectamos con la DB
        public function __construct(){
            //llamamos al archivo de configuracion 
            require_once('app/config/config.php');
            //creamos nuestra coneccion a la base de datos
            $this->connection=new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            //manejo de errores 
            if($this->connection->connect_error){
                die('Error al conectar con la base de datos : '.$this->connection->connect_error);
            }
        }

        //metodo para llamar a la coneccion 
        public function getConnection(){
            return $this->connection;
        }

        //metodo para cerrar la coneccion 
        public function closeConnection(){
            $this->connection->close();
        }
    }
?>