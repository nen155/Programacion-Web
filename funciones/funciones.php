<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 08/05/2017
 * Time: 19:37
 */

function  validarCorreo($correo){
    return preg_match("/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?/",$correo);
}
function  validarTelefono($telefono){
    return preg_match("/^((\+?34([ \t|\-])?)?[9|6|7|8]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})/",$telefono);
}
function  validarNombre($nombre){
    return preg_match("/^[a-zA-Z\s]+/",$nombre);
}
function  validarUsuario($usuario){
    return preg_match("/^(([0-9a-zA-Z]+)[\.-_]?([0-9a-zA-Z]+))+/",$usuario);
}
function  validarPassword($password){
    return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){6,15}/",$password);
}
/**
 * Filtra los datos de un formulario
 * @param $datos
 * @return string
 */
function filtrado($datos)
{
    if (gettype($datos) == "string") {
        $datos = trim($datos); // Elimina espacios antes y después de los datos
        $datos = stripslashes($datos); // Elimina backslashes \
        $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
    }
    return $datos;
}
///FUNCIONES DE CARGA BD//
/**
 * Se encarga de buscar los amigos del usuario actual
 * @param $usuario
 * @param $bd
 * @return array
 */
function cargaAmigos($usuario,$bd){
    //Utilizo los objetos DAO para añadir el usuario a la BD
    $daoUsuario = new Usuarios($bd);
    return $daoUsuario->getAmigos($usuario);
}

/**
 * Carga las entradas de los amigos de un usuario
 * @param $usuario
 * @param $bd
 * @return array
 */
function cargaEntradasAmigos($usuario, $bd){
    $daoPublicaciones = new Entradas($bd);
    return $daoPublicaciones->getEntradasAmigos($usuario);
}

/**
 * Carga los usuarios activos de un usuario
 * @param $usuario
 * @param $bd
 * @return array
 */
function cargaActivos($usuario, $bd){
    $daoUsuarios = new Usuarios($bd);
    return $daoUsuarios->getUsuariosActivos($usuario);
}
/**
 * Carga las entradas de de un usuario
 * @param $usuario
 * @param $bd
 * @return array
 */
function cargaEntradasUsuario($usuario, $bd){
    $daoPublicaciones = new Entradas($bd);
    return $daoPublicaciones->getEntradasUsuario($usuario);
}

/**
 * Dependiendo del usuario carga sus datos
 * @param $usuario
 * @param $bd
 * @return Usuario
 */
function cargaUsuario($usuario,$bd){
    $daoUsuario = new Usuarios($bd);
    return $daoUsuario->getUsuario($usuario);
}

/**
 * Devuelve una entrada completa, es decir, el elemento 0 del array es la entrada,
 * el elemento 1 del array es el usuario que la creó y el elemento 2 es una array
 * de imagenes si las tuviese
 * @param $entrada
 * @param $bd
 * @return array
 */
function cargaEntrada($entrada,$bd){
    $daoEntrada = new Entradas($bd);
    $ent = preg_split("/_/",$entrada);
    $entt = new Entrada($ent[1]);
    $entradaCompleta = $daoEntrada->getEntrada($entt);
    return $entradaCompleta;
}

/**
 * Devuelve un array con todos los comentarios asociados a una entrada
 * donde el elmento 0 es el comentario y el 1 es el usuario que lo creó
 * @param $entrada
 * @param $bd
 * @return array
 */
function cargaComentarios($entrada,$bd){
    $daoComentario = new Comentarios($bd);
    return $daoComentario->getComentariosEntrada($entrada);
}

/**
 * Crea el comentario de una entrada
 * @param $bd
 * @return bool
 */
function crearComentario($bd,$usuario){
    //Hago un filtrado previo por si hay valores indeseables en el array
    $arrayFiltrado=array();
    foreach ($_POST as $k => $v)
        $arrayFiltrado[$k] = filtrado($v);
    $entrada = new Entrada($arrayFiltrado["entrada"]);
    $comentario = new Comentario(NULL,$arrayFiltrado["comentario"],$arrayFiltrado["fechacreacion"]);
    $daoComentario = new Comentarios($bd);
    $daoComentario->addComentario($comentario,$entrada,$usuario);
    return true;
}

/**
 * Obtiene las imágenes de asociadas a un usuario
 * @param $bd
 * @param $usuario
 * @return array
 */
function cargaImagenes($bd,$usuario){
    $daoImagenes = new Imagenes($bd);
    return $daoImagenes->getImagenesUsuario($usuario);
}

/**
 * Comprueba el intento de login del usuario
 * @param $bd
 * @return bool|Usuario
 */
