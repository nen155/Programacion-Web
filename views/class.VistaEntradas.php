<?php

/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 09/05/2017
 * Time: 14:06
 */
class VistaEntradas
{
    private $entradas = null;
    private $seccion = null;
    private $usuario = null;
    private $pag = 1;
    private $numeroPaginas=1;
    private $numeroEntradas=0;
    private $limiteInferior=0;

    public function __construct($entradas = null,$seccion=null,$pag=1)
    {
        $this->entradas = $entradas;
        $this->seccion = $seccion;
        $this->pag=$pag;
        //A 6 entradas por página
        if(count($this->entradas)>=6) {
            $this->numeroPaginas = ceil(count($this->entradas) / 6);
        }
        //Calculo el límite inferior en la paginación
        $this->limiteInferior=(($this->pag-1)*6);
        //Calculo el límite superior en la paginación
        if(count($this->entradas)<6 || (count($this->entradas)-$this->limiteInferior)<6)
            $this->numeroEntradas=count($this->entradas);
        else
            $this->numeroEntradas=$this->limiteInferior+6;

    }

    /**
     * Muestra la seccion de la cabecera
     */
    private function cabeceraEntradas(){
        echo "<section class=\"publicaciones\">
                <h2 class=\"titulo-secciones\">Muro</h2>
                <ul class=\"lista-publicaciones\">";
    }

    /**
     * Muestra una entrada concreta
     * @param $entradaCompleta
     */
    public function muestraEntrada($entradaCompleta){
        $entrada = $entradaCompleta[0];
        $this->usuario = $entradaCompleta[1];
        $imagen = $entradaCompleta[2];
        echo "<section class=\"entrada\">
                    <h2 class=\"titulo-secciones\">Entrada</h2>
                    <article class=\"publicacion-full borde\">
                        <header>
                            <a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=portada\" class=\"nombre-usuario\">
                                <h3>Posteado por: ".$this->usuario->getUsuario()."</h3>
                            </a>
                            <p><time pubdate=\"\" datetime=\"".$entrada->getFechaCreacion()."\">".$entrada->getFechaCreacion()."</time></p>
                        </header>
                        <a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=portada\">
                            <img src=\"".$this->usuario->getImagen()."\" name='".$entrada->getIdUsuario()."' class=\"img-usuario centrar\">
                        </a>
                        <h3 class=\"titulo-articulo\">
                            ".$entrada->getNombre()."
                        </h3>
                        <p class=\"texto-articulo\">
                            ".$entrada->getDescripcion()."
                        </p>";
                        if($imagen!=null && !empty($imagen) && isset($imagen[0]))
                        echo "<img src=\"".$imagen[0]->getUrl()."\" class=\"img-articulo\">";
                    echo "</article>
                </section>";
    }

    /**
     * Muestra las entradas de los amigos del usuario
     * @param null $usuario
     */
    public function muestraEntradasAmigos($usuario=null)
    {
        $this->usuario = $usuario;
       $this->cabeceraEntradas();


        for($i=$this->limiteInferior;$i<$this->numeroEntradas;$i++){
            $entrada = $this->entradas[$i];
            echo "<li>
                        <article class=\"publicacion borde\">
                            <header>
                                <a href=\"portada.php?usuario=".$entrada[1]->getUsuario()."&seccion=entrada_".$entrada[0]->getId()."\" class=\"nombre-usuario\">
                                    <h3>Posteado por: ".$entrada[1]->getUsuario()."</h3>
                                </a>
                                <!--Utilizo etiquetas semáticas como time para especificar la hora de publicacion, pubudate para especificar que es una actualización
                                y datetime para especificar la hora de la acutalización-->
                                <p><time pubdate datetime=\"".$entrada[0]->getFechaCreacion()."\">".$entrada[0]->getFechaCreacion()."</time></p>
                            </header>
                            <a href=\"portada.php?usuario=".$entrada[1]->getUsuario()."&seccion=entrada_".$entrada[0]->getId()."\">
                                <img src=\"".$entrada[1]->getImagen()."\" name='".$entrada[0]->getIdUsuario()."' class=\"img-usuario centrar\"/>
                            </a>
                            <h3 class=\"titulo-articulo\">
                                ".$entrada[0]->getNombre()."
                            </h3>
                            <p class=\"texto-articulo\">
                                ".$entrada[0]->getDescripcion()."
                            </p>
                        </article>
                    </li>";
        }
        echo "</ul>";
        if($this->numeroPaginas>1)
            $this->paginacion($this->usuario->getUsuario());
        else//Fin de publicaciones
            echo "</section>";
    }

