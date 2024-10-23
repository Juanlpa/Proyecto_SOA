<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="css/styleservicios.css" type="text/css">
    <link rel="stylesheet" href="css/style1.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/black/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
    <title>Servicios</title>
</head>

<body>
    <h2 class="tituloe">TABLA EASYUI DE ESTUDIANTES</h2>
    <center>
        <section class="table-responsive">
            <table id="dg" title="Estudiantes" class="easyui-datagrid" style="width:700px;height:250px"
                url="http://localhost/Proyecto_SOA/controllers/API.php" method="GET"
                toolbar="#toolbar" pagination="true"
                rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="estCedula" width="50">CÉDULA</th>
                        <th field="estNombre" width="50">NOMBRE</th>
                        <th field="estApellido" width="50">APELLIDO</th>
                        <th field="estDireccion" width="50">DIRECCIÓN</th>
                        <th field="estTelefono" width="50">TELÉFONO</th>
                        <th field="curId" width="50">CURSO</th> <!-- Añadir el curso -->
                    </tr>
                </thead>
            </table>
            <div id="toolbar">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">NUEVO</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">EDITAR</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">ELIMINAR</a>
                <input id="buscarCedula" class="easyui-textbox" label="Buscar:" style="width:200px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="buscarEstudiante()">Buscar</a>
                <input id="buscarNombre" class="easyui-textbox" label="Buscar por nombre:" style="width:200px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload " onclick="recargar()"></a>
            </div>

            <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
                <form id="fm" novalidate style="margin:0;padding:20px 50px">
                <input type="hidden" id="cedulaOriginal">    
                <h3>INGRESE ESTUDIANTE</h3>
                    <div style="margin-bottom:10px">
                        <input id="estCedula" name="estCedula" class="easyui-textbox" required="true" label="CÉDULA:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="estNombre" name="estNombre" class="easyui-textbox" required="true" label="NOMBRE:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="estApellido" name="estApellido" class="easyui-textbox" required="true" label="APELLIDO:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="estDireccion" name="estDireccion" class="easyui-textbox" required="true" label="DIRECCIÓN" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="estTelefono" name="estTelefono" class="easyui-textbox" required="true" label="TELÉFONO" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <select id="curId" name="curId" class="easyui-combobox" label="CURSO:" style="width:100%" required="true">
                            <option value="1">Primero</option>
                            <option value="2">Segundo</option>
                            <option value="3">Tercero</option>
                            <option value="4">Cuarto</option>
                        </select>
                    </div>
                </form>
            </div>

            <div id="dlg-buttons">
                <button type="submit" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()" style="width:120px">GUARDAR</button>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:120px">CANCELAR</a>
            </div>
        </section>
    </center>

    <script type="text/javascript">
    var url;
    var isNew = true;

    function recargar() {
        $('#dg').datagrid('reload');
    }

    function newUser() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Estudiante');
        $('#fm').form('clear');
        isNew = true;
        url = 'http://localhost/Proyecto_SOA/controllers/API.php';  // URL para POST
    }

    function editUser() {
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Estudiante');
        $('#fm').form('load', row);
        $('#curId').combobox('setValue', row.curId);  // Cargar el curso seleccionado
        isNew = false;
        url = 'http://localhost/Proyecto_SOA/controllers/API.php?cedula=' + row.estCedula;  // URL para POST
    }
}


function saveUser() {
    var formData = $('#fm').serialize(); // Serializa los datos del formulario

    $.ajax({
        url: url, // La URL que se establece en editUser o newUser
        type: 'POST', // Método POST para guardar o actualizar
        data: formData, // Datos del formulario
        success: function(result) {
            var result = JSON.parse(result);
            if (result.success) {
                $('#dlg').dialog('close');
                $('#dg').datagrid('reload');
                $.messager.show({
                    title: 'Éxito',
                    msg: result.message
                });
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.message
                });
            }
        },
        error: function(xhr, status, error) {
            $.messager.show({
                title: 'Error',
                msg: 'Hubo un error en la solicitud: ' + error
            });
        }
    });
}

    function destroyUser() {
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        $.messager.confirm('Confirmar', '¿Estás seguro de que quieres eliminar este estudiante?', function(r) {
            if (r) {
                $.ajax({
                    url: 'http://localhost/Proyecto_SOA/controllers/API.php?cedula=' + row.estCedula, // Cambia a 'cedula'
                    type: 'DELETE',
                    success: function(result) {
                        $('#dg').datagrid('reload');
                        $.messager.show({
                            title: 'Estudiante Eliminado',
                            msg: 'El estudiante ha sido eliminado exitosamente.'
                        });
                    },
                    error: function(xhr, status, error) {
                        $.messager.show({
                            title: 'Error',
                            msg: 'Hubo un error al eliminar el estudiante: ' + error // Mejora el manejo de errores
                        });
                    }
                });
            }
        });
    } else {
        $.messager.show({
            title: 'Error',
            msg: 'Por favor, selecciona un estudiante primero.'
        });
    }
}



function buscarEstudiante() {
    var estCedula = $('#buscarCedula').textbox('getValue'); // Obtener el valor de la cédula
    // Si necesitas buscar también por nombre, podrías agregar un campo de entrada adicional
    var estNombre = $('#buscarNombre').textbox('getValue'); // Supón que tienes otro campo para nombre

    // Solo enviar cédula si existe
    $.ajax({
        url: 'http://localhost/Proyecto_SOA/controllers/API.php?estCedula=' + estCedula + '&estNombre=' + estNombre,
        method: 'GET',
        success: function(result) {
            var estudiantes = JSON.parse(result);
            $('#dg').datagrid('loadData', estudiantes);
        },
        error: function() {
            $.messager.show({
                title: 'Error',
                msg: 'No se encontró ningún estudiante con los criterios proporcionados.'
            });
        }
    });
}


    </script>
    <!--  javascript easyui -->
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <!--  javascript easyui -->
</body>

</html>