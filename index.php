<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test CRUD</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
</head>
<body>
  
<main class="dashboard text-center mb-5">
    <section class="head-page">
        <h4 class="py-4">Administración de alumnos</h4>
        <div class="container pb-4">
            <form action="" id="form">
            <input type="text" name="tipo_operacion" value="guardar" hidden="true">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" id="ciclo" name="ciclo" placeholder="Ciclo">
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" id="sexo" name="sexo">
                            <option selected value="">Elige el sexo</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <div class="col-md-1"> 
                        <button type="submit" class="btn btn-dark">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="container result"> 
        <!-- Modal -->
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar datos del alumno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="editPage"></div>
                </div>
            </div>
        </div>
        <table class="table text-left">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Ciclo</th>
                    <th scope="col">Sexo</th>
                    <th scope="col" class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody id="tabla_datos">
                <?php
                require_once "backend/conexion.php";
                require_once "controller/consultasbd.php";
                
                $sentencia = new consultas();
                $mostrarDatos = $sentencia->listadoAlumnos();
                
                foreach($mostrarDatos as $res)
                {   
                    $id = $res["id"];
                    $nombres =  $res["nombres"];
                    $apellidos =  $res["apellidos"];
                    $ciclo =  $res["ciclo"];
                    $sexo =  $res["sexo"];
                    $vacio = "<span class='px-2' aria-hidden='true'>&times;</span>";
                    if(empty($nombres)){
                        $nombres = $vacio;
                    }
                    if(empty($apellidos)){
                        $apellidos = $vacio;
                    }
                    if(empty($ciclo)){
                        $ciclo = $vacio;
                    }
                    if(empty($sexo)){
                        $sexo = $vacio;
                    }
                    echo "<tr>";
                    echo "<td class='text-capitalize'>".$nombres."</td>";
                    echo "<td class='text-capitalize'>".$apellidos."</td>";
                    echo "<td>".$ciclo."</td>";
                    echo "<td>".$sexo."</td>";
                    echo "<td class='text-center'>
                            <button class='btn btn-primary btn-sm my-1' onclick='editar($id);' data-toggle='modal' data-target='#modalEdit'>Editar</button>
                            <button class='btn btn-danger btn-sm ' onclick='borrar($id);'>Eliminar</button>
                          </td>";
                    echo "</tr>";
                    
                }
                ?>
            </tbody>        
        </table>
    </section>
    <div id="myToast" class="myToast bg-dark text-white d-none">
        <p class="m-0">Guardado con exito</p>
    </div>
</main>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>


</body>
</html>