///////////////VALIDACIÓN DEL FORMULARIO//////////////

/**
 * Valida y escribe un mensaje de que te ha registrado correctamente
 */
function enviar(){
    if(validar())
        alert("Has sido registrado en el sistema correctamente");
}
/**
 * Valida el formulario comprobando el correo, el telefono, el nombre, el usuario, el password y el password de repetición
 * @returns {boolean}
 */
function validar(){
	return validarCorreo() && validarTelefono() && validarNombre() && validarUsuario() && validarPassword() && validarREPassword();
}
/**
 * Limpia el campo de correo de los errores cuando el usuario entra en el campo para modificarlo
 */
function limpiarC(){
	var correo;
    correo=document.getElementById("correo");
	correo.className=correo.className.replace(" error", "");
    correo.innerHTML="";
    correo.placeholder="Correo electrónico";
    document.getElementById("errorC").style.display="none";
}
/**
 * Limpia el campo de telefono de los errores cuando el usuario entra en el campo para modificarlo
 */
function limpiarT(){
	var telef;
    telef=document.getElementById("telefono");
	telef.className=telef.className.replace(" error", "");
	telef.innerHTML="";
    telef.placeholder="Telefono";
    document.getElementById("errorT").style.display="none";
}
/**
 * Limpia el campo de nombre de los errores cuando el usuario entra en el campo para modificarlo
 */
function limpiarN(){
	var nombre;
    nombre=document.getElementById("nombre");
	nombre.className=nombre.className.replace(" error", "");
	nombre.innerHTML="";
    nombre.placeholder="Nombre completo";
    document.getElementById("errorN").style.display="none";
}

/**
 * Limpia el campo de nombre de los errores cuando el usuario entra en el campo para modificarlo
 */
function limpiarU(elemento){
    var usuario;
    usuario=elemento;
    usuario.className=usuario.className.replace(" error", "");
    usuario.innerHTML="";
    usuario.placeholder="Nombre de usuario";
    if(elemento == document.getElementById("nombreusuario"))
        document.getElementById("errorU").style.display="none";
}


/**
 * Limpia el campo de nombre de los errores cuando el usuario entra en el campo para modificarlo
 */
function limpiarP(elemento){
    var password;
    password=elemento;
    password.className=password.className.replace(" error", "");
    password.innerHTML="";
    password.placeholder="Contraseña de 6 caracteres minimo";
    if(elemento == document.getElementById("password-singup"))
        document.getElementById("errorP").style.display="none";
}

/**
 * Limpia el campo de nombre de los errores cuando el usuario entra en el campo para modificarlo
 */
function limpiarRP(elemento){
    var rpassword;
    rpassword=elemento;
    rpassword.className=rpassword.className.replace(" error", "");
    rpassword.innerHTML="";
    rpassword.placeholder="Repita la Contraseña";
    document.getElementById("errorRP").style.display="none";
}
function limpiarCo(elemento){
    var comentario;
    comentario=elemento;
    comentario.className=comentario.className.replace(" error", "");
    document.getElementById("errorCo").style.display="none";
}

/**
 * Valida el correo con los caracteres posibles que puede introducir el usuario
 * @returns {boolean}
 */
function validarCorreo(){
    var correo;
    correo=document.getElementById("correo");
    var er2=/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/;
    var er=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    if(!er2.test(correo.value)){
		correo.className=correo.className + " error";
        correo.innerHTML="";
        correo.placeholder="Incorrecto";
        document.getElementById("errorC").style.display="block";
        return false;
    }
	
	return true;
}
/**
 * Valida el telefono con los caracteres posibles que puede introducir el usuario
 * @returns {boolean}
 */
