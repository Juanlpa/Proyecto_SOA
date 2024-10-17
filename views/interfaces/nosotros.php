<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="imgs/logo.png" type="image/png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Nosotros</title>
</head>

<body>

  <div class="container mt-5">
    <h1 class="text-center">Listado de Estudiantes</h1>
    <div class="row mb-3">
        <div class="col-lg-12 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Añadir Estudiante</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Datos se agregarán dinámicamente aquí -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Añadir/Editar -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Añadir Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="crudForm">
                    <input type="hidden" id="cedulaOriginal">
                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    function cargarDatos() {
        $.ajax({
            url: 'http://localhost/quinto/API.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var tableBody = $('#tableBody');
                tableBody.empty();
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(function(row) {
                        var tableRow = `
                            <tr>
                                <td>${row.cedula}</td>
                                <td>${row.nombre}</td>
                                <td>${row.apellido}</td>
                                <td>${row.direccion}</td>
                                <td>${row.telefono}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn" data-cedula="${row.cedula}">Editar</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-cedula="${row.cedula}">Borrar</button>
                                </td>
                            </tr>
                        `;
                        tableBody.append(tableRow);
                    });
                } else {
                    var noDataRow = `
                        <tr>
                            <td colspan="7" class="text-center">No hay estudiantes</td>
                        </tr>
                    `;
                    tableBody.append(noDataRow);
                }
            },
            error: function(error) {
                console.error('Error al cargar los datos:', error);
                var errorRow = `
                    <tr>
                        <td colspan="7" class="text-center">Error al cargar los datos</td>
                    </tr>
                `;
                $('#tableBody').append(errorRow);
            }
        });
    }

    cargarDatos();

    // Añadir o editar estudiante
    $('#crudForm').submit(function(e) {
    e.preventDefault();
    var cedulaOriginal = $('#cedulaOriginal').val();
    var method = cedulaOriginal ? 'PUT' : 'POST';
    var url = 'http://localhost/quinto/API.php';
    var data = {
        cedula: $('#cedula').val(),
        nombre: $('#nombre').val(),
        apellido: $('#apellido').val(),
        direccion: $('#direccion').val(),
        telefono: $('#telefono').val()
    };
    if (method === 'PUT') {
        url += `?cedula=${cedulaOriginal}`;
    }
    
    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function(response) {
            $('#addModal').modal('hide');
            cargarDatos();
        },
        error: function(error) {
            console.error('Error al guardar los datos:', error);
        }
    });
});


    // Editar estudiante
    $('#tableBody').on('click', '.edit-btn', function() {
    var cedula = $(this).data('cedula');
    $.ajax({
        url: `http://localhost/quinto/API.php?cedula=${cedula}`,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var estudiante = data[0];
            if (estudiante) {
                $('#cedulaOriginal').val(estudiante.cedula);
                $('#cedula').val(estudiante.cedula);
                $('#nombre').val(estudiante.nombre);
                $('#apellido').val(estudiante.apellido);
                $('#direccion').val(estudiante.direccion);
                $('#telefono').val(estudiante.telefono);
                $('#modalTitle').text('Editar Estudiante');
                $('#addModal').modal('show');
            }
        },
        error: function(error) {
            console.error('Error al cargar los datos del estudiante:', error);
        }
    });
});


    // Borrar estudiante
    $('#tableBody').on('click', '.delete-btn', function() {
    var cedula = $(this).data('cedula');
    if (confirm('¿Estás seguro de que deseas borrar este estudiante?')) {
        $.ajax({
            url: `http://localhost/quinto/API.php?cedula=${cedula}`,
            method: 'DELETE',
            success: function(response) {
                cargarDatos();
            },
            error: function(error) {
                console.error('Error al borrar los datos:', error);
            }
        });
    }
});


    // Reiniciar formulario al cerrar el modal
    $('#addModal').on('hidden.bs.modal', function() {
        $('#crudForm')[0].reset();
        $('#cedulaOriginal').val('');
        $('#modalTitle').text('Añadir Estudiante');
    });
});
</script>
</body>

</html>