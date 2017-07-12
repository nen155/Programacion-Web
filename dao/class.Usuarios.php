<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 12:37
 */

class Usuarios{
    private $bd;

    function __construct($bd){
        $this->bd=$bd;
    }

    /**
     * Obtiene todos los usuarios del sistema
     * @return array
     */
    function getUsuarios(){
        $this->bd->setConsulta("SELECT id,nombre,apellidos,email,telefono,usuario,fechanacimiento,imagen,enlinea FROM usuario");
        $usuarios = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $usuarios[$i] = new Usuario($fila["id"],$fila["nombre"], $fila["apellidos"],$fila["email"], $fila["telefono"], $fila["usuario"],null, $fila["fechaNacimiento"], $fila["imagen"], $fila["enlinea"]);
            $i++;
        }
        return $usuarios;
    }

    /**
     * Obtiene los usuarios activos que son amigos del usuario logueado
     * @param $usuario
     * @return array
     */
    function getUsuariosActivos($usuario){

        $this->bd->setConsultaParametrizada("SELECT u.id,u.usuario,imagen FROM usuario as u INNER JOIN amigo as a ON u.id=a.idUsuarioB WHERE u.enlinea=1 AND u.id!=a.idUsuarioA AND a.idUsuarioA=? GROUP BY u.nombre",array($usuario->getId()));
        $usuarios = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $usuarios[$i] = new Usuario();
            $usuarios[$i]->setId($fila["id"]);
            $usuarios[$i]->setUsuario($fila["usuario"]);
            $usuarios[$i]->setImagen($fila["imagen"]);
            $i++;
        }
        return $usuarios;
    }

    /**
     * Obtiene el usuario que ha hecho login en el sistema
     * @param $usuario
     * @return array
     */
    function getUsuarioLogueado($usuario,$password){
        $this->bd->setConsultaParametrizada("SELECT id,nombre,apellidos,email,telefono,usuario,fechanacimiento,imagen FROM usuario WHERE usuario.usuario=? AND usuario.password=?",array($usuario->getUsuario(),$password));
        $fila = $this->bd->getFila();
        $user = new Usuario($fila["id"],$fila["nombre"], $fila["apellidos"],$fila["email"], $fila["telefono"], $fila["usuario"],null, $fila["fechanacimiento"], $fila["imagen"], 1);
        return $user;
    }

    /**
     * Obtiene el usuario que ha hecho login en el sistema
     * @param $usuario
     * @return Usuario
     */
    function getUsuario($usuario){
        $this->bd->setConsultaParametrizada("SELECT id,nombre,apellidos,email,telefono,u.usuario,fechanacimiento,imagen,enlinea FROM usuario as u WHERE u.usuario=?",array($usuario));
        $fila = $this->bd->getFila();
        $user = new Usuario($fila["id"],$fila["nombre"], $fila["apellidos"],$fila["email"], $fila["telefono"], $fila["usuario"],null, $fila["fechanacimiento"], $fila["imagen"], $fila["enlinea"]);
        return $user;
    }

    /**
     * Obtiene los amigos del usuario logueado
     * @param $usuario
     * @return array
     */
    function getAmigos($usuario){
        $this->bd->setConsultaParametrizada("SELECT u.id,u.usuario,u.imagen FROM usuario as u INNER JOIN amigo as a ON u.id=a.idUsuarioB OR u.id=a.idUsuarioA WHERE u.id!=? AND (a.idUsuarioB=? OR a.idUsuarioA=?) GROUP BY u.nombre",array($usuario->getId(),$usuario->getId(),$usuario->getId()));
        $usuarios = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $usuarios[$i] = new Usuario();
            $usuarios[$i]->setId($fila["id"]);
            $usuarios[$i]->setUsuario($fila["usuario"]);
            $usuarios[$i]->setImagen($fila["imagen"]);
            $i++;
        }
        return $usuarios;
    }

    /**
     * Comprueba las credenciales de un usuario
     * @param $usuario
     * @return mixed
     */
    function compruebaCredenciales($usuario){
        $this->bd->setConsultaParametrizada("SELECT u.id,u.usuario,u.imagen FROM usuario as u WHERE u.usuario=? AND u.password=?",array($usuario->getUsuario(),sha1($usuario->getPassword())));
        return $this->bd->getFila();
    }

    function editaUsuario($usuario){
        $nombre=$usuario->getNombre();
        $apellidos=$usuario->getApellidos();
        $email=$usuario->getEmail();
        $user=$usuario->getUsuario();
        $password=$usuario->getPassword();
        $fechaNacimiento=$usuario->getFechaNacimiento();
        $imagen=$usuario->getImagen();
        $telefono=$usuario->getTelefono();
        $id = $usuario->getId();
        if($password!=null && isset($password) && !empty($password))
            if($imagen!=null)
                $this->bd->setConsultaParametrizada("UPDATE `usuario` SET `nombre`=?,`apellidos`=?,`email`=?,`telefono`=?,`usuario`=?,`password`=?,`fechanacimiento`=?,`imagen`=? WHERE id=?",
                array($nombre,$apellidos,$email,$telefono,$user,sha1($password),$fechaNacimiento,$imagen,$id));
            else
                $this->bd->setConsultaParametrizada("UPDATE `usuario` SET `nombre`=?,`apellidos`=?,`email`=?,`telefono`=?,`usuario`=?,`password`=?,`fechanacimiento`=? WHERE id=?",
                    array($nombre,$apellidos,$email,$telefono,$user,sha1($password),$fechaNacimiento,$id));
        else
            if($imagen!=null)
                $this->bd->setConsultaParametrizada("UPDATE `usuario` SET `nombre`=?,`apellidos`=?,`email`=?,`telefono`=?,`usuario`=?,`fechanacimiento`=?,`imagen`=? WHERE id=?",
                    array($nombre,$apellidos,$email,$telefono,$user,$fechaNacimiento,$imagen,$id));
            else
                $this->bd->setConsultaParametrizada("UPDATE `usuario` SET `nombre`=?,`apellidos`=?,`email`=?,`telefono`=?,`usuario`=?,`fechanacimiento`=? WHERE id=?",
                    array($nombre,$apellidos,$email,$telefono,$user,$fechaNacimiento,$id));
    }
    /**
     * Añade el usuario pasado por parámetro a la base de datos
     * @param $usuario
     */
    function addUsuario($usuario){
        $nombre=$usuario->getNombre();
        $apellidos=$usuario->getApellidos();
        $email=$usuario->getEmail();
        $user=$usuario->getUsuario();
        $password=$usuario->getPassword();
        $fechaNacimiento=$usuario->getFechaNacimiento();
        $imagen=$usuario->getImagen();
        $telefono=$usuario->getTelefono();
        $enlinea=$usuario->getEnlinea();
        $this->bd->setConsultaParametrizada("INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `email`, `telefono`, `usuario`, `password`, `fechanacimiento`, `imagen`,`enlinea`) 
        values (?,?,?,?,?,?,?,?,?,?)",
            array(NULL,$nombre,$apellidos,$email,$telefono,$user,sha1($password),$fechaNacimiento,$imagen,$enlinea));
    }

}
?>