//Registro
const $form = document.querySelector('#form');
$form.addEventListener('submit', (e) =>{
    e.preventDefault();
    const datos = new FormData(document.getElementById('form'));
    const $myAlert = document.getElementById('myToast');

    let url = "./model/request.php";
    fetch(url, {
        method: 'POST',
        body: datos

    })
    .then(data => data.json())
    .then(data => {
        console.log('success', data);
        //muestra el listado de alumnos existentes
        mostrarDatosTabla(data);
        //restea los inputs del form
        $form.reset();
        //Genera alerta de registro exitoso
        $myAlert.classList.remove('d-none');
        setTimeout(function(){
            $myAlert.classList.add('d-none');
        },  1500)
    })
    
    .catch (function(error){
        console.log('error', error);
    });
});

function campoVacio(){
    const vacio = `<span class="px-2" aria-hidden="true">&times;</span>`;
    return vacio;
}
//Consulta
const mostrarDatosTabla = (data) =>{
    let tableDatos = document.querySelector('#tabla_datos');
    tableDatos.innerHTML = "";
    for(let item of data){
        
        if(item.nombres == ''){
            item.nombres = campoVacio();
        }if(item.apellidos  == ''){
            item.apellidos = campoVacio();
        }if(item.ciclo  == ''){
            item.ciclo = campoVacio();
        }if(item.sexo  == ''){
            item.sexo = campoVacio();
        }
        tableDatos.innerHTML += `
        <tr>
            <td class="text-capitalize">${item.nombres}</td>
            <td class="text-capitalize">${item.apellidos}</td>
            <td>${item.ciclo}</td>
            <td>${item.sexo}</td>
            <td class="text-center">
                <button class="btn btn-primary btn-sm my-1" onclick="editar(${item.id})" data-toggle="modal" data-target="#modalEdit">Editar</button>
                <button class="btn btn-danger btn-sm"  onclick="borrar(${item.id})">Eliminar</button>
            </td>
        </tr>
        `
    }

}

//Editar y Actualizar
const editar = (id) =>{
    let url = "./model/request.php";
    let formData = new FormData();
    formData.append('tipo_operacion', 'editar');
    formData.append('id', id);

    fetch(url,{
        method: 'POST',
        body: formData
    })
    .then(data => data.json())
    .then(data => {
        console.log('success', data);
        mostrarDatosEdit(data);
    })
    .catch (function(error){
        console.error('error', error);
    });
}

const mostrarDatosEdit = (data) =>{
    let editInputs = document.querySelector('#editPage');
    for(let item of data){
        var sexo = item.sexo;
        if(sexo == 'M'){
            var sexo = `
            <select class="form-control" id="sexoEdit" name="sexoEdit">
                <option value="M" >Masculino</option>
                <option value="F">Femenino</option>
            </select>
            `;
        }else if(sexo == 'F'){
            var sexo = ` 
            <select class="form-control" id="sexoEdit" name="sexoEdit">
                <option value="F" >Femenino</option>
                <option value="M">Masculino</option>
            </select>
            `;
        }else{
            var sexo = ` 
            <select class="form-control" id="sexoEdit" name="sexoEdit">
                <option selected value="">Elige el sexo</option>
                <option value="F" >Femenino</option>
                <option value="M">Masculino</option>
            </select>
            `;
        }
        editInputs.innerHTML = `
        <form action="./model/request.php" method="POST" id="update">
        <input type="text" name="tipo_operacion" value="actualizar" hidden="true">
        <input type="text" name="id" value="${item.id}" hidden="true">
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="text" class="form-control" id="nombresEdit" name="nombresEdit" value="${item.nombres}" placeholder="Nombres">
            </div>
            <div class="form-group col-md-12">
                <input type="text" class="form-control" id="apellidosEdit" name="apellidosEdit" value="${item.apellidos}" placeholder="Apellidos">
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="cicloEdit" name="cicloEdit" value="${item.ciclo}" placeholder="Ciclo cursado">
            </div>
            <div class="form-group col-md-6">
                ${sexo}
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Actualizar Datos</button>
    </div>
        </form>
        `;
    }
}

//Borrar
const borrar = (id) =>{
    let url = "./model/request.php";
    let formData = new FormData();
    formData.append('tipo_operacion', 'borrar');
    formData.append('id', id);

    fetch(url,{
        method: 'POST',
        body: formData
    })
    .then(data => data.json())
    .then(data => {
        console.log('success', data);
        mostrarDatosTabla(data);
    })
    .catch (function(error){
        console.error('error', error);
    });
}















/*const update = (data) =>{
    let url = "./model/request.php";
    let formData = new FormData();
    formData.append('tipo_operacion', 'editar');
    formData.append('id', id);

    fetch(url,{
        method: 'POST',
        body: formData
    })
    .then(data => data.json())
    .then(data => {
        console.log('success', data);
        mostrarDatosEdit(data);
    })
    .catch (function(error){
        console.error('error', error);
    });
}
*/