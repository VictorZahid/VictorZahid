<h1>INGRESAR</h1>

<form method="post" onsubmit="return validarIngreso()">

	<input type="text" placeholder="Usuario" name="usuarioIngreso" >

	<input type="password" placeholder="Contraseña" name="passwordIngreso" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">

	<input type="submit" value="Enviar">
	
</form>

<?php

$ingreso = new MvcController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";

	}

	if($_GET["action"] == "fallo3intentos"){

		echo "Ha fallado 3 veces para ingresar, favor llenar el captcha";

	}

}

  ?>