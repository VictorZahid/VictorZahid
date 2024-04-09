<?php 

class Paginas{

	public static function enlacesPaginasModel($enlaces){

		if($enlaces == "ingresar" ||
		   $enlaces == "administrador" ||
		   $enlaces == "editar" ||
		   $enlaces == "salir" ||
		   $enlaces == "cliente" 
		   ){

			$module = "views/modules/".$enlaces.".php";

		}

		else if($enlaces == "index"){

			$module = "views/modules/registro.php";

		}

		else if($enlaces == "ok"){

			$module = "views/modules/registro.php";

		}

		else if($enlaces == "fallo"){

			$module = "views/modules/ingresar.php";

		}

		else if($enlaces == "fallo3intentos"){

			$module = "views/modules/ingresar.php";

		}

		else if($enlaces == "cambio"){

			$module = "views/modules/usuarios.php";

		}

		else{

			$module = "views/modules/registro.php";
		}

		return $module;

	}

}


?>