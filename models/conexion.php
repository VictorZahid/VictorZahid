<?php 

class Conexion{

	public static function conectar(){

	    $link = new PDO("mysql:host=localhost;dbname=cursophp2", "root", "");
	    return $link;

    }

}

?>