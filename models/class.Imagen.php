<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 12:33
 */
class Imagen{
    private $id;
    private $url;
    private $idEntrada;
    private $fechaCreacion;

    /**
     * Imagen constructor.
     * @param $id
     * @param $url
     * @param $idEntrada
     * @param $fechaCreacion
     */
    public function __construct($id=null, $url=null, $idEntrada=null, $fechaCreacion=null)
    {
        $this->id = $id;
        $this->url = $url;
        $this->idEntrada = $idEntrada;
        $this->fechaCreacion = $fechaCreacion;
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getIdEntrada()
    {
        return $this->idEntrada;
    }

    /**
     * @param mixed $idEntrada
     */
    public function setIdEntrada($idEntrada)
    {
        $this->idEntrada = $idEntrada;
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


}

?>