<h1>REGISTRO DE USUARIO</h1>

<form method="post" onsubmit="return validarRegistro()">

  <label for="usuarioRegistro">Usuario</label><br>
	<input type="text" placeholder="Máximo 6 caracteres" maxlength="8" name="usuarioRegistro" id="usuarioRegistro">

  <label for="passwordRegistro">Contraseña</label><br>
	<input type="password" placeholder="Minimo 8 caracteres, incluir números(s) y una mayúscula" name="passwordRegistro" id="passwordRegistro" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">

  <label for="emailRegistro">Correo electrónico</label><br>
	<input type="email" placeholder="Escriba su correo electrónico correctamente" name="emailRegistro" id="emailRegistro">

	<p style="text-align: center"><input type="checkbox" id="terminos"><a href="#">Acepta términos y condiciones</a></p>
  
	<input type="submit" value="Enviar">
	
</form>

<?php

$registro = new MvcController();
$registro -> registroUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";

	}
}


  ?>