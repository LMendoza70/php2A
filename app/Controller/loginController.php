<?php
    class loginController{
        //creamos un atributo que sera una instancia del modelo usuario
        private $user;

        //creamos el constructor
        public function __construct(){
            //requerimos a user model
            require_once("../Model/UserModel.php");
            //inicializamos el modelo
            $this->user=new UserModel();
        }

        //metodo para definir el logueo
        public function index(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $us=$_POST['user'];
                $ps=$_POST['password'];

                $respuesta=$this->user->getCredentials($us,$ps);
                if($respuesta){
                    header('Location: '.'../View/homeView.html');
                }else{
                    header('Location: '.'../View/errorView.html');
                }

            }
        }


    }
?>