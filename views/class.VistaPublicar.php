<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 10/05/2017
 * Time: 9:55
 */
class VistaPublicar{

    private $usuario=null;

    public function __construct($usuario=null)
    {
        $this->usuario=$usuario;
    }

    public function muestraPublicar(){
        echo "<section class=\"publicar\">
                    <h2 class=\"titulo-secciones\">Publicar</h2>
                    <!-- Ahora podemos publicar un estado o cualquier cosa que se nos ocurra con el siguiente formulario -->
                    <form onsubmit=\"alert('Entrada enviada!')\" method='post' enctype=\"multipart/form-data\" class=\"publica borde\" action=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=bibliografia\" id=\"form-publicar\">
                        <header>
                            <a href=\"".$this->usuario->getUsuario()."\" class=\"nombre-usuario\">
                                <h3>".$this->usuario->getUsuario()."</h3>
                            </a>
                            <!-- Esta sería la hora actual de la publicación -->
                            <p><time pubdate=\"\" datetime=\"".date("Y-m-d H:i:s")."\">".date("d/m/y")."</time></p>
                        </header>
                        <a href=\"".$this->usuario->getUsuario()."\">
                            <img src=\"".$this->usuario->getImagen()."\" name='".$this->usuario->getId()."'  class=\"img-usuario centrar\">
                        </a>
                        <input type='hidden' name='fechacreacion' value=\"".date("Y-m-d H:i:s")."\">
                        <input type=\"text\" name=\"titulo-publicar\" aria-label=\"publicar\" aria-required=\"true\" placeholder=\"Título a lo que pienses...\">
                        <textarea form=\"form-publicar\" class=\"texto-publicar\" name=\"texto-publicar\" aria-label=\"publicar\" aria-required=\"true\" placeholder=\"Escribe lo que pienses...\"></textarea>
                        <input type=\"submit\" class=\"buttons buttons-publicar\" value=\"Enviar\" name='publicar'>
                         <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"40000000\" />
                        <!-- El nombre del elemento de entrada determina el nombre en el array FILES -->
                        <input id=\"img-publicar\" type=\"file\" class=\"buttons buttons-publicar\" name='imagen' value=\"Subir Imagen\">
                    </form>
                </section>";
    }

}
?>