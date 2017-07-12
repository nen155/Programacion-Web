<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 10:50
 */
//Cargo los modelos y las vistas
function __autoload($class){
    if(file_exists('models/class.'.$class.'.php'))
        include_once 'models/class.'.$class.'.php';
    if(file_exists('dao/class.'.$class.'.php'))
        include_once 'dao/class.'.$class.'.php';
    if(file_exists('views/class.'.$class.'.php'))
        include_once 'views/class.'.$class.'.php';
    include_once ("funciones/funciones.php");
}

//Me creo el objeto de BD
$bd = new BaseDatos();
//Utilizo este método por parámetros porque así la programación
//es más parametrizada por lo que podría conectarme a otras BD
// en un mismo archivo PHP
$bd->setPdo(Constantes::$servidor, Constantes::$usuario, Constantes::$clave,Constantes::$basedatos);

$seccion=null;
//Obtengo la sección en caso de que la hubiese
if(isset($_GET["seccion"]))
    $seccion = $_GET["seccion"];

$login=null;
$sesion = new Sesion();
//LOGOUT
if(isset($_POST["logout"]))
    $sesion->cerrar();
else
    if($sesion->get("usuario")!=null && (!isset($_GET["seccion"]) || (isset($_GET["seccion"]) && $_GET["seccion"]!="contacto"))) {
        $login = unserialize($sesion->get("usuario"));
        header("Location: portada.php?usuario=".$login->getUsuario()."&seccion=portada");
    }
    else
        $login = unserialize($sesion->get("usuario"));


//REGISTRO
//Creo el usuario si hay datos por el POST que han sido validados
if(isset($_POST["registro"],$_POST["nombre"],$_POST["correo"],$_POST["usuario"],$_POST["password"],$_POST["fecna"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    if(validarNombre($_POST["nombre"]) && validarCorreo($_POST["correo"]) && validarUsuario($_POST["usuario"]) && validarPassword($_POST["password"])) {
        crearEditaUsuario($bd,null);
        echo '<script language="javascript">alert("Has sido registrado! Inicia Sesión....");</script>';
    }else
        echo '<script language="javascript">alert("Problemas con los campos, no han podido ser validados");</script>';
}

//LOGIN
if(isset($_POST["login"],$_POST["usuario"],$_POST["password"])&& $_SERVER["REQUEST_METHOD"] == "POST"){
    if(validarUsuario($_POST["usuario"]) && validarPassword($_POST["password"]))
    {
        $res = compruebaLoginUsuario($bd);
        if($res!=false) {
            $sesion->set("usuario", $res);
            header("Location: portada.php?usuario=".$_POST["usuario"]."&seccion=portada");
        }
        else
            echo '<section id="popup">Login y password incorrectos!</section>';
    }
}


//Creo los objetos necesarios
$head = new VistaHeadFooter();
$header = new VistaHeader($login);
$index = new VistaIndex($seccion);


//Muestro el contenido del head
$head->muestraHead();
//Muestro el contenido del header asociado al index
$header->muestraHeader();

//Muestro el contenido del index
$index->muestraIndex();

//Muestro el footer
$head->muestraFooter();

//Cierro la conexion que ya no necesito
$bd->closeConexion();
?>