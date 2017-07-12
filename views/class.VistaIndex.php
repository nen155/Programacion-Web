<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 08/05/2017
 * Time: 10:53
 */
class VistaIndex{

    private $seccion;
    public function __construct($seccion)
    {
        $this->seccion = $seccion;
    }

    public function muestraIndex(){
        echo "<!--El contenido tiene dos secciones principales la imágen que se redimensiona automáticamente y
     un formulario de registro que también es responsivo-->
    <section class=\"content centrar-filas\">
        <section class=\"index\" id=\"index1\">
            <img src=\"img/portada.png\" id=\"img-index\" />
        </section>
        <section class=\"index\" id=\"index2\">";

        if(isset($this->seccion) &&$this->seccion!=null)
        {
            $this->muestraInfoContacto();
        }else
            $this->muestraSingUP();

    }

    private function muestraSingUP(){
        echo "<!--Este input de tipo checkbox que está aislado, lo uso para hacer aparecer el Contacto
             y como para llamarlo con CSS necesito que sea hermano de #info-contacto es por ello que se encuentra aquí -->
            <input type=\"checkbox\" id=\"contacto-label\" name=\"group\">
            <section id=\"singup\">
                <header id=\"cabecera-singup\">
                    <h1>Regístrate</h1>
                </header>
                <!--El formulario lo divido en dos secciones una para los inputs y otra para los botones -->
                <form action=\"index.php\" method=\"post\" id=\"form-singup\" onsubmit=\"return validar();\">
                    <section class=\"inputs-form\">
                        <ul class=\"fields-singup\">
                            <li>
                                <input id=\"correo\" onFocus=\"limpiarC();\" onblur=\"return validarCorreo();\"  type=\"email\" name=\"correo\" class=\"input-singup\" aria-label=\"Correo electrónico\" aria-required=\"true\" placeholder=\"Correo electrónico\" pattern=\"[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$\" required/>
                                <p id='errorC'>El correo no esta bien escrito</p>
                            </li>
                            <li>
                                <input id=\"nombre\" onFocus=\"limpiarN();\"  onblur=\"return validarNombre();\" type=\"text\" name=\"nombre\" class=\"input-singup\" aria-label=\"Nombre completo\" aria-required=\"true\" placeholder=\"Nombre completo\" pattern='[A-Za-zÑñáéíóúÁÉÍÓÚ\s]+$' required/>
                                <p id='errorN'>El nombre tiene caracteres erróneos</p>
                            </li>
                             <li>
                                <input id=\"telefono\" onFocus=\"limpiarT();\" onblur=\"return validarTelefono();\" type=\"text\" name=\"telefono\" class=\"input-singup\" aria-label=\"Telefono\" aria-required=\"true\" pattern='((\+?34([ \t|\-])?)?[9|6|7|8]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$' placeholder=\"Telefono\"/>
                                <p id='errorT'>El telefono no es correcto</p>
                            </li>
                            <li>
                                <input id=\"nombreusuario\" onFocus=\"limpiarU(this);\" onblur=\"return validarUsuario(this);\" type=\"text\" name=\"usuario\" class=\"input-singup\" aria-label=\"Nombre de usuario\" aria-required=\"true\" placeholder=\"Nombre de usuario\" pattern='(([0-9a-zA-Z]+)[\.-_]?([0-9a-zA-Z]+))+$'  required/>
                                <p id='errorU'>El usuario tiene caracteres erróneos</p>
                            </li>
                            <li>
                                <input id=\"password-singup\" onFocus=\"limpiarP(this);\" onblur=\"return validarPassword(this);\"  type=\"password\" name=\"password\" class=\"input-singup\" aria-label=\"Contraseña\" aria-required=\"true\" placeholder=\"Contraseña de 6 caracteres minimo\" pattern='(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){6,15}$' required/>
                                <p id='errorP'>Tiene que contener mayúsculas y minúsculas y algún caracter especial</p>
                            </li>
                            <li>
                                <input id=\"re-password-singup\" onFocus=\"limpiarRP(this);\" onblur=\"return validarREPassword(this);\"  type=\"password\" name=\"repassword\" class=\"input-singup\" aria-label=\"Repita la Contraseña\" aria-required=\"true\" placeholder=\"Repita la Contraseña\" pattern='(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){6,15}$' required/>
                                <p id='errorRP'>No coincide con el password</p>
                            </li>
                            <li>
                                <label for=\"fecna\" id=\"label-fecna\">Fecha de nacimiento</label>
                                <input id=\"fecna\" type=\"date\" name=\"fecna\" class=\"input-singup\" aria-label=\"Fecha nacimiento\" aria-required=\"true\" title=\"Fecha nacimiento\" required/>
                            </li>
                        </ul>
                    </section>
                    <section class=\"buttons-form\">
                        <input type=\"submit\" id=\"enviar\" value=\"Registrarme\" class=\"buttons\" name='registro' onclick='enviar();'/>
                        <!--Cuando la página se hace lo suficientemente pequeña para le dispositivo oculto
                         con css la sección de login (SÓLO EN EL INDEX) y muestro un botoón de Entrar -->
                        <section class=\"entrar-oculta\">
                            <p style=\"text-align: center;\">------------ Ó ------------</p>
                            <input type=\"submit\" id=\"entrar\" value=\"Entrar\" class=\"buttons\"/>
                        </section>
                    </section>
                </form>
                <footer class=\"footer-form\">
                    <p>
                        Al registrarte, aceptas nuestras Condiciones y nuestra Política de privacidad.
                    </p>
                </footer>
            </section>";
    }

    private function muestraInfoContacto(){
        echo "<!--Esta sección está oculta hasta que se pulsa el botón de Contacto del footer y se sitúa sobre el formulario ocultando este -->
            <section id=\"info-contacto\">
                <header id=\"cabecera-contacto\">
                    <h1>Contacto</h1>
                </header>
                <!--Utilizo un schema para epecificar que lo que voy a describir es una persona y así tener más semántica en la página -->
                <section itemscope=\"\" itemtype=\"http://schema.org/Person\">
                    <span itemprop=\"name\">Emilio Chica Jiménez</span>
                </section>
                <!--Utilizo un schema para epecificar que lo que voy a describir es una persona y así tener más semántica en la página -->
                <ul itemprop=\"address\" itemscope=\"\" itemtype=\"http://schema.org/PostalAddress\">
                    <li>
                        <span itemprop=\"streetAddress\">Imprenta, nº 2. </span>
                        <span itemprop=\"postalCode\">18010 </span>

                    </li>
                    <li>
                        <span itemprop=\"addressLocality\">Granada, </span>
                        <span>Granada, </span>
                        <span itemprop=\"addressCountry\">España</span>
                    </li>
                    <li>
                        <span itemprop=\"telephone\"><a>Teléfono: +34 958 215 273. </a></span>
                    </li>
                    <li>
                        <span itemprop=\"telephone\"><a>Fax: +34 958 225 765</a></span>
                    </li>
                    <li class=\"mail\" itemprop=\"email\"><a href=\"mailto:emiliocj@correo.ugr.es  \">emiliocj@correo.ugr.es </a></li>
                </ul>
            </section>";
    }

}