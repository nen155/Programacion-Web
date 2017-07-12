<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 10/05/2017
 * Time: 18:08
 */
class VistaPerfil{
    private $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    public function muestraPerfil(){
        $this->muestraCabecera();
        echo "<section id=\"singup\">
                    <header id=\"cabecera-singup\">
                        <h1>Perfil</h1>
                    </header>
                    <p>Nombre: ".$this->usuario->getNombre()." ". $this->usuario->getApellidos()."</p>
                    <p>Email: ".$this->usuario->getEmail()."</p>
                    <p>Usuario: ".$this->usuario->getUsuario()."</p>
                    <p>Cumpleaños: ".$this->usuario->getFechaNacimiento()."</p>
            </section>
        </section>";
    }
    private function muestraCabecera(){
        echo "<section class=\"content centrar-filas\">
        <section class=\"index\" id=\"index1\">
            <img src=\"".$this->usuario->getImagen()."\" id=\"img-index\">
        </section>
        <section class=\"index\" id=\"index2\">";
    }
    public function muestraEditarPerfil(){
        $this->muestraCabecera();
         echo "<section id=\"singup\">
                <header id=\"cabecera-singup\">
                    <h1>Edita tu perfil</h1>
                </header>
                <!-- El formulario del usuario activo listo para editar con sus datos -->
                <form enctype=\"multipart/form-data\" onsubmit='alert(\"Has editado tu perfil!....\")' action=\"portada.php?usuario=".$this->usuario->getUsuario()."&seccion=informacion\" method=\"post\" id=\"form-singup\">
                    <section class=\"inputs-form\">
                        <ul class=\"fields-singup\">
                            <li>
                                <input value='".$this->usuario->getEmail()."' id=\"correo\" onFocus=\"limpiarC();\" onblur=\"return validarCorreo();\"  type=\"email\" name=\"correo\" class=\"input-singup\" aria-label=\"Correo electrónico\" aria-required=\"true\" placeholder=\"Correo electrónico\" pattern=\"[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$\" required/>
                                <p id='errorC'>El correo no esta bien escrito</p>
                            </li>
                            <li>
                                <input value='".$this->usuario->getNombre()." ". $this->usuario->getApellidos()."'  id=\"nombre\" onFocus=\"limpiarN();\"  onblur=\"return validarNombre();\" type=\"text\" name=\"nombre\" class=\"input-singup\" aria-label=\"Nombre completo\" aria-required=\"true\" placeholder=\"Nombre completo\" pattern='[a-zA-Z\s]+$' required/>
                                <p id='errorN'>El nombre tiene caracteres erróneos</p>
                            </li>
                             <li>
                                <input value='".$this->usuario->getTelefono()."'  id=\"telefono\" onFocus=\"limpiarT();\" onblur=\"return validarTelefono();\" type=\"text\" name=\"telefono\" class=\"input-singup\" aria-label=\"Telefono\" aria-required=\"true\" pattern='((\+?34([ \t|\-])?)?[9|6|7|8]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$' placeholder=\"Telefono\"/>
                                <p id='errorT'>El telefono no es correcto</p>
                            </li>
                            <li>
                                <input value='".$this->usuario->getUsuario()."'  id=\"nombreusuario\" onFocus=\"limpiarU(this);\" onblur=\"return validarUsuario(this);\" type=\"text\" name=\"usuario\" class=\"input-singup\" aria-label=\"Nombre de usuario\" aria-required=\"true\" placeholder=\"Nombre de usuario\" pattern='(([0-9a-zA-Z]+)[\.-_]?([0-9a-zA-Z]+))+$'  required/>
                                <p id='errorU'>El usuario tiene caracteres erróneos</p>
                            </li>
                            <li>
                                <input id=\"password-singup\" onFocus=\"limpiarP(this);\" onblur=\"return validarPassword(this);\"  type=\"password\" name=\"password\" class=\"input-singup\" aria-label=\"Contraseña\" aria-required=\"true\" placeholder=\"Contraseña de 6 caracteres minimo\" pattern='(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){6,15}$' />
                                <p id='errorP'>Tiene que contener mayúsculas y minúsculas y algún caracter especial</p>
                            </li>
                            <li>
                                <input id=\"re-password-singup\" onFocus=\"limpiarRP(this);\" onblur=\"return validarREPassword(this);\"  type=\"password\" name=\"repassword\" class=\"input-singup\" aria-label=\"Repita la Contraseña\" aria-required=\"true\" placeholder=\"Repita la Contraseña\" pattern='(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){6,15}$' />
                                <p id='errorRP'>No coincide con el password</p>
                            </li>
                            <li>
                                <label for=\"fecna\" id=\"label-fecna\">Fecha de nacimiento</label>
                                <input value='".$this->usuario->getFechaNacimiento()."'  id=\"fecna\" type=\"date\" name=\"fecna\" class=\"input-singup\" aria-label=\"Fecha nacimiento\" aria-required=\"true\" title=\"Fecha nacimiento\" required/>
                            </li>
                            <li>
                                <label for=\"img-editar\" id=\"label-img-ed\">Súbe tu imágen</label>
                                 <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"40000000\" />
                                <!-- El nombre del elemento de entrada determina el nombre en el array FILES -->
                                <input type=\"file\" name=\"imagen\" id=\"img-editar\" value=\"Sube tu imagen\" class=\"buttons\">
                            </li>
                        </ul>
                    </section>
                    <section class=\"buttons-form\">
                        <input type=\"submit\" id=\"enviar\" value=\"Editar\" class=\"buttons\" name='editarperfil'>

                    </section>
                </form>
                <footer class=\"footer-form\">
                    <p>
                        Al registrarte, aceptas nuestras Condiciones y nuestra Política de privacidad.
                    </p>
                </footer>
            </section>
        </section>
    </section>";
    }

}