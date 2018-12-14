<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './conexion.php';

if (isset($_POST["id"])) {
    ActualizarUsuario($_POST);
} else if (!isset($_POST['id']) && !isset($_GET['id']) && isset($_POST['nombre'])) {
//    $nombres = ["Luis","josé", "pedro", "raúl", "maría", "luisa", "adriana", "ángela", "alan"];
//    $cargos = ["Ingeniero","Consultor","Analista"];
//    for ($i = 0; $i < 1000; $i++) {
//        if ($i > 0) {
//            $_POST['cedula'] = rand(3333333, 9000000);
//            $_POST['celular'] = rand(3333333, 9000000);
//            $_POST['nombre'] = $nombres[mt_rand(0, count($nombres) - 1)];
//            $_POST['fecha_nacimiento'] = date('Y-m-d');
//            $_POST['cargo'] = $cargos[mt_rand(0, count($cargos) - 1)];
//        }
        guardarUsuario($_POST);
//    }
} else if (isset($_GET['id'])) {
    eliminarUsuario($_GET['id']);
}
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
header("Location: http://$host$uri/$extra");
exit;
?>