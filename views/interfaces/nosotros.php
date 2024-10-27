
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="imgs/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Listado de Estudiantes</title>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Listado de Estudiantes</h1>

        <!-- Botones de búsqueda -->
        <div class="row mb-3">
            <div class="col-lg-6">
                <input id="buscarCedula" class="form-control" placeholder="Buscar por Cédula">
            </div>
            <div class="col-lg-6">
                <input id="buscarNombre" class="form-control" placeholder="Buscar por Nombre">
            </div>
            <div class="col-lg-12 text-end mt-2">
                <button class="btn btn-primary" id="buscarBtn">Buscar</button>
                <button class="btn btn-secondary" id="resetBtn">Resetear</button>
            </div>
        </div>

        <?php if (isset($_SESSION['usuario'])): ?> <!-- Solo mostrar botones si hay sesión -->
            <div class="row mb-3">
                <div class="col-lg-12 text-end">
                    <button class="btn btn-primary" id="agregarBtn" data-bs-toggle="modal" data-bs-target="#addModal">Añadir Estudiante</button>
                </div>
            </div>
        <?php endif; ?>

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
                            <th>Curso</th>
                            <?php if (isset($_SESSION['usuario'])): ?> <!-- Solo mostrar columna de acciones si hay sesión -->
                                <th>Acciones</th>
                            <?php endif; ?>
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
                            <label for="estCedula">Cédula</label>
                            <input type="text" class="form-control" id="estCedula" required>
                        </div>
                        <div class="form-group">
                            <label for="estNombre">Nombre</label>
                            <input type="text" class="form-control" id="estNombre" required>
                        </div>
                        <div class="form-group">
                            <label for="estApellido">Apellido</label>
                            <input type="text" class="form-control" id="estApellido" required>
                        </div>
                        <div class="form-group">
                            <label for="estDireccion">Dirección</label>
                            <input type="text" class="form-control" id="estDireccion" required>
                        </div>
                        <div class="form-group">
                            <label for="estTelefono">Teléfono</label>
                            <input type="text" class="form-control" id="estTelefono" required>
                        </div>
                        <div class="form-group">
                            <label for="curId">Curso</label>
                            <select class="form-control" id="curId" required>
                                <!-- Opciones de cursos se cargarán aquí dinámicamente -->
                            </select>
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
            // Cargar los estudiantes
            function cargarDatos(query = '') {
                var url = 'http://localhost/Proyecto_SOA/controllers/API.php?entity=estudiantes' + query;
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tableBody = $('#tableBody');
                        tableBody.empty();
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(function(row) {
                                var tableRow = `<tr>
                            <td>${row.estCedula}</td>
                            <td>${row.estNombre}</td>
                            <td>${row.estApellido}</td>
                            <td>${row.estDireccion}</td>
                            <td>${row.estTelefono}</td>
                            <td>${row.nombreCurso}</td>`;

                                <?php if (isset($_SESSION['usuario'])): ?> // Mostrar botones solo si hay sesión
                                    tableRow += `<td>
                            <button class="btn btn-warning btn-sm edit-btn" data-cedula="${row.estCedula}">Editar</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-cedula="${row.estCedula}">Borrar</button>
                        </td>`;
                                <?php endif; ?>

                                tableRow += `</tr>`;
                                tableBody.append(tableRow);
                            });
                        } else {
                            tableBody.append('<tr><td colspan="7" class="text-center">No hay estudiantes</td></tr>');
                        }
                    },
                    error: function() {
                        $('#tableBody').append('<tr><td colspan="7" class="text-center">Error al cargar los datos</td></tr>');
                    }
                });
            }

            // Cargar los cursos
            function cargarCursos() {
                $.ajax({
                    url: 'http://localhost/Proyecto_SOA/controllers/API.php?cursos=1',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Agrega este log para revisar los datos que recibes
                        var curIdSelect = $('#curId');
                        curIdSelect.empty();

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(function(curso) {
                                curIdSelect.append(`<option value="${curso.curId}">${curso.nombre}</option>`);
                            });
                        } else {
                            curIdSelect.append('<option value="">No hay cursos disponibles</option>');
                        }
                    },
                    error: function() {
                        $('#curId').append('<option value="">Error al cargar los cursos</option>');
                    }
                });
            }


            // Buscar estudiantes
            $('#buscarBtn').on('click', function() {
                var cedula = $('#buscarCedula').val();
                var nombre = $('#buscarNombre').val();
                var query = `&estCedula=${cedula}&estNombre=${nombre}`;
                cargarDatos(query);
            });


            $('#agregarBtn').on('click', function() {
                $('#cedulaOriginal').val("");
                $('#estCedula').val("");
                $('#estNombre').val("");
                $('#estApellido').val("");
                $('#estDireccion').val("");
                $('#estTelefono').val("");
                $('#curId').val(1);
                $('#modalTitle').text('Añadir Estudiante');
            });

            // Resetear búsqueda
            $('#resetBtn').on('click', function() {
                $('#buscarCedula').val('');
                $('#buscarNombre').val('');
                cargarDatos();
            });

            // Inicializar la página
            cargarCursos();
            cargarDatos();

            // Editar estudiante
$('#tableBody').on('click', '.edit-btn', function() {
    var cedula = $(this).data('cedula'); // Obtener la cédula del botón
    $.ajax({
        url: `http://localhost/Proyecto_SOA/controllers/API.php?cedula=${cedula}`,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Verifica si `data` es un objeto y no un array
            if (data && data.estCedula) {
                // Abre el modal y configura su título
                $('#addModal').modal('show').find('.modal-title').text('Editar Estudiante');
                
                // Carga los datos del estudiante en el formulario
                $('#crudForm').find('#estCedula').val(data.estCedula);
                $('#crudForm').find('#estNombre').val(data.estNombre);
                $('#crudForm').find('#estApellido').val(data.estApellido);
                $('#crudForm').find('#estDireccion').val(data.estDireccion);
                $('#crudForm').find('#estTelefono').val(data.estTelefono);
                $('#crudForm').find('#curId').val(data.curId);  // Cargar el curso seleccionado

                $('#cedulaOriginal').val(data.estCedula); // Almacena la cédula original para futuras operaciones
            } else {
                alert('Estudiante no encontrado');
            }
        },
        error: function() {
            alert('Error al cargar los datos del estudiante');
        }
    });
});

            // Guardar estudiante (similar al código existente)
            $('#crudForm').submit(function(e) {
                e.preventDefault();
                var cedulaOriginal = $('#cedulaOriginal').val();
                var method = cedulaOriginal ? 'PUT' : 'POST';
                var url = 'http://localhost/Proyecto_SOA/controllers/API.php?entity=estudiantes';
                var data = {
                    estCedula: $('#estCedula').val(),
                    estNombre: $('#estNombre').val(),
                    estApellido: $('#estApellido').val(),
                    estDireccion: $('#estDireccion').val(),
                    estTelefono: $('#estTelefono').val(),
                    curId: $('#curId').val()
                };
                if (method === 'PUT') {
                    url += `&cedula=${cedulaOriginal}`;
                }

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function() {
                        $('#addModal').modal('hide');
                        cargarDatos();
                    }
                });
            });

            // Borrar estudiante (similar al código existente)
            $('#tableBody').on('click', '.delete-btn', function() {
                var cedula = $(this).data('cedula');
                if (confirm('¿Seguro que quieres borrar este estudiante?')) {
                    $.ajax({
                        url: `http://localhost/Proyecto_SOA/controllers/API.php?cedula=${cedula}`,
                        method: 'DELETE',
                        success: function() {
                            cargarDatos();
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>