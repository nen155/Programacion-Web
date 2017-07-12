<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 12:37
 */

class Imagenes{
    private $bd;

    function __construct($bd){
        $this->bd=$bd;
    }

    /**
     * Obtiene todas las imagenes del sistema
     * @return array
     */
    function getImagenes(){
        $this->bd->setConsulta("select * from imagen");
        $imagen = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $imagen[$i] = new Imagen($fila["id"], $fila["url"],$fila["idEntrada"]);
            $i++;
        }
        return $imagen;
    }

    /**
     * Obtiene la imagenes de una entrada del sistema
     * @return array
     */
    function getImagenesEntrada($entrada){
        $this->bd->setConsultaParametrizada("select * from imagen WHERE idEntrada=?",array($entrada->getId()));
        $imagen = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $imagen[$i] = new Imagen($fila["id"], $fila["url"],$fila["idEntrada"]);
            $i++;
        }
        return $imagen;
    }
    /**
     * Obtiene todas las imagenes de un sólo usuario del sistema con y las devuelve en un
     * array donde el indice 0 es la entrada y el 1 es un array de fotos
     * @param $usuario
     * @return array
     */
    function getImagenesUsuario($usuario){
        $this->bd->setConsultaParametrizada("select i.id,i.url,i.idEntrada,e.fechacreacion from ".
        "imagen as i INNER JOIN entrada as e ON i.idEntrada = e.id  INNER JOIN usuario as u ON e.idUsuario = u.id ".
        " WHERE e.idUsuario=? ORDER BY e.fechacreacion DESC",array($usuario->getId()));
        $imagenesUsuario = array();
        $i=0;
        while ($fila = $this->bd->getFila()){
            $imagenesUsuario[$i] = new Imagen($fila["id"], $fila["url"],$fila["idEntrada"],$fila["fechacreacion"]);
            $i++;
        }

        return $imagenesUsuario;
    }

    /**
     * Añade una imagen a la base de datos
     * @param $imagen
     * @param $entrada
     */
    function addImagen($imagen, $entrada){
        $url=$imagen->getUrl();
        $idEntrada=$entrada->getId();

        $this->bd->setConsultaParametrizada("insert into `imagen` (`id`, `url`, `idEntrada`) 
        values (?,?,?) ",
            array(NULL,$url,$idEntrada));
    }

}
?>