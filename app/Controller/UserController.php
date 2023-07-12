<?php
include_once("app/Model/UserModel.php");
class UserController
{
    private $vista;
    private $modelo;

    public function index()
    {

        $modelo = new UserModel();
        $datos = $modelo->getAll();
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            //incluimos al archivo de la plantilla para que este sea llmado y lleve como variable a vista
            $vista = 'app/View/admin/users/IndexUserView.php';
            include_once("app/View/admin/PlantillaView.php");
        } else {
            $vista = 'app/View/admin/HomeView.php';
            include_once("app/View/admin/Plantilla2View.php");
        }
    }

    //creamos el metodo para manadar a llamar a la vista de agregar usuario
    public function CallFormAdd()
    {
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            $vista = 'app/View/admin/users/AddUserView.php';
            include_once('app/view/admin/PlantillaView.php');
        } else {
            $vista = 'app/View/admin/HomeView.php';
            include_once('app/view/admin/Plantilla2View.php');
        }
    }

    public function CallFormLogin()
    {
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            $vista = "app/View/admin/LoginView.php";
            include_once("app/View/admin/PlantillaView.php");
        } else {
            $vista = "app/View/admin/LoginView.php";
            include_once("app/View/admin/Plantilla2View.php");
        }
    }

    //creamos el metodo para agregar un usuario
    public function Add()
    {
        //verificamos si el metodo de envio de datos es POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //almacenamos los datos enviados por el formulario en un arreglo
            $datos = array(
                'Nombre' => $_POST['nombre'],
                'ApPaterno' => $_POST['apaterno'],
                'ApMaterno' => $_POST['amaterno'],
                'Usuario' => $_POST['user'],
                'Password' => $_POST['password'],
                'Sexo' => $_POST['sexo'],
                'FchNacimiento' => $_POST['fchnac']
            );

            //rescatamos la imagen y la procesamos 
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                //obtenemos los datos de la imagen que  cargamos en el formulario
                $nombreArchivo = $_FILES['avatar']['name'];
                $tipoArchivo = $_FILES['avatar']['type'];
                $tamanoArchivo = $_FILES['avatar']['size'];
                $rutaTemporal = $_FILES['avatar']['tmp_name'];
                //validamos tipos de archivos permitidos
                $extenciones = array('jpg', 'jpeg', 'png');
                $extencion = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if (!in_array($extencion, $extenciones)) {
                    echo "El fomato de la imagen no es valido";

                    exit;
                }
                //definimos el tamaño de la imagen a cargar
                $tamanomax = 2 * 1024 * 1024;
                if ($tamanoArchivo > $tamanomax) {
                    echo "ya mejor sube un video o una lona no mms";
                    exit;
                }
                //definimos el nombre que va a tener nuestro archivo
                $nombreArchivo = uniqid('Avatar_') . '.' . $extencion;
                //definimos la ruta destino
                $rutadestino = "app/src/img/avatars/" . $nombreArchivo;

                if (!move_uploaded_file($rutaTemporal, $rutadestino)) {
                    echo "Error al momento de cargar la imagen al servidor";
                    exit;
                }
                $datos['Avatar'] = $nombreArchivo;
            }

            //llamamos al metodo del modelo que agrega al usuario a la base de datos
            $modelo = new UserModel();
            $res = $modelo->insert($datos);
            //podriamos poner un if que dependiendo de si se inserto o no va a 
            //redireccionar a la pantalla de index con los datos actualizados o 
            //me regresa al formulario para reintentar
            //redireccionamos al index de usuarios
            header("Location:http://localhost/php3a/?c=UserController&m=index");
        }
    }

    //Creamos el metodo para llamar a la vista de editar usuario
    public function CallFormEdit()
    {
        //verificamos que el metodo de envio de datos sea GET
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //obtenemos el id del usuario a editar
            $id = $_GET['id'];
            //llamamos al metodo del modelo que obtiene los datos del usuario a editar
            $modelo = new UserModel();
            $datos = $modelo->getById($id);
            //llamamos a la vista de editar usuario
            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                $vista = 'app/View/admin/users/EditUserView.php';
                include_once('app/view/admin/PlantillaView.php');
            } else {
                $vista = 'app/View/admin/HomeView.php';
                include_once('app/view/admin/Plantilla2View.php');
            }
        }
    }
    //Creamos el metodo para editar un usuario
    public function Edit()
    {
        //verificamos que el metodo de envio de datos sea POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //almacenamos los datos enviados por el formulario en un arreglo
            $datos = array(
                'IdUser' => $_POST['id'], //agregamos el id del usuario a editar
                'Nombre' => $_POST['nombre'],
                'ApPaterno' => $_POST['apaterno'],
                'ApMaterno' => $_POST['amaterno'],
                'Usuario' => $_POST['user'],
                'Password' => $_POST['password'],
                'Sexo' => $_POST['sexo'],
                'FchNacimiento' => $_POST['fchnac'],
                'Avatar' => $_POST['ava']
            );

            //rescatamos la imagen y la procesamos 
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                //obtenemos los datos de la imagen que  cargamos en el formulario
                $nombreArchivo = $_FILES['avatar']['name'];
                $tipoArchivo = $_FILES['avatar']['type'];
                $tamanoArchivo = $_FILES['avatar']['size'];
                $rutaTemporal = $_FILES['avatar']['tmp_name'];
                //validamos tipos de archivos permitidos
                $extenciones = array('jpg', 'jpeg', 'png');
                $extencion = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if (!in_array($extencion, $extenciones)) {
                    echo "El fomato de la imagen no es valido";
                    exit;
                }
                //definimos el tamaño de la imagen a cargar
                $tamanomax = 2 * 1024 * 1024;
                if ($tamanoArchivo > $tamanomax) {
                    echo "ya mejor sube un video o una lona no mms";
                    exit;
                }
                //definimos el nombre que va a tener nuestro archivo
                $nombreArchivo = uniqid('Avatar_') . '.' . $extencion;
                //definimos la ruta destino
                $rutadestino = "app/src/img/avatars/" . $nombreArchivo;
                if (!move_uploaded_file($rutaTemporal, $rutadestino)) {
                    echo "Error al momento de cargar la imagen al servidor";
                    exit;
                }
                //borramos la imagen anterior
                $this->modelo = new UserModel();
                $anterior = $this->modelo->getById($_POST['id']);
                if (!empty($anterior['Avatar'])) {
                    unlink('app/src/img/avatars/' . $anterior['Avatar']);
                }
                $datos['Avatar'] = $nombreArchivo;
            } else {
                $datos['Avatar'] = $_POST['ava'];
            }

            //llamamos al metodo del modelo que actualiza los datos del usuario
            $modelo = new UserModel();
            $res = $modelo->update($datos);
            //redireccionamos al index de usuarios
            header("Location:http://localhost/php3a/?c=UserController&m=index");
        }
    }

    //Creamos el metodo para eliminar un usuario de la base de datos, este metodo se llamara una vez que 
    //se haya confirmado la eliminacion del usuario en la vista de index mediante un confirm de javascript
    public function Delete()
    {
        //verificamos que el metodo de envio de datos sea GET
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //obtenemos el id del usuario a eliminar
            $id = $_GET['id'];

            //creo la instancia para obtener los datos a elminar
            $this->modelo = new UserModel();
            $anterior = $this->modelo->getById($id);

            //llamamos al metodo del modelo que elimina al usuario de la base de datos
            $modelo = new UserModel();
            $modelo->delete($id);
            if (!empty($anterior['Avatar'])) {
                unlink('app/src/img/avatars/' . $anterior['Avatar']);
            }
            //redireccionamos al index de usuarios
            header("Location:http://localhost/php3a/?c=UserController&m=index");
        }
    }

    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->modelo = new UserModel();
            $usuario = $this->modelo->getCredentials($_POST['user'], $_POST['password']);
            if ($usuario == false) {
                $vista = 'app/View/admin/LoginView.php';
                include_once("app/View/admin/Plantilla2View.php");
            } else {
                session_start();
                $_SESSION['logedin'] = true;
                $_SESSION['avatar'] = $usuario['Avatar'];
                $_SESSION['nombre'] = $usuario['Nombre'] . ' ' . $usuario['ApPaterno'] . ' ' . $usuario['ApMaterno'];
                $vista = "app/View/admin/homeView.php";
                include_once("app/View/admin/PlantillaView.php");
            }
        }
    }
}
