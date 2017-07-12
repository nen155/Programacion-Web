<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 10/05/2017
 * Time: 12:52
 */

class VistaComentarios{

    private $comentarios;
    public function __construct($comentarios=null)
    {
        $this->comentarios=$comentarios;
    }
    public function muestraComentarios(){
        echo "<ul class=\"lista-comentarios\">";
        foreach ($this->comentarios as $comentario) {
            echo "
                        <li>
                            <article class=\"comentario borde\">
                                <header>
                                    <a href=\"portada.php?usuario=" . $comentario[1]->getUsuario() . "&seccion=bibliografia\" class=\"nombre-usuario\">
                                        <h3>Posteado por: " . $comentario[1]->getUsuario() . "</h3>
                                    </a>
                                    <p><time pubdate=\"\" datetime=\"".$comentario[0]->getFechaCreacion()."\">".$comentario[0]->getFechaCreacion()."</time></p>
                                </header>
                                <a href=\"" . $comentario[1]->getUsuario() . "\">
                                    <img src=\"" . $comentario[1]->getImagen() . "\" name='".$comentario[1]->getId()."' class=\"img-usuario centrar\">
                                </a>
                                <p class=\"texto-articulo\">
                                   ".$comentario[0]->getDescripcion()."
                                </p>
                            </article>
                        </li>
                        ";
        }
        echo "
                </ul>
                </section>";
    }
    public function muestraPublicaComentario($usuario=null,$entrada=null){
        echo "<section class=\"comentar margen-seccion\">
                    <h2 class=\"titulo-secciones\">Comentarios</h2>
                    <form onsubmit=\"alert('Comentario enviado!')\" method='post' class=\"publicar-comentario borde\" action=\"portada.php?usuario=".$usuario->getUsuario()."&seccion=entrada_".$entrada->getId()."\" id=\"form-comentario\">
                        <header>
                            <a href=\"portada.php?usuario=".$usuario->getUsuario()."&seccion=bibliografia\" class=\"nombre-usuario\">
                                <h3>".$usuario->getUsuario()."</h3>
                            </a>
                            <p><time pubdate=\"\" datetime=\"".date("Y-m-d H:i:s")."\">".date("d/m/y")."</time></p>
                        </header>
                        <a href=\"portada.php?usuario=".$usuario->getUsuario()."&seccion=bibliografia\">
                            <img src=\"".$usuario->getImagen()."\" name='".$usuario->getId()."' class=\"img-usuario centrar\">
                        </a>
                        <input type='hidden' name='entrada' value=\"".$entrada->getId()."\">
                        <input type='hidden' name='fechacreacion' value=\"".date("Y-m-d H:i:s")."\">
                        <textarea onFocus=\"limpiarCo(this);\" onblur=\"return validarComentario(this);\" form=\"form-comentario\" class=\"texto-comentario\" name=\"comentario\" aria-label=\"Comentario\" aria-required=\"true\" placeholder=\"Escribe tu Comentario...\"></textarea>
                        <p id='errorCo'>Se ha excedido la longitud de caracteres máximo 250</p>
                        <input type=\"submit\" class=\"buttons buttons-comentarios\" value=\"Enviar\" name='comentar'>
                    </form>
                    ";
        if($this->comentarios==null || !isset($this->comentarios) || empty($this->comentarios))
            echo "</section>";
    }
}
?>