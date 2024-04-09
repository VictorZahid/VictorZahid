	<?php 


class MvcController{

	public static function pagina(){

		include "views/template.php";
	}

	public static function enlacesPaginasController(){

		if(isset($_GET['action'])){

		$enlaces = $_GET["action"];

	    }

	    else{

	    	$enlaces = "index";
	    }

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;
	}

	public static function registroUsuarioController(){

				if(isset($_POST["usuarioRegistro"])){

					if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioRegistro"]) &&
					   preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordRegistro"]) &&
					   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRegistro"])){

					   	$encriptar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array( "usuario"=>$_POST["usuarioRegistro"],
					                      "password"=>$encriptar,
					                      "email"=>$_POST["emailRegistro"]);

				$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

				if($respuesta == "success"){

					echo '<script>window.location="ok"</script>';
				}

				else{

					echo '<script>window.location="index.php"</script>';
				}
			}

	    }
		
		
	}
    
	public static function ingresoUsuarioController() {
		if (isset($_POST["usuarioIngreso"])) {
			if (preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioIngreso"]) &&
				preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordIngreso"])) {
	
				$encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
	
				$datosController = array(
					"usuario" => $_POST["usuarioIngreso"],
					"password" => $encriptar
				);
	
				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
	
				$intentos = $respuesta["intentos"];
				$usuario = $_POST["usuarioIngreso"];
				$maximoIntentos = 2;
	
				/*if ($intentos < $maximoIntentos) {*/
					if ($respuesta["password"] == $encriptar) {
						$role_id = $respuesta["role_id"]; // Obtener el id_role del usuario
	
						// Redireccionar según el rol del usuario
						if ($role_id == 1) {
							echo '<script>window.location="administrador"</script>';
						} elseif ($role_id == 2) {
							echo '<script>window.location="cliente"</script>';
						} else {
							// Redireccionar a una página de error o hacer algo más si el rol no es válido
						}
	
						// Iniciar sesión y establecer el estado de autenticación
					    session_start();
						$_SESSION["validar"] = true;
						$intentos = 0;
	
						$datosController = array("usuarioActual" => $usuario, "actualizarIntentos" => $intentos);
						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");

					} else {
						++$intentos;
	
						$datosController = array("usuarioActual" => $usuario, "actualizarIntentos" => $intentos);
						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");
						echo '<script>window.location="fallo"</script>';
					}
				} else {
					$intentos = 0;
	
					$datosController = array("usuarioActual" => $usuario, "actualizarIntentos" => $intentos);
	
					$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");
	
					echo '<script>window.location="fallo3intentos"</script>';
				}
			}
		

	}
	public static 	function validar_sesion() {
		// Inicia la sesión si no ha sido iniciada y los encabezados no se han enviado
		if (empty(session_id()) && !headers_sent()) {
			session_start();
		}
	
		// Verifica si la variable de sesión "validar" no está establecida o es falsa
		if (!isset($_SESSION["validar"]) || !$_SESSION["validar"]) {
			// Redirige al usuario a la página de inicio de sesión
			echo '<script>window.location="index.php?action=ingresar"</script>';
			exit();
		}
	}

	/*public static function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioIngreso"]) &&
			   preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordIngreso"])){

			   	$encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array( "usuario"=>$_POST["usuarioIngreso"],
					                      "password"=>$encriptar);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

				$intentos = $respuesta["intentos"];
                $usuario = $_POST["usuarioIngreso"];
				$maximoIntentos = 2;

				if($intentos < $maximoIntentos){

					if ($respuesta["password"] == $encriptar){//$respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $encriptar){

						//session_start();

						$_SESSION["validar"] = true;
						$intentos = 0;

					    $datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);
					    $respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");

						echo '<script>window.location="administrador"</script>';
					}
					else{

						++$intentos;

						$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);
						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");
						echo '<script>window.location="fallo"</script>';

					}

				}

				else{

					$intentos = 0;

					$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);

					$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");

					echo '<script>window.location="fallo3intentos"</script>';
				}

			}


		}
	}*/

	public static function vistaUsuarioController(){

		$respuesta = Datos::vistaUsuarioModel("usuarios");

        foreach ($respuesta as $row => $item) {
		echo'<tr>
    			<td>'.$item["usuario"].'</td>
    			<td>'.$item["password"].'</td>
    			<td>'.$item["email"].'</td>
    			<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
    			<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
    		</tr>';
    	}


	}

	public static function editarUsuarioController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo '<input type="hidden" value="'.$respuesta["id"].'"name="idEditar">

		      <input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

	          <input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>

	          <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

	          <input type="submit" value="Actualizar datos">';
	}

	public static function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

			if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioEditar"]) &&
					   preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordEditar"]) &&
					   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)[.][a-zA-Z]{2,4}$/', $_POST["emailEditar"])){

					

				$datosController = array("id"=>$_POST["idEditar"],
					           "usuario"=>$_POST["usuarioEditar"],
					           "password"=>$encriptar,
					           "email"=>$_POST["emailEditar"]);

				$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

				if($respuesta == "success"){

					echo '<script>window.location="cambio"</script>';
				}

				else{

					echo "error";
				}

			}


		}
	}

	public static function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				echo '<script>window.location="usuarios"</script>';
			}

		}
	}

}


?>