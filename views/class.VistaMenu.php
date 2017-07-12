<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 20:46
 */
class VistaMenu{
    private $usuario = null;
    //constructor se le pasa el modelo menu
    function __construct($usuario) {
        $this->usuario = $usuario;
    }

    public function muestraMenu(){
        echo "<!--En este caso he creado el menú principal como se especificaba-->
        <section class=\"menu-superior\">
            <section class=\"menu menu-principal centrar-filas\">
                <!-- Del mismo modo que en el index creo un checkbox que esta vez me va a servir como botón
                 del menú de hamburguesa cuando el usuario vea la página en un entorno reducido-->
                <input type=\"checkbox\" class=\"checkbox\" id=\"menu-toogle\"/>
                <label for=\"menu-toogle\" class=\"menu-toogle\"></label>
                <nav class=\"navigation\">
                    <ul>
                        <li class=\"menu-item\"><a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=bibliografia\" class=\"menu-link\" >Bibliografía</a></li>
                        <li class=\"menu-item\"><a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=fotos\" class=\"menu-link\" >Fotos</a></li>
                        <li class=\"menu-item\"><a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=informacion\" class=\"menu-link\" >Información</a></li>
                    </ul>
                </nav>
            </section>
        </section>
        <section class=\"content centrar-columnas\">";
    }
}

?>