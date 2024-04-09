<?php
function hasRole($rol)
{
    $conn = new mysqli("localhost","root","","cursophp2");
    $result= false;

    if($conn->connect_errno)
    {
        echo "No hay conexion: (".$conn->connect_errno.")".$conn->connect_error;
    }

    $queryrol = mysqli_query($conn,"Select role_id, nombre from roles");
    $filasrol = mysqli_num_rows($queryrol);
    $buscarrol = mysqli_fetch_array($queryrol);

    $queryusuario = mysqli_query($conn,"Select role_id from usuarios");
    $filasusuario = mysqli_num_rows($queryusuario);
    $buscarusuario = mysqli_fetch_array($queryusuario);

    if($filasrol > 0)
    {
        $role_id = $buscarrol['role_id'];
        $Admin = $buscarrol['nombre'];
    }

    if($filasusuario > 0)
    {
        $rolAdmin = $buscarusuario['role_id'];
    }

    if($Admin == 'USER' && $rolAdmin == 1)
    {
        return true;
    }


}
?>