function validarTelefono(){
    var telef;
    telef=document.getElementById("telefono");
	var er=/^((\+?34([ \t|\-])?)?[9|6|7|8]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/ ;
    if(!er.test(telef.value)){
		telef.className=telef.className + " error";
        telef.innerHTML="";
        telef.placeholder="Incorrecto";
        document.getElementById("errorT").style.display="block";
        return false;
    }
    return true;
}
/**
 * Valida el nombre con los caracteres posibles que puede introducir el usuario
 * @returns {boolean}
 */
function validarNombre(){
    var nombre;
    nombre=document.getElementById("nombre");
    
    var er=/^[A-Za-zÑñáéíóúÁÉÍÓÚ\s]+$/;
    if(!er.test(nombre.value) || nombre.value.length<2){
		nombre.className=nombre.className + " error";
        nombre.innerHTML="";
        nombre.placeholder="Incorrecto";
        document.getElementById("errorN").style.display="block";
        return false;
    }
	
	return true;
}

/**
 * Valida el nombre usuario con los caracteres posibles que puede introducir el usuario
 * @returns {boolean}
 */
function validarUsuario(elemento){
    var usuario;
    usuario=elemento;

    var er=/^(([0-9a-zA-Z]+)[\.-_]?([0-9a-zA-Z]+))+$/;
    if(!er.test(usuario.value) || usuario.value.length<2){
        usuario.className=usuario.className + " error";
        usuario.innerHTML="";
        usuario.placeholder="Incorrecto";
        if(elemento == document.getElementById("nombreusuario"))
            document.getElementById("errorU").style.display="block";
        return false;
    }

    return true;
}

/**
 * Valida el password con los caracteres posibles que puede introducir el usuario
 * @returns {boolean}
 */
function validarPassword(elemento){
    var password;
    password=elemento;

    var er=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&_])([A-Za-z\d$@$!%*?&_]|[^ ]){6,15}$/;
    if(!er.test(password.value) || password.value.length<2){
        password.className=password.className + " error";
        password.innerHTML="";
        password.placeholder="Incorrecto";
        if(elemento == document.getElementById("password-singup"))
            document.getElementById("errorP").style.display="block";
        return false;
    }

    return true;
}

/**
 * Valida el password con los caracteres posibles que puede introducir el usuario
 * @returns {boolean}
 */
function validarREPassword(elemento){
    var repassword;
    repassword=elemento;
    var password;
    password=document.getElementById("password-singup");

    var er=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){6,15}$/;
    if(!er.test(repassword.value) || repassword.value.length<2 || repassword.value !== password.value){
        repassword.className=repassword.className + " error";
        repassword.innerHTML="";
        repassword.placeholder="Incorrecto";
        document.getElementById("errorRP").style.display="block";
        return false;
    }

    return true;
}
/**
 * Valida la longitud de los comentarios
 * @param elemento
 * @returns {boolean}
 */
function validarComentario(elemento) {
    var comentario = elemento;
    if(comentario.value.length>250){
        comentario.className=comentario.className + " error";
        document.getElementById("errorCo").style.display="block";
        return false;
    }

    return true;
}
/**
 * Funcion para cargar el fichero con las entradas
 */
function cargarTextoAjax(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jsonObj = JSON.parse(this.responseText);
            var entradas = "";
            var data = jsonObj.ent;
            for(var i in data)
                entradas+=data[i].entrada+"<br/>";


            mostrarTooltip(entradas);
        }
    };
    xhttp.open("GET", "funciones/obtenerEntradasAjax.php?id="+id, true);
    xhttp.send();
}
/**
 * Muestra el popup con el contenido
 * @param contenido
 */
function mostrarTooltip(contenido){
    tooltip.show(contenido);
}
/**
 * Oculta el popup asociado
 */
function ocultarTooltip(){
    tooltip.hide();
}
/**
 * Elimina el mensaje de login incorrecto si lo hubiese
 */
function quitarPopup() {

    if(document.getElementById("popup")) {
        var delayMillis = 4000; //1 second
        setTimeout(function () {
            //your code to be executed after 1 second
            document.getElementById("popup").parentNode.removeChild(document.getElementById("popup"));
        }, delayMillis);
    }
}


/**
 * Agrego al inicio a todos los elementos con la clase img-usuario y img-usuario-activo
 * los eventos onmouserover y onmouseout
 */
window.onload=function () {
    quitarPopup();
    var imagenes = document.getElementsByClassName("img-usuario");
    var imagenesActivo = document.getElementsByClassName("img-usuario-activo");
    for (var i = 0; i < imagenes.length; i++) {
        imagenes[i].addEventListener('mouseover', function (ele) {
            var id = ele.currentTarget.getAttribute("name");
            cargarTextoAjax(id);
        }, false);
        imagenes[i].addEventListener('mouseout', ocultarTooltip, false);
    }
    for (var i = 0; i < imagenesActivo.length; i++) {
        imagenesActivo[i].addEventListener('mouseover', function (ele) {
            var id = ele.currentTarget.getAttribute("name");
            cargarTextoAjax(id);
        }, false);
        imagenesActivo[i].addEventListener('mouseout', ocultarTooltip, false);
    }
}
