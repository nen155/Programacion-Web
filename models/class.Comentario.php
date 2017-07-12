<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 12:31
 */
class Comentario{
    private $id;
    private $descripcion;
    private $fechaCreacion;
    private $idEntrada;

    /**
     * Comentario constructor.
     * @param $id
     * @param $descripcion
     * @param $fechaCreacion
     * @param $idEntrada
     */
    public function __construct($id=null,$descripcion=null, $fechaCreacion=null,$idEntrada=null)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->fechaCreacion = $fechaCreacion;
        $this->idEntrada = $idEntrada;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param mixed $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return null
     */
    public function getIdEntrada()
    {
        return $this->idEntrada;
    }

    /**
     * @param null $idEntrada
     */
    public function setIdEntrada($idEntrada)
    {
        $this->idEntrada = $idEntrada;
    }



}
?>