    /**
     * Muestra las entradas de un usuario
     * @param null $usuario
     */
    public function muestraEntradasUsuario($usuario=null)
    {
        $this->usuario = $usuario;
        $this->cabeceraEntradas();

        for($i=$this->limiteInferior;$i<$this->numeroEntradas;$i++){
            $entrada = $this->entradas[$i];
            echo "<li>
                        <article class=\"publicacion borde\">
                            <header>
                                <a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=entrada_".$entrada[0]->getId()."\" class=\"nombre-usuario\">
                                    <h3>Posteado por: ".$this->usuario->getUsuario()."</h3>
                                </a>
                                <!--Utilizo etiquetas semáticas como time para especificar la hora de publicacion, pubudate para especificar que es una actualización
                                y datetime para especificar la hora de la acutalización-->
                                <p><time pubdate datetime=\"".$entrada[0]->getFechaCreacion()."\">".$entrada[0]->getFechaCreacion()."</time></p>
                            </header>
                            <a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=entrada_".$entrada[0]->getId()."\">
                                <img src=\"".$this->usuario->getImagen()."\" name='".$this->usuario->getId()."' class=\"img-usuario centrar\"/>
                            </a>
                            <h3 class=\"titulo-articulo\">
                                ".$entrada[0]->getNombre()."
                            </h3>
                            <p class=\"texto-articulo\">
                                ".$entrada[0]->getDescripcion()."
                            </p>
                        </article>
                    </li>";
        }
        echo "</ul>";
        if($this->numeroPaginas>1) {
            $this->paginacion($this->usuario->getUsuario());
        }
        else//Fin de publicaciones
            echo "</section>";
    }

    /**
     * Muestra las imagenes de un usuario
     * @param $usuario
     * @param $imagenes
     */
    public function muestraImagenes($usuario,$imagenes){
        //A 6 entradas por página
        $this->numeroPaginas = ceil(count($imagenes) / 6);

        //Calculo el límite inferior en la paginación
        $this->limiteInferior=(($this->pag-1)*6);
        //Calculo el límite superior en la paginación
        if(count($imagenes)<6 || (count($imagenes) - $this->limiteInferior)<6)
            $this->numeroEntradas=count($imagenes);
        else
            $this->numeroEntradas=$this->limiteInferior+6;


        echo "<section class=\"publicaciones\">
                <h2 class=\"titulo-secciones\">Fotos</h2>
                <ul class=\"lista-publicaciones\">";
        for($i=$this->limiteInferior;$i<$this->numeroEntradas;$i++){
            $imagen = $imagenes[$i];
            echo "<li>
                        <article class=\"publicacion borde\">
                            <header>
                                <a href=\"portada.php?usuario=" . $usuario->getUsuario() . "&seccion=entrada_" . $imagen->getIdEntrada() . "\" class=\"nombre-usuario\">
                                    <h3>Posteado por: " . $usuario->getUsuario() . "</h3>
                                </a>
                                <p><time pubdate=\"\" datetime=\"".$imagen->getFechaCreacion()."\">".$imagen->getFechaCreacion()."</time></p>
                            </header>
                            <a href=\"portada.php?usuario=" . $usuario->getUsuario() . "&seccion=entrada_" . $imagen->getIdEntrada() . " \">
                                <img src=\"".$imagen->getUrl()."\" name='".$usuario->getId()."' class=\"img-usuario centrar\">
                            </a>
                        </article>
                    </li>";
        }
               echo "</ul>";

        if($this->numeroPaginas>1) {
            $this->paginacion($usuario->getUsuario());
        }
        else//Fin de publicaciones
            echo "</section>";
    }

    /**
     * Paginación de elementos
     * @param $usuario
     */
    public function paginacion($usuario){
        echo  "<!-- Creo un paginador numerado para ir moviendome entre publicaciones, cuando haya poco espacio los elementos item-pagination se ocultarán -->
                <section class=\"center clear\">
                    <section class=\"pagination\">";

        //Retrocedo
        if($this->pag>1)
            $menos=--$this->pag;
        else
            $menos=-$this->pag;
        //Avanzo
        if($this->pag<$this->numeroPaginas)
            $mas=++$this->pag;
        else
            $mas=-$this->pag;

        echo "<a href=\"portada.php?usuario=".$usuario ."&seccion=".$this->seccion."&pag=".$menos."\">&laquo;</a>";

        for($i=0; $i<$this->numeroPaginas; ++$i){
            echo " <a href=\"portada.php?usuario=".$usuario ."&seccion=".$this->seccion."&pag=".($i+1)."\">". ($i+1) . "</a>";
        }

        echo "<a href=\"portada.php?usuario=".$usuario ."&seccion=".$this->seccion."&pag=".$mas."\">&raquo;</a>";
        echo "</section>
                </section>";
       //Fin de publicaciones
        echo "</section>";
    }

}