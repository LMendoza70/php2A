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
    }