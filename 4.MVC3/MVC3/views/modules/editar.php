<?php

if( empty(session_id()) && !headers_sent()){
	session_start();
}


if(!$_SESSION["validar"]){

	echo '<script>window.location:index.php?action=ingresar"</script>';

	exit();

}

  ?>
  
<h1>EDITAR USUARIO</h1>

<form method="post">

<?php

$editarUsuario = new MvcController(); 
$editarUsuario -> editarUsuarioController();
$editarUsuario -> actualizarUsuarioController();

  ?>	
	
</form>

