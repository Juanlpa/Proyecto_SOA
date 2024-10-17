<?php
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/contactanos.css" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Contacto</title>
    </head>
    <body>
    <div class="contactosContenedor">
    <div class="cajaContacto">
      <h2>Contactanos</h2>
      <img src="imgs/logo.png" alt="Logo">
      <p><strong>Información de contacto:</strong></p>
      <ul>
        <li><strong>Teléfono:</strong> 0958992514</li>
        <li><strong>Email:</strong> jlopez7372@uta.edu.ec</li>
        <li>Av. los chásquis, Ambato 180207, Ambato</li>
      </ul>
    </div>
  </div>
  
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {        
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .table-title .btn-group {
            float: right;
        }
        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }
        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }
        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table tr th:first-child {
            width: 60px;
        }
        table.table tr th:last-child {
            width: 100px;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }   
        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }
        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }
        table.table td a:hover {
            color: #2196F3;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #F44336;
        }
        table.table td i {
            font-size: 19px;
        }
        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }
        .pagination li a:hover {
            color: #666;
        }   
        .pagination li.active a, .pagination li.active a.page-link {
            background: #03A9F4;
        }
        .pagination li.active a:hover {        
            background: #0397d6;
        }
        .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }
        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }    
        /* Custom checkbox */
        .custom-checkbox {
            position: relative;
        }
        .custom-checkbox input[type="checkbox"] {    
            opacity: 0;
            position: absolute;
            margin: 5px 0 0 3px;
            z-index: 9;
        }
        .custom-checkbox label:before{
            width: 18px;
            height: 18px;
        }
        .custom-checkbox label:before {
            content: '';
            margin-right: 10px;
            display: inline-block;
            vertical-align: text-top;
            background: white;
            border: 1px solid #bbb;
            border-radius: 2px;
            box-sizing: border-box;
            z-index: 2;
        }
        .custom-checkbox input[type="checkbox"]:checked + label:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 3px;
            width: 6px;
            height: 11px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: inherit;
            z-index: 3;
            transform: rotateZ(45deg);
        }
        .custom-checkbox input[type="checkbox"]:checked + label:before {
            border-color: #03A9F4;
            background: #03A9F4;
        }
        .custom-checkbox input[type="checkbox"]:checked + label:after {
            border-color: #fff;
        }
        .custom-checkbox input[type="checkbox"]:disabled + label:before {
            color: #b8b8b8;
            cursor: auto;
            box-shadow: none;
            background: #ddd;
        }
        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }
        .modal .modal-header, .modal .modal-body, .modal .modal-footer {
            padding: 20px 30px;
        }
        .modal .modal-content {
            border-radius: 3px;
        }
        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }
        .modal .modal-title {
            display: inline-block;
        }
        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }
        .modal textarea.form-control {
            resize: vertical;
        }
        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }   
        .modal form label {
            font-weight: normal;
        }   
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function(){
                if(this.checked){
                    checkbox.each(function(){
                        this.checked = true;                        
                    });
                } else{
                    checkbox.each(function(){
                        this.checked = false;                        
                    });
                } 
            });
            checkbox.click(function(){
                if(!this.checked){
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h2>Estudiantes</h2>
                        </div>
                        <div class="col-xs-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"> <span>Agregar Estudiante</span></a>
                            <a href="fpdf186\reporte.php" target="_blank" class="btn btn-success"> <span>Reporte</span></a>
                            <a href="phpjasperxml/examples/databasesample.php" target="_blank" class="btn btn-success" > <span>IReport</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">

                    </tbody>
                </table>
            </div>
        </div>        
    </div>

    <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <form id="addEmployeeForm" action="models/guardar.php" method="post">
                <div class="modal-header">						
                    <h4 class="modal-title">AGREGAR ESTUDINTE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label>Cedula</label>
                        <input type="text" class="form-control" name="CED_EST" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="NOM_EST" required>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" name="APE_EST" required>
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="DIR_EST" required>
                    </div>		
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" name="TEL_EST" required>
                    </div>					
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                    <button type="button" class="btn btn-success" id="addEmployeeBtn">AGREGAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEmployeeForm" action="models\editar.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Estudiante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Agrega un campo oculto para la cédula -->
                    <div class="form-group">
                        <label>Cedula</label>
                        <input type="text" class="form-control" name="CED_EST" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="NOM_EST" required>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" name="APE_EST" required>
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <textarea class="form-control" name="DIR_EST" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" name="TEL_EST" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                    <!-- Cambié el tipo de botón para prevenir el envío del formulario -->
                    <button type="button" class="btn btn-success" id="editEmployeeBtn">EDITAR</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteEmployeeForm" action="models\eliminar.php" method="post">
                <div class="modal-header">						
                    <h4 class="modal-title">Eliminar Estudiante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                    <p>¿Estás seguro de que quieres eliminar a este estudiante?</p>
                    <input type="hidden" name="CED_EST" id="deleteEstCedula">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="deleteEmployeeBtn">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Función para cargar los datos desde la base de datos

            $('#addEmployeeBtn').on('click', function () {
        // Obtener los datos del formulario
        var formData = $('#addEmployeeForm').serialize();

        // Realizar la solicitud Ajax
        $.ajax({
            type: 'POST',
            url: '../../models/guardar.php',
            data: formData,
            success: function (response) {
                // Cerrar el modal
                $('#addEmployeeModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            // Limpiar el formulario
            $('#addEmployeeForm')[0].reset();


                // Recargar los datos de la tabla
                loadEmployeeData();
            },
            error: function (error) {
                console.error('Error al guardar: ' + error.responseText);
            }
        });
    });

    $('table').on('click', '.edit', function () {
    // Obtener los datos de la fila
    var row = $(this).closest('tr');
    var ced = row.find('td:eq(0)').text();
    var nom = row.find('td:eq(1)').text();
    var ape = row.find('td:eq(2)').text();
    var dir = row.find('td:eq(3)').text();
    var tel = row.find('td:eq(4)').text();

    // Llenar el formulario de edición con los datos del estudiante
    $('#editEmployeeForm input[name="CED_EST"]').val(ced);
    $('#editEmployeeForm input[name="NOM_EST"]').val(nom);
    $('#editEmployeeForm input[name="APE_EST"]').val(ape);
    $('#editEmployeeForm textarea[name="DIR_EST"]').val(dir);
    $('#editEmployeeForm input[name="TEL_EST"]').val(tel);
});

    $('#editEmployeeBtn').on('click', function () {
    // Obtener los datos del formulario
    var formData = $('#editEmployeeForm').serialize();

    // Realizar la solicitud Ajax
    $.ajax({
        type: 'POST',
        url: '../../models/editar.php',
        data: formData,
        success: function (response) {
            // Cerrar el modal
            $('#editEmployeeModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            // Limpiar el formulario
            $('#editEmployeeForm')[0].reset();

            // Recargar los datos de la tabla
            loadEmployeeData();
        },
        error: function (error) {
            console.error('Error al editar: ' + error.responseText);
        }
    });
});



$('table').on('click', '.delete', function () {
    // Obtener la cédula del estudiante
    var row = $(this).closest('tr');
    var ced = row.find('td:eq(0)').text();

    // Llenar el formulario de eliminación con la cédula del estudiante
    $('#deleteEmployeeForm input[name="CED_EST"]').val(ced);
});

// Manejar el evento de clic en el botón "Eliminar" del formulario de eliminación
$('#deleteEmployeeBtn').on('click', function () {
    // Obtener los datos del formulario
    var formData = $('#deleteEmployeeForm').serialize();

    // Realizar la solicitud Ajax
    $.ajax({
        type: 'POST',
        url: '../../models/eliminar.php',
        data: formData,
        success: function (response) {
            // Cerrar el modal
            $('#deleteEmployeeModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            // Limpiar el formulario
            $('#deleteEmployeeForm')[0].reset();

            // Recargar los datos de la tabla
            loadEmployeeData();
        },
        error: function (error) {
            console.error('Error al eliminar: ' + error.responseText);
        }
    });
});


            function loadEmployeeData() {
                $.ajax({
                    url: '../../models/select.php', // Ruta al script que obtiene los datos desde la base de datos
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data && data.length > 0) {
                            var tableBody = $('#employeeTableBody');
                            tableBody.empty();

                            // Iterar sobre los datos y agregar filas a la tabla
                            $.each(data, function (index, employee) {
                                var row = '<tr>' +
                                    '<td>' + employee.CED_EST + '</td>' +
                                    '<td>' + employee.NOM_EST + '</td>' +
                                    '<td>' + employee.APE_EST + '</td>' +
                                    '<td>' + employee.DIR_EST + '</td>' +
                                    '<td>' + employee.TEL_EST + '</td>' +
                                    '<td>' +
                                    '<a href="#editEmployeeModal" class="edit" data-toggle="modal">Editar</a>' +
                                    '<a href="#deleteEmployeeModal" class="delete" data-toggle="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar</a>' +
                                    '</td>' +
                                    '</tr>';
                                tableBody.append(row);
                            });
                        }
                    },
                    error: function (error) {
                        console.error('Error al cargar los datos: ' + error.responseText);
                    }
                });
            }


            loadEmployeeData();

        });
    </script>

    </body>
    </html>
    <?php
?>