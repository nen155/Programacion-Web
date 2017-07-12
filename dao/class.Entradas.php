<?php

/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 12:37
 */
class Entradas
{
    private $bd;

    function __construct($bd)
    {
        $this->bd = $bd;
    }

    /**
     * Obtiene todos las entradas del sistema
     * @return array
     */
    function getEntradas()
    {
        $this->bd->setConsulta("SELECT * FROM entrada ORDER BY fechacreacion DESC");
        $entradas = array();
        $i = 0;
        while ($fila = $this->bd->getFila()) {
            $entradas[$i] = new Entrada($fila["id"], $fila["nombre"], $fila["descripcion"], $fila["fechacreacion"], $fila["idUsuario"]);
            $i++;
        }
        return $entradas;
    }

    /**
     * Obtiene todos las entradas con el nombre del usuario que la creó del sistema
     * y las devuelve en un array donde el indice 0 es la entrada y el 1 es el usuario
     * @return array
     */
    function getEntradasUsuarios()
    {
        $this->bd->setConsulta("SELECT e.id,e.nombre,e.descripcion,e.fechacreacion,u.usuario,e.idUsuario FROM entrada as e INNER JOIN usuario as u ON e.idUsuario = u.id ORDER BY e.fechacreacion DESC");
        $entradas = array();
        $i = 0;
        while ($fila = $this->bd->getFila()) {
            $entradas[$i] = array(new Entrada($fila["id"], $fila["nombre"], $fila["descripcion"], $fila["fechacreacion"], $fila["idUsuario"]), $fila["usuario"]);
            $i++;
        }
        return $entradas;
    }

    /**
     * Obtiene todos las entradas con el nombre del usuario que la creó del sistema
     * y las devuelve en un array donde el indice 0 es la entrada y el 1 es un array
     * con el usuario con su imagen
     * @return array
     */
    function getEntradasAmigos($usuario)
    {
        $this->bd->setConsultaParametrizada("SELECT e.id,e.nombre,e.descripcion,e.fechacreacion,e.idUsuario,u.usuario,u.imagen FROM entrada as e INNER JOIN usuario as u ON e.idUsuario=u.id INNER JOIN amigo as a ON u.id=a.idUsuarioB OR u.id=a.idUsuarioA WHERE a.idUsuarioB=? OR a.idUsuarioA=? ORDER BY e.fechacreacion DESC", array($usuario->getId(),$usuario->getId()));
        $entradas = array();
        $i = 0;
        while ($fila = $this->bd->getFila()) {
            $usuario = new Usuario();
            $usuario->setUsuario($fila["usuario"]);
            $usuario->setImagen($fila["imagen"]);
            $entradas[$i] = array(new Entrada($fila["id"], $fila["nombre"], $fila["descripcion"], $fila["fechacreacion"], $fila["idUsuario"]), $usuario);
            $i++;
        }
        return $entradas;
    }

    /**
     * Obtiene los datos del ID de la entrada  y los devuelve en un
     * array donde el indice 0 es la entrada y el 1 es un array de fotos
     * @param $entrada
     * @return array
     */
    function getEntrada($entrada)
    {
        $this->bd->setConsultaParametrizada("SELECT e.id,e.nombre,e.descripcion,e.fechacreacion,e.idUsuario,u.usuario,u.imagen FROM entrada as e INNER JOIN usuario as u ON e.idUsuario=u.id WHERE e.id=?", array($entrada->getId()));
        $fila = $this->bd->getFila();
        //Subconsulta
        $this->bd->setConsultaParametrizada("SELECT id,url,idEntrada FROM imagen WHERE idEntrada=?", array($fila["id"]));
        $fotos = array();
        $j = 0;
        while ($fila2 = $this->bd->getFila()) {
            $fotos[$j] = new Imagen($fila2["id"], $fila2["url"], $fila2["idEntrada"]);
            $j++;
        }
        $usuario = new Usuario();
        $usuario->setUsuario($fila["usuario"]);
        $usuario->setImagen($fila["imagen"]);
        $entrada = array(new Entrada($fila["id"], $fila["nombre"], $fila["descripcion"], $fila["fechacreacion"], $fila["idUsuario"]),$usuario, $fotos);
        return $entrada;
    }

    /**
     * Obtiene todos las entradas de un sólo usuario del sistema
     * @param $usuario
     * @return array
     */
    function getEntradasUsuario($usuario)
    {
        $this->bd->setConsultaParametrizada("SELECT id,nombre,descripcion,fechacreacion,idUsuario FROM entrada WHERE idUsuario=? ORDER BY fechacreacion DESC ", array($usuario->getId()));
        $entradasUsuario = array();
        $i = 0;
        while ($fila = $this->bd->getFila()) {
            $entradasUsuario[$i] = array(new Entrada($fila["id"], $fila["nombre"], $fila["descripcion"], $fila["fechacreacion"], $fila["idUsuario"]));
            $i++;
        }

        return $entradasUsuario;
    }
    /**
     * Obtiene todos las entradas de un sólo usuario del sistema con y las devuelve en un
     * array donde el indice 0 es la entrada y el 1 es un array de fotos
     * @param $usuario
     * @return array
     */
    function getEntradasImgsUsuario($usuario)
    {
        $this->bd->setConsultaParametrizada("SELECT id,nombre,descripcion,fechacreacion FROM entrada WHERE idUsuario =? ORDER BY fechacreacion DESC", array($usuario->getId()));
        $entradasUsuario = array();
        $i = 0;
        while ($fila = $this->bd->getFila()) {
            //Subconsulta
            $this->bd->setSubConsultaParametrizada("SELECT id,url,idEntrada FROM imagen WHERE idEntrada=? ", array($fila["id"]));
            $fotos = array();
            $j = 0;
            while ($fila2 = $this->bd->getFila()) {
                $fotos[$j] = new Imagen($fila2["id"], $fila2["url"], $fila2["idEntrada"]);
                $j++;
            }
            $entradasUsuario[$i] = array(new Entrada($fila["id"], $fila["nombre"], $fila["descripcion"], $fila["fechacreacion"], $fila["idUsuario"]), $fotos);
            $i++;
        }

        return $entradasUsuario;
    }

    /**
     * Añade una entrada al sistema
     * @param $entrada
     * @param $usuario
     */
    function addEntrada($entrada, $usuario)
    {
        $nombre = $entrada->getNombre();
        $descripcion = $entrada->getDescripcion();
        $fechaCreacion = $entrada->getFechaCreacion();
        $idUsuario = $usuario->getId();

        $this->bd->setConsultaParametrizada("insert into `entrada` (`id`, `nombre`, `descripcion`, `fechacreacion`, `idUsuario`) 
        values (?,?,?,?,?) ",
            array(NULL, $nombre, $descripcion, $fechaCreacion, $idUsuario));
    }

}

?>