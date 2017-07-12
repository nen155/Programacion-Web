<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 09/05/2017
 * Time: 13:53
 */

class VistaAmigos{
    private $amigos=null;

    public function __construct($amigos=null)
    {
        $this->amigos=$amigos;
    }

    public function muestraAmigos(){
        echo "<section class=\"cabecera-cuerpo\">
            <h2 class=\"titulo-secciones\">Amigos</h2>
            <section class=\"usuarios-amigos\">
                <!-- He usado una lista para los usuarios amigos porque es más fácil de gestionar y añadir nuevos elementos -->
                <ul class=\"lista-usuarios-amigos\">";
        foreach ($this->amigos as $amigo){
            echo "<li>
                                <section class=\"usuario borde\">
                                    <a href=\"portada.php?usuario=".$amigo->getUsuario()."&seccion=bibliografia\" class=\"nombre-usuario\">
                                        <h4>".$amigo->getUsuario()."</h4>
                                    </a>
                                    <a href=\"portada.php?usuario=".$amigo->getUsuario()."&seccion=bibliografia\">
                                        <img src=\"".$amigo->getImagen()."\" name='".$amigo->getId()."'  class=\"img-usuario centrar\"/>
                                    </a>
                                </section>
                        </li>";
        }
        echo " </ul>
            </section>
        </section>";
        //Muestro la cabecera del principal ya que siempre va debajo
        echo "<section class=\"cuerpo margen-seccion\">
            <section class=\"principal\">";
    }
}