<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 10/05/2017
 * Time: 23:31
 */
//Cargo los modelos y las vistas
//Cargo los modelos y las vistas
function __autoload($class){
    if(file_exists('../models/class.'.$class.'.php'))
        include_once '../models/class.'.$class.'.php';
    if(file_exists('../dao/class.'.$class.'.php'))
        include_once '../dao/class.'.$class.'.php';
}
$id=$_GET["id"];
//Me creo el objeto de BD
$bd = new BaseDatos();
//Utilizo este método por parámetros porque así la programación
//es más parametrizada por lo que podría conectarme a otras BD
// en un mismo archivo PHP
$bd->setPdo(Constantes::$servidor, Constantes::$usuario, Constantes::$clave,Constantes::$basedatos);
$usuario=new Usuario($id);
$daoEntradas = new Entradas($bd);
$entradas = $daoEntradas->getEntradasUsuario($usuario);
$resultado='{"ent":[';
$i=0;
foreach ($entradas as $entrada){
    $resultado.='{"entrada":"'.$entrada[0]->getNombre().'"}';
    if($i!=count($entradas)-1)
        $resultado.=',';
    $i++;
}
$resultado.=']}';
echo $resultado;
?>