function compruebaLoginUsuario($bd){
    //Hago un filtrado previo por si hay valores indeseables en el array
    $arrayFiltrado=array();
    foreach ($_POST as $k => $v)
        $arrayFiltrado[$k] = filtrado($v);

    //Utilizo los objetos DAO para añadir el usuario a la BD
    $daoUsuario = new Usuarios($bd);
    $usuario = new Usuario();
    $usuario->setPassword($arrayFiltrado["password"]);
    $usuario->setUsuario($arrayFiltrado["usuario"]);
    $resultado = $daoUsuario->compruebaCredenciales($usuario);
    //Compruebo si tengo usuario
    if($resultado!=false) {
        $usuario->setPassword(null);
        $usuario->setId($resultado["id"]);
        $usuario->setImagen($resultado["imagen"]);
        return $usuario;
    }
    else
        return false;
}

/**
 * Crea un usuario
 * @param $bd
 * @return
 */
function crearEditaUsuario($bd, $id){
    //Hago un filtrado previo por si hay valores indeseables en el array
    $arrayFiltrado=array();
    foreach ($_POST as $k => $v)
        $arrayFiltrado[$k] = filtrado($v);

    //Trato el nombre que me han pasado por el POST
    if(strpos($arrayFiltrado["nombre"]," ")!== false) {
        $nombreCompleto = preg_split("/[\s,]+/", $arrayFiltrado["nombre"]);
        $apellidos = substr($arrayFiltrado["nombre"], strlen($nombreCompleto[0]) + 1);
		$nombreParseado=$nombreCompleto[0];
    }
    else {
        $nombreParseado = $arrayFiltrado["nombre"];
        $apellidos= "";
    }
    //Creo el modelo del usuario con los datos del POST
    $usuario = new Usuario($id,$nombreParseado,$apellidos,$arrayFiltrado["correo"],$arrayFiltrado["telefono"],$arrayFiltrado["usuario"],$arrayFiltrado["password"],$arrayFiltrado["fecna"],"img/perfil.png",0);
    //Utilizo los objetos DAO para añadir el usuario a la BD
    $daoUsuario = new Usuarios($bd);
    if($id==null)
        $daoUsuario->addUsuario($usuario);
    else{
        //Subo la imagen al servidor
        if(isset($_FILES["imagen"]) && $_FILES["imagen"]!=null &&!empty($_FILES["imagen"]) && isset($_FILES['imagen']['name']) && strlen ($_FILES['imagen']['name'])>0) {
            $entrada = new Entrada(null,"Mi nueva imágen de perfil"," ",date("Y-m-d H:i:s"));
            $daoEntrada = new Entradas($bd);
            $daoEntrada->addEntrada($entrada, $usuario);
            $entrada->setId($bd->getLastId());
            $ruta = subidaFichero($bd, $usuario->getUsuario(), $entrada);
            $usuario->setImagen($ruta);
        }
        $daoUsuario->editaUsuario($usuario);
        return $usuario;
    }
}

/**
 * Crea una entrada
 * @param $bd
 * @param $usuario
 * @return
 */
function crearEntrada($bd,$usuario){
    //Hago un filtrado previo por si hay valores indeseables en el array
    $arrayFiltrado=array();
    foreach ($_POST as $k => $v)
        $arrayFiltrado[$k] = filtrado($v);

    //Me creo la entrada
    $entrada = new Entrada(NULL,$arrayFiltrado["titulo-publicar"],$arrayFiltrado["texto-publicar"],$arrayFiltrado["fechacreacion"],$usuario->getId());
    $daoEntrada = new Entradas($bd);
    $daoEntrada->addEntrada($entrada,$usuario);
    $entrada->setId($bd->getLastId());
    //Subo la imagen al servidor
    if($_FILES["imagen"]!=null && isset($_FILES["imagen"])&&!empty($_FILES["imagen"]) && strlen ($_FILES['imagen']['name'])>0)
        subidaFichero($bd,$usuario->getUsuario(),$entrada);
    return true;
}

/**
 * Sube un archivo al servidor con el nombre propio del archivo en la ruta del
 * usuario ej: pepe/nombrearchivo.jpg
 * @param $bd
 * @param $usuario
 * @param $entrada
 * @return
 */
function subidaFichero($bd,$usuario,$entrada){
    if(isset($_FILES['imagen']['name']) && strlen ($_FILES['imagen']['name'])>0) {
        $dir_subida = $usuario . "/";
        ///////////NO TENGO PERMISOS DE CREAR CARPETAS!!!!!!!
        if ( !is_dir($dir_subida) && is_writable("../redsocial")) {
            mkdir($dir_subida,0755, true);
        }else
            $dir_subida="img/";
        $path = $_FILES['imagen']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $fichero_subido = $dir_subida . $usuario . date("Ymd_Hm").".".$ext;
        /////NO TENGO PERMISOS PARA SUBIR ARCHIVOS!!!!
        if(is_writable($dir_subida)) {
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
                echo "Problema de ataque de subida de ficheros!.\n";
            }
        }
        $imagen = new Imagen(null, $fichero_subido, $entrada->getId());
        $daoImagenes = new Imagenes($bd);
        $daoImagenes->addImagen($imagen, $entrada);
        return $fichero_subido;
    }

}

?>