<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 09/05/2017
 * Time: 18:46
 */

class VistaActivos{

    private $activos;

    public function __construct($activos=null)
    {
        $this->activos=$activos;
    }

    public function muestraActivos(){
        echo "
            <!--Cierre del principal-->
            </section>
           <!-- Cuando se reduce el viewport se aumenta el porcentaje de pantalla que ocupará esta sección para que quepan bien los usuarios en línea
            por lo que siempre la encontraremos en el lateral -->
            <aside class=\"usuarios-activos\">
                <h2 class=\"titulo-secciones\">En línea</h2>
                <ul class=\"lista-usuarios-activos\">";
        foreach ($this->activos as $activo){
            echo "
                    <li class=\"item-activo\">
                        <section class=\"usuario-activo borde\">
                            <a href=\"portada.php?usuario=".$activo->getUsuario()."&seccion=bibliografia\" class=\"link-img-activo\">
                                <img src=\"".$activo->getImagen()."\" name='".$activo->getId()."' class=\"img-usuario-activo centrar\"/>
                            </a>
                            <a href=\"portada.php?usuario=".$activo->getUsuario()."&seccion=bibliografia\" class=\"link-activo\">
                                <h4>".$activo->getUsuario()."</h4>
                            </a>
                        </section>
                    </li>";
        }


        echo "                </ul>
            
            </aside>
            <!--Cierre del Cuerpo-->
             </section>";
    }
}