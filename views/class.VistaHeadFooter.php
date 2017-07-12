<?php
/**
 * Created by IntelliJ IDEA.
 * User: Emilio Chica Jiménez
 * Date: 07/05/2017
 * Time: 20:35
 */

class VistaHeadFooter{
    /**
     * Muestra el head
     */
    public function muestraHead(){
        echo "<!DOCTYPE html>
            <html lang=\"es\">
            <head>
                <meta charset=\"UTF-8\">
                <title>MeetUS - La red social para encontrarse</title>
                <link href=\"css/style.css\" rel=\"stylesheet\"/>
                <link href=\"css/tooltip.css\" rel=\"stylesheet\"/>
                <meta name=\"aplication-name\" content=\"MeetUS\"/>
                <meta name=\"author\" content=\"Emilio Chica Jiménez\"/>
                <meta name=\"description\" content=\"Una red social para encontrarse\"/>
                <link href=\"https://fonts.googleapis.com/css?family=Baloo+Bhaina|Roboto\" rel=\"stylesheet\">
                <script src='js/tooltip.js' type='text/javascript'></script>
                <script src='js/script.js' type='text/javascript'></script>
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                
            </head>
            <body>";
    }

    /**
     * Muestra el footer
     */
    public function muestraFooter(){
        echo "</section>
            <!--Creo un pequeño menu en el footer con la opción de contacto en este caso especial por no poder usar Javascript -->
            <footer id='footer-cont' class=\"footer-content\">
                <section class=\"menu-footer menu centrar-filas\">
                    <nav>
                        <ul>
                            <li class=\"menu-item\">
        
                                <a href=\"index.php?seccion=contacto\" class=\"menu-link\" >
                                    <!-- He necesitado de un label para hacer la acción con el checkbox y así poder situarlo en otro sitio-->
                                    Contacto
                                    <!--<label for=\"contacto-label\">
                                        <span id=\"contacto-menu-item\">Contacto</span>
                                    </label>-->
                                </a>
                            </li>
                            <li class=\"menu-item\"><a href=\"como_se_hizo.pdf\" class=\"menu-link\" >Cómo se hizo</a></li>
                        </ul>
                    </nav>
                </section>
                <section class=\"footer-title\">
                    <p id=\"copyright\">Desing by <strong>Emilio Chica Jiménez</strong> ColoredMoon</p>
                </section>
            </footer>
        </main>
        </body>
        </html>";
    }
}
?>