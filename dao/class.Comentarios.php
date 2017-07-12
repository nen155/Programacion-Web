<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 12:37
 */

class Comentarios{
    private $bd;

    function __construct($bd){
        $this->bd=$bd;
    }

    /**
     * Obtiene todos los comentarios del sistema
     * @return array
     */
    function getComentarios(){
        $this->bd->setConsulta("select * from comentario");
        $comentario = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $comentario[$i] = new Comentario($fila["id"], $fila["descripcion"],$fila["fechacreacion"],$fila["idEntrada"],$fila["idUsuario"]);
            $i++;
        }
        return $comentario;
    }
    /**
     * Obtiene todos los comentarios con el nombre del usuario que la creó en un array
     * donde el indice 0 es el comentario y el 1 el usuario que lo creó
     * @return array
     */
    function getComentariosUsuarios(){
        $this->bd->setConsulta("select c.id,c.nombre,c.descripcion,c.fechacreacion,c.idEntrada,c.idUsuario,".
          "e.nombre,e.descripcion,e.fechacreacion,e.idUsuario as idUEntrada,u.usuario from ".
        "comentario as c INNER JOIN entrada as e ON c.idEntrada = e.id INNER JOIN usuario as u ON e.idUsuario = u.id");
        $comentario = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $comentario[$i] = array(new Comentario($fila["id"], $fila["descripcion"],$fila["fechacreacion"],$fila["idEntrada"]),$fila["usuario"]);
            $i++;
        }
        return $comentario;
    }

    /**
     * Obtiene todos los comentarios de un sólo usuario
     * @param $usuario
     * @return array
     */
    function getComentariosUsuario($usuario){
        $this->bd->setConsultaParametrizada("select c.id,c.nombre,c.descripcion,c.fechacreacion,c.idEntrada,c.idUsuario,".
          "e.nombre,e.descripcion,e.fechacreacion,e.idUsuario as idUEntrada from ".
        "comentario as c INNER JOIN entrada as e ON c.idEntrada = e.id INNER JOIN usuario as u ON e.idUsuario = u.id".
        "WHERE e.idUsuario =? ",array($usuario->getId()));
        $comentariosUsuario = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $comentariosUsuario[$i] = new Comentario($fila["id"], $fila["descripcion"],$fila["fechacreacion"],$fila["idEntrada"],$fila["idUsuario"]);
            $i++;
        }

        return $comentariosUsuario;
    }


    /**
     * Obtiene todos los comentarios de una entrada del sistema con y las devuelve en un
     * array donde el indice 0 es el comentario y el 1 es el usuario
     * @param $usuario
     * @return array
     */
    function getComentariosEntrada($entrada){
        $this->bd->setConsultaParametrizada("select c.id,c.descripcion,c.fechacreacion,u.usuario,u.imagen,c.idEntrada,c.idUsuario from".
        " comentario as c INNER JOIN usuario as u ON c.idUsuario = u.id ".
        "WHERE c.idEntrada=? ",array($entrada->getId()));
        $comentariosEntrada = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $usuario = new Usuario();
            $usuario->setId($fila["idUsuario"]);
            $usuario->setUsuario($fila["usuario"]);
            $usuario->setImagen($fila["imagen"]);
            $comentariosEntrada[$i] = array(new Comentario($fila["id"], $fila["descripcion"],$fila["fechacreacion"],$fila["idEntrada"],$fila["idUsuario"]),$usuario);
            $i++;
        }
        return $comentariosEntrada;
    }

    /**
     * Añade un comentario a la base de datos
     * @param $comentario
     * @param $entrada
     * @param $usuario
     */
    function addComentario($comentario, $entrada,$usuario){
        $descripcion=$comentario->getDescripcion();
        $fechaCreacion=$comentario->getFechaCreacion();
        $idEntrada=$entrada->getId();
        $idUsuario=$usuario->getId();

        $this->bd->setConsultaParametrizada("insert into `comentario` (`id`, `descripcion`, `fechacreacion`, `idEntrada`, `idUsuario`) 
        values (?,?,?,?,?) ",
            array(NULL,$descripcion,$fechaCreacion,$idEntrada,$idUsuario));
    }

}
?>