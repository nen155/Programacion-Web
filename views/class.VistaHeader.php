<?php

/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 20:48
 */
class VistaHeader
{
    private $usuario=null;
    public function __construct($usuario=null)
    {
        $this->usuario=$usuario;
    }

    public function muestraHeader(){
        if(isset($this->usuario)&& $this->usuario!=null){
        echo "<header id=\"cabecera\">
            <section class=\"header\" id=\"header1\">
                <a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=portada\">
                    <img src=\"img/logo.png\" id=\"logo\" />
                </a>
            </section>
            <section class=\"header\" id=\"header2\">
                <a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=portada\">
                    <h1 id=\"titulo\">MeetUS</h1>
                </a>
            </section>";
        echo "<!--El usuario que va a estar logueado durante toda la práctica va a ser Pepe -->
            <section class=\"header\" id=\"header3\">";

                echo "<section class=\"usuario borde\" id=\"usuario-logueado\">
                    <a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=bibliografia\" class=\"nombre-usuario\">
                        <h4>".$this->usuario->getUsuario()."</h4>
                    </a>
                    <a href=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=bibliografia\">
                        <img src=\"".$this->usuario->getImagen()."\" name='".$this->usuario->getId()."' class=\"img-usuario centrar\"/>
                    </a>
                    <form action=\"index.php\" method='post'>
                        <button id=\"logout\" type=\"submit\" class=\"buttons\" name='logout'>Salir</button>
                    </form>
                </section>";
        }else
        {
            echo "<header id=\"cabecera\">
            <section class=\"header\" id=\"header1\">
                <a href=\"index.php\">
                    <img src=\"img/logo.png\" id=\"logo\" />
                </a>
            </section>
            <section class=\"header\" id=\"header2\">
                <a href=\"index.php\">
                    <h1 id=\"titulo\">MeetUS</h1>
                </a>
            </section>";
            echo "<!--El usuario que va a estar logueado durante toda la práctica va a ser Pepe -->
            <section class=\"header\" id=\"header3\">";
            echo "<form action=\"index.php\" method=\"post\" id=\"form-login\">
            <section class=\"inputs-form\">
                <ul  class=\"fields-login\">
                    <li>
                        <input id=\"usuario\" onFocus=\"limpiarU(this);\" onblur=\"return validarUsuario(this);\" type=\"text\" name=\"usuario\" aria-label=\"Nombre de usuario\" aria-required=\"true\" placeholder=\"Nombre de usuario\"/>
                        <p id='errorUL'>El usuario introducido no es correcto</p>
                    </li>
                    <li>
                        <input id=\"password\" onFocus=\"limpiarP(this);\" onblur=\"return validarPassword(this);\" type=\"password\" name=\"password\" aria-label=\"Contraseña\" aria-required=\"true\" placeholder=\"Contraseña\"/>
                        <p id='errorPL'>El password introducido no es correcto</p>
                    </li>
                </ul>
            </section>
            <section class=\"buttons-form\">
                <input type=\"submit\" id=\"iniciar\" value=\"Entrar\" class=\"buttons\" name='login'/>
            </section>
            </form>
            </section>";
        }
        echo "</section></header>
        <!--El contenido principal de la página lo incluyo en la etiqueta main
         Lo divido en dos secciones la primera el contenido y la otra el footer-->
        <main class=\"index-content\">
          <!--El contenido tiene dos secciones principales la imágen que se redimensiona automáticamente y
            un formulario de registro que también es responsivo-->";
    }
}

?>