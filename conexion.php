<?php

ini_set("memory_limit", "256M");
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
$port = 3306;
#$conexion = new mysqli("localhost", "root", "", "prueba_1002488964"); /* host , usuario , contraseña, bd  */
$conexion = mysqli_connect("localhost", "root", "", "prueba_1002488964");
if (!$conexion) {
    echo mysqli_error();
    die("No se pudo conectar a la base de datos");
}

function Usuarios($id = 0, $all = false) {
    global $conexion;
    $json = array();
    $consulta = "SELECT * FROM users ";
    if ($id > 0) {
        $consulta .= "WHERE id={$id}";
    }

    if ($id == 0 && !$all) {
        $consulta = '';
    }

    if ($consulta != '') {

        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            $m = 'Consulta no válida: ' . mysqli_error() . "\n";
            $m .= 'Consulta completa: ' . $consulta;
            die($m);
        }

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $json[] = (array) $fila;
        }
    }

    return $json;
}

function guardarUsuario($usuario) {
    global $conexion;
    $colums = '`' . implode("`,`", array_keys($usuario)) . '`';
    $values = "'" . implode("','", $usuario) . "'";
    $sql = "INSERT INTO `users` ({$colums}) VALUES({$values})";
    $resultado = mysqli_query($conexion, $sql);
    //echo $sql;
    return $resultado;
}

function eliminarUsuario($id) {
    global $conexion;
    $consulta = "DELETE FROM users WHERE id={$id}";
    $resultado = mysqli_query($conexion, $consulta);
    return $resultado;
}

function ActualizarUsuario($usuario) {
    global $conexion;
    $id = $usuario['id'];
    unset($usuario['id']);

    $set = "";
    foreach ($usuario as $key => $value) {
        $val = "'$value'";
        $set .= "`$key`=$val ,";
    }
    $set = substr($set, 0, -1);
    $sql = "UPDATE `users` SET {$set} WHERE id={$id}";

    $resultado = mysqli_query($conexion, $sql);

    return $resultado;
}

?>