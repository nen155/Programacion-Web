<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 12:29
 */
class Entrada{
    private $id;
    private $nombre;
    private $descripcion;
    private $fechaCreacion;
    private $idUsuario;

    /**
     * Entrada constructor.
     * @param $id
     * @param $nombre
     * @param $descripcion
     * @param $fechaCreacion
     * @param $idUsuario
     */
    public function __construct($id=null,$nombre=null, $descripcion=null, $fechaCreacion=null,$idUsuario=null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fechaCreacion = $fechaCreacion;
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return null
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param null $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return null
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param null $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return null
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param null $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return null
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param null $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }


}

?>