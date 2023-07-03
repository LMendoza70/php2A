<?php
    class UserModel{
        //creamos la instancia para conectar con la base de datos 
        private $dbconnection;

        //creamos el constructos para conectar desde ahi con la base de datos 
        public function __construct(){
            //llamamos a la clase coneccion para vincular el model user con la base de datos 
            require_once('app/config/BDConnection.php');
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
            while($user=$result->fetch_assoc()){
                $users[]=$user;
            }
            //cerramos la coneccion a la base de datos 
            $this->dbconnection->closeConnection();
            //arrojamos la respuesta de nuestra consulta "users"
            return $users;
        }

        //metodo para obtener a un usuario por su ID
        public function getById($id){
            //creamos consulta
            $sql="SELECT * FROM user WHERE IdUser='".$id."'";
            //obtenemos la coneccion 
            $connection=$this->dbconnection->getConnection();
            //ejecutamos la consulta
            $reslt=$connection->query($sql);
            //verificamos que traiga datos y los sacamos a una variable
            if($reslt && $reslt->num_rows > 0){
                $user=$reslt->fetch_assoc();
            }else{
                $user=false;
            }
            //cerramos la coneccion
            $this->dbconnection->closeConnection();
            //arrojamos resultados
            return $user;
        }

        //metodo para validar un logueo (usuario y contraseña)
        public function getCredentials($us, $ps){
            //paso1 creamos la consulta
            $sql="SELECT * FROM user WHERE Usuario=$us AND Password=$ps";
            //paso 2 conectamos a la base de datos
            $connection =$this->dbconnection->getConnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt && $reslt->num_rows > 0){
                $user=$reslt->fetch_assoc();
            }else{
                $user=false;
            }
            //paso 5 cerramos la coneccion
            $this->dbconnection->closeConnection();
            //paso 6 arrojamos resultados
            return $user;
        }

        //metodo para eliminar un usuario
        public function deleteRow($id){
            //paso1 creamos la consulta
            $sql="DELETE FROM user WHERE IdUser=$id";
            //paso 2 conectamos a la base de datos
            $connection =$this->dbconnection->getConnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt){
                $res=true;
            }else{
                $res=false;
            }
            //paso 5 cerramos la coneccion
            $this->dbconnection->closeConnection();
            //paso 6 arrojamos resultados
            return $res;
        }
        

        // metodo para insertar un usuario
        public function insert($user){
            //paso1 creamos la consulta
            $sql="INSERT INTO user(Nombre, ApPaterno, ApMaterno, Usuario, Password, Sexo, FchNacimiento) 
            VALUES('".$user['Nombre']."','".$user['ApPaterno']."','".$user['ApMaterno']."',
            '".$user['Usuario']."','".$user['Password']."','".$user['Sexo']."','".$user['FchNacimiento']."')";
            //paso 2 conectamos a la base de datos
            $connection =$this->dbconnection->getConnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt){
                $res=true;
            }else{
                $res=false;
            }
            //paso 5 cerramos la coneccion
            $this->dbconnection->closeConnection();
            //paso 6 arrojamos resultados
            return $res;
        }

        //metodo para editar un usuario
        public function update($user){
            //paso1 creamos la consulta
            $sql="UPDATE user SET Nombre='".$user['Nombre']."', ApPaterno='".$user['ApPaterno']."', 
            ApMaterno='".$user['ApMaterno']."', Usuario='".$user['Usuario']."', Password='".$user['Password']."', 
            Sexo='".$user['Sexo']."', FchNacimiento='".$user['FchNacimiento']."' WHERE IdUser=".$user['IdUser'];
            //paso 2 conectamos a la base de datos
            $connection =$this->dbconnection->getConnection();
            //paso 3 ejecutamos la consulta
            $reslt = $connection->query($sql);
            //paso 4 preparamos la respuesta
            if($reslt){
                $res=true;
            }else{
                $res=false;
            }
            //paso 5 cerramos la coneccion
            $this->dbconnection->closeConnection();
            //paso 6 arrojamos resultados
            return $res;
        }
            
    }
?>