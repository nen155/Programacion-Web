<?php

class BaseDatos
{
    private $pdo;
    private $resultado;
    private $resultado2;

    function setPdo($servidor, $usuario, $pass, $baseDatos)
    {
        try {
            $this->pdo = new PDO("mysql:host=$servidor;dbname=$baseDatos;charset=utf8", $usuario, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo $e;
        }
    }

    function closeConexion()
    {
        $this->pdo = null;
    }

    function setConsulta($consulta)
    {
        try {
            $this->resultado = $this->pdo->query($consulta);
            if ($this->resultado)
                return true;
        } catch (PDOException $e) {
            echo $e;
        }
        return false;
    }

    function setConsultaParametrizada($consulta, $parametros)
    {
        try {
            $this->resultado = $this->pdo->prepare($consulta);
            $this->resultado->execute($parametros);
            if ($this->resultado)
                return true;
        } catch (PDOException $e) {
            echo $e;
        }
        return false;
    }

    function setSubConsultaParametrizada($consulta, $parametros)
    {
        try {
            $this->resultado2 = $this->pdo->prepare($consulta);
            $this->resultado2->execute($parametros);
            if ($this->resultado2)
                return true;
        } catch (PDOException $e) {
            echo $e;
        }
        return false;
    }

    function setSubConsulta($consulta)
    {
        try {
            $this->resultado2 = $this->pdo->query($consulta);
            if ($this->resultado2)
                return true;
        } catch (PDOException $e) {
            echo $e;
        }
        return false;
    }

    function getNumFilas()
    {
        try {
            $res = $this->resultado->rowCount();
            if ($res)
                return $res;
        } catch (PDOException $e) {
            echo $e;
        }
        return false;
    }

    function getFila()
    {
        try {
            $res = $this->resultado->fetch();
            if ($res)
                return $res;
        } catch (PDOException $e) {
            echo $e;
        }
        return false;
    }

    function getSubNumFilas()
    {
        try {
            $res = $this->resultado2->rowCount();
            if ($res)
                return $res;
        } catch (PDOException $e) {
            echo $e;
        }
        return false;
    }

    function getSubFila()
    {
        try {
            $res = $this->resultado2->fetch();
            if ($res)
                return $res;
        } catch (PDOException $e) {
            echo $e;
        }
        return false;
    }
    function getLastId(){
        try{
            return $this->pdo->lastInsertId();
        }catch (PDOException $e){
            echo $e;
        }
    }
}

?>