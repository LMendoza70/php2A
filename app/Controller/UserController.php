<?php
include_once("app/Model/UserModel.php");
    class UserController{
        private $vista;
        private $modelo;
        
        public function index(){
            $modelo=new UserModel();
            $datos=$modelo->getAll();
            $vista='app/View/IndexUserView.php';
            include_once('app/view/PlantillaView.php');
        }

        //creamos el metodo para manadar a llamar a la vista de agregar usuario
        public function CallFormAdd(){
            $vista='app/View/AddUserView.php';
            include_once('app/view/PlantillaView.php');
        }

        //creamos el metodo para agregar un usuario
        public function Add(){
            //verificamos si el metodo de envio de datos es POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //almacenamos los datos enviados por el formulario en un arreglo
                    $datos=array(
                        'Nombre'=>$_POST['nombre'],
                        'ApPaterno'=>$_POST['apaterno'],
                        'ApMaterno'=>$_POST['amaterno'],
                        'Usuario'=>$_POST['user'],
                        'Password'=>$_POST['password'],
                        'Sexo'=>$_POST['sexo'],
                        'FchNacimiento'=>$_POST['fchnac']
                    );
                    //llamamos al metodo del modelo que agrega al usuario a la base de datos
                    $modelo=new UserModel();
                    $modelo->insert($datos);
                    //redireccionamos al index de usuarios
                    header("Location:http://localhost/php3a/?c=UserController&m=index");
            }
        }

        //Creamos el metodo para llamar a la vista de editar usuario
        public function CallFormEdit(){
            //verificamos que el metodo de envio de datos sea GET
            if($_SERVER['REQUEST_METHOD']=='GET'){
                //obtenemos el id del usuario a editar
                $id=$_GET['id'];
                //llamamos al metodo del modelo que obtiene los datos del usuario a editar
                $modelo=new UserModel();
                $datos=$modelo->getById($id);
                //llamamos a la vista de editar usuario
                $vista='app/View/EditUserView.php';
                include_once('app/view/PlantillaView.php');
            }
        }
        //Creamos el metodo para editar un usuario
        public function Edit(){
            //verificamos que el metodo de envio de datos sea POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //almacenamos los datos enviados por el formulario en un arreglo
                $datos=array(
                    'IdUser'=>$_POST['id'],//agregamos el id del usuario a editar
                    'Nombre'=>$_POST['nombre'],
                    'ApPaterno'=>$_POST['apaterno'],
                    'ApMaterno'=>$_POST['amaterno'],
                    'Usuario'=>$_POST['user'],
                    'Password'=>$_POST['password'],
                    'Sexo'=>$_POST['sexo'],
                    'FchNacimiento'=>$_POST['fchnac']
                );
                //llamamos al metodo del modelo que actualiza los datos del usuario
                $modelo=new UserModel();
                $modelo->update($datos);
                //redireccionamos al index de usuarios
                header("Location:http://localhost/php3a/?c=UserController&m=index");
            }
        }
    }