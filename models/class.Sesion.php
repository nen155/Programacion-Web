<?php
class Sesion{
		function __construct(){
			session_start();
		}
		function get($variable){
			if(isset($_SESSION["$variable"]))
				return $_SESSION["$variable"];
			else
				return null;
		}
		function set($variable,$valor){
			$_SESSION["$variable"] = serialize($valor);
		}
		function cerrar(){
			session_destroy();
		}
	}
?>