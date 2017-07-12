<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 21:08
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
//Variables
$login = null;
$seccion = null;
$usuario = null;
$sesion = new Sesion();

//LOGOUT
if(isset($_POST["logout"]))
    $sesion->cerrar();
//Estoy logueado en el sistema
if($sesion->get("usuario")!=null) {
    $login = unserialize($sesion->get("usuario"));

//Me creo el objeto de BD
    $bd = new BaseDatos();
//Utilizo este método por parámetros porque así la programación
//es más parametrizada por lo que podría conectarme a otras BD
// en un mismo archivo PHP
    $bd->setPdo(Constantes::$servidor, Constantes::$usuario, Constantes::$clave, Constantes::$basedatos);

//Obtengo la sección en caso de que la hubiese
    if (isset($_GET["seccion"]))
        $seccion = $_GET["seccion"];
//Obtengo el usuario en caso de que lo hubiese
    if (isset($_GET["usuario"]))
        $usuario = $_GET["usuario"];

    //Obtengo  la página en caso de que lo hubiese
    if (isset($_GET["pag"]))
        $pag = $_GET["pag"];
    else
        $pag=1;
    ///ENTRADA
    //Creo la entrada si hay datos por el POST que han sido validados
    if(isset($_POST["publicar"],$_POST["titulo-publicar"],$_POST["fechacreacion"],$_POST["texto-publicar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(crearEntrada($bd,$login)){
            //echo "<script type='text/javascript'>alert('Entrada publicada!')</script>";
        }
    }
    ///COMENTARIO
    //Creo el comentario si hay datos por el POST que han sido validados
    if(isset($_POST["comentar"],$_POST["comentario"],$_POST["fechacreacion"],$_POST["entrada"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(crearComentario($bd,$login)){
           // echo "<script type='text/javascript'>alert('Comentario publicado!')</script>";
        }
    }
    ///EDITAR USUARIO
    //Edito el usuario si hay datos por el POST que han sido validados
    if(isset($_POST["editarperfil"],$_POST["nombre"],$_POST["correo"],$_POST["usuario"],$_POST["fecna"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(validarNombre($_POST["nombre"]) && validarCorreo($_POST["correo"]) && validarUsuario($_POST["usuario"])) {
            if(isset($_POST["password"]) && !empty($_POST["password"]) && $_POST["password"]!=null ) {
                if (validarPassword($_POST["password"])) {
                    $us = crearEditaUsuario($bd, $login->getId());
                    if($us->getImagen()==null)
                        $us->setImagen($login->getImagen());
                    $sesion->set("usuario",$us);
                    $login = $us;
                }else
                    echo '<script language="javascript">alert("Problemas con los campos, no han podido ser validados");</script>';
            }else{
                $us = crearEditaUsuario($bd, $login->getId());
                if($us->getImagen()==null)
                    $us->setImagen($login->getImagen());
                $sesion->set("usuario",$us);
                $login = $us;
            }
        }else
            echo '<script language="javascript">alert("Problemas con los campos, no han podido ser validados");</script>';
    }


    $user = cargaUsuario($usuario, $bd);
//Creo los objetos necesarios
    $head = new VistaHeadFooter();
    $header = new VistaHeader($login);
    $menu = new VistaMenu($user);
    $vistaAmigos = new VistaAmigos(cargaAmigos($user, $bd));
    $vistaActivos = new VistaActivos(cargaActivos($login,$bd));
    $vistaPublicar = new VistaPublicar($login);

//Muestro el contenido del head
    $head->muestraHead();
//Muestro el contenido del header asociado al header
    $header->muestraHeader();
//Muestro el contenido del header asociado al menu
    $menu->muestraMenu();

///MOSTRAR CONTENIDO///

    if (isset($seccion))
        switch ($seccion) {
            case "portada":
                //Muestra los amigos del usuario actual
                $vistaAmigos->muestraAmigos();
                $vistaEntradas = new VistaEntradas(cargaEntradasAmigos($user, $bd), $seccion,$pag);
                $vistaEntradas->muestraEntradasAmigos($user);
                $vistaActivos->muestraActivos();
                break;
            case "bibliografia":
                //Muestra los amigos del usuario actual
                $vistaAmigos->muestraAmigos();
                $vistaPublicar->muestraPublicar();
                $vistaEntradas = new VistaEntradas(cargaEntradasUsuario($user, $bd), $seccion,$pag);
                $vistaEntradas->muestraEntradasUsuario($user);
                $vistaActivos->muestraActivos();
                break;
            case "fotos":
                //Muestra los amigos del usuario actual
                $vistaAmigos->muestraAmigos();
                $vistaEntradas = new VistaEntradas(cargaEntradasUsuario($user, $bd), $seccion,$pag);
                $vistaEntradas->muestraImagenes($user,cargaImagenes($bd,$user));
                $vistaActivos->muestraActivos();
                break;
            case "informacion":
                $vistaPerfil= new VistaPerfil($user);
                if($user->getId()!=$login->getId())
                    $vistaPerfil->muestraPerfil();
                else
                    $vistaPerfil->muestraEditarPerfil();
                break;
            case preg_match('/entrada_([0-9])+/', $seccion) ? true : false:
                //Muestra los amigos del usuario actual
                $vistaAmigos->muestraAmigos();
                $vistaEntradas = new VistaEntradas(cargaEntradasAmigos($user, $bd), $seccion,$pag);
                $entradaCompleta=cargaEntrada($seccion,$bd);
                $vistaEntradas->muestraEntrada($entradaCompleta);
                $comentarios = cargaComentarios($entradaCompleta[0],$bd);
                $vistaComentarios = new VistaComentarios($comentarios);
                $vistaComentarios->muestraPublicaComentario($login,$entradaCompleta[0]);
                if($comentarios!=null && isset($comentarios) && !empty($comentarios))
                    $vistaComentarios->muestraComentarios();
                $vistaActivos->muestraActivos();

                break;
        }


//Muestro el footer
    $head->muestraFooter();

//Cierro la conexion pues ya no la necesito
    $bd->closeConexion();

}else{
    echo "No tiene permisos para ver esta página";
}

?>