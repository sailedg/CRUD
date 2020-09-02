<?php
require_once "../backend/conexion.php";
require_once "../controller/consultasbd.php";

$tipoConsulta = $_POST['tipo_operacion'];

switch($tipoConsulta){
    case 'guardar':
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $ciclo = $_POST['ciclo'];
        $sexo = $_POST['sexo'];
        
        $consultas = new consultas();
        $ejecutar = $consultas->insertAlumno($nombres,$apellidos,$ciclo,$sexo);
        echo json_encode($ejecutar);
        break;

    case 'editar':
        $id = $_POST['id'];

        $consultas = new consultas();
        $ejecutar = $consultas->getAlumno($id);
        echo json_encode($ejecutar);
        break;

    case 'actualizar':
        $nombres = $_POST['nombresEdit'];
        $apellidos = $_POST['apellidosEdit'];
        $ciclo = $_POST['cicloEdit'];
        $sexo = $_POST['sexoEdit'];
        $id = $_POST['id'];
        $consultas = new consultas();
        $ejecutar = $consultas->updateAlumno($id,$nombres,$apellidos,$ciclo,$sexo);
        
        header('location: /crud/');
        break;

    case 'borrar':
        $id = $_POST['id'];

        $consultas = new consultas();
        $ejecutar = $consultas->deletAlumno($id);
        echo json_encode($ejecutar);
        break;
    default:
        break;
}

?>