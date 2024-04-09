<?php
if( empty(session_id()) && !headers_sent()){
	session_start();
}


if(!$_SESSION["validar"]){

	echo '<script>window.location:index.php?action=ingresar"</script>';

	exit();

}

  ?>


<h1>USUARIOS</h1>

    <table border="1">

    	<thead>
    		
    		<tr>
    			<th>Usuario</th>
    			<th>Contraseña</th>
    			<th>Email</th>
    			<th>Editar</th>
    			<th>Borrar</th>

    		</tr>

    	</thead>

    	<tbody>
    		
    		<?php
    		$vistaUsuario = new MvcController();
    		$vistaUsuario -> vistaUsuarioController();
    		$vistaUsuario -> borrarUsuarioController();
    		?>

    	</tbody>


    	
    </table>

<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";

	}
}

  ?>