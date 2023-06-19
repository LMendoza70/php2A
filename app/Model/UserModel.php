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

        //vamos a crear todos los metodos que requieran coneccion a la base de datos en la instancia 
        //user
        public function getAll(){
            //creamos la consulta a ejecutar
            $sql='SELECT * FROM user';
            //obtenemos la coneccion a la base de datos 
            $connection=$this->dbconnection->getConnection();
            //ejecutamos la consulta
            $result=$connection->query($sql);
            //creamos un arreglo para manipulat a result
            $users=array();
            //vamos a decomponer a result desde un ciclo
            while($user=$result->fethc_assoc()){
                $users[]=$user;
            }
            //cerramos la coneccion a la base de datos 
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "users"
            return $users
        }

        //metodo para obtener a un usuario por su ID
        public function getById($id){
            //creamos consulta
            $sql="SELECT * FROM user WHERE IdUser=$id";
            //obtenemos la coneccion 
            $connection=$this->dbconnection->getConnection();
            //ejecutamos la consulta
            $reslt=$connection->query($sql);
            //verificamos que traiga datos y los sacamos a una variable
            if($reslt && $reslt->num_rows > 0){
                $user=$reslt->fethc_assoc();
            }else{
                $user=false;
            }
            //cerramos la coneccion
            -$this->dbconnection->closeConnection();
            //arrojamos resultados
            return $user;
        }
    }
?>