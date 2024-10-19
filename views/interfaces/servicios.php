<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" type="image/png">
    <!--  Mis estiloss -->
    <link rel="stylesheet" href="css/styleservicios.css" type="text/css">
    <link rel="stylesheet" href="css/style1.css" type="text/css">
    <!-- estiloscon esuasi -->
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/black/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">

    <title>Servicios</title>
</head>

<body>
    <h2 class="tituloe">TALBA EASYUI DE ESTUDIANTES</h2>
    <!-- TABLA CON EASTYUI -->
    <center>
        <section class="table-responsive">
            <table id="dg" title="My Users" class="easyui-datagrid" style="width:700px;height:250px"
                url="http://localhost/Proyecto_SOA/controllers/API.php" method="GET"
                toolbar="#toolbar" pagination="true"
                rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="cedula" width="50">CEDULA</th>
                        <th field="nombre" width="50">NOMBRE</th>
                        <th field="apellido" width="50">APELLIDO</th>
                        <th field="direccion" width="50">DIRECCION</th>
                        <th field="telefono" width="50">TELEFONO</th>
                    </tr>
                </thead>
            </table>
            <div id="toolbar">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">NUEVO</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">EDITAR</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">ELIMINAR</a>
                <input id="buscarCedula" class="easyui-textbox" label="Buscar:" style="width:300px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="buscarEstudiante()">Buscar</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload " onclick="recargar()"></a>
            </div>

            <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
                <form id="fm" novalidate style="margin:0;padding:20px 50px">
                <input type="hidden" id="cedulaOriginal">    
                <h3>INGRESE ESTUDIANTE</h3>
                    <div style="margin-bottom:10px">
                        <input id="cedula" name="cedula" class="easyui-textbox" required="true" label="CEDULA:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="nombre" name="nombre" class="easyui-textbox" required="true" label="NOMBRE:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="apellido" name="apellido" class="easyui-textbox" required="true" label="APELLIDO:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="direccion" name="direccion" class="easyui-textbox" required="true" label="DIRECCION" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="telefono" name="telefono" class="easyui-textbox" required="true" label="TELEFONO" style="width:100%">
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
    var isNew = true;  // Variable para identificar si es una creación o edición

    function recargar() {
        $('#dg').datagrid('reload');
    }

    function newUser() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Estudiante');
        $('#fm').form('clear');
        isNew = true;  // Es un nuevo estudiante
        url = 'http://localhost/Proyecto_SOA/controllers/API.php';  // URL para POST
    }

    function editUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Estudiante');
            $('#fm').form('load', row);
            isNew = false;  // Estamos editando
            url = 'http://localhost/Proyecto_SOA/controllers/API.php?cedula=' + row.cedula;  // URL para PUT
        }
    }

    
    function saveUser() {
    var method = isNew ? 'POST' : 'PUT';  // Determina si es POST o PUT
    var formData = $('#fm').serialize();  // Serializar los datos del formulario

    $.ajax({
        url: url,
        type: method,
        data: formData,
        success: function(result) {
            var result = JSON.parse(result);  // Si el resultado es un string JSON, convertirlo a objeto
            if (result.success) {
                $('#dlg').dialog('close');  // Cierra el diálogo
                $('#dg').datagrid('reload');  // Recarga los datos
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

    console.log(method);
    console.log(url);
}


    function destroyUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirmar', '¿Estás seguro de que quieres eliminar este estudiante?', function(r) {
                if (r) {
                    $.ajax({
                        url: 'http://localhost/Proyecto_SOA/controllers/API.php?cedula=' + row.cedula,
                        type: 'DELETE',
                        success: function(result) {
                            $('#dg').datagrid('reload');
                            $.messager.show({
                                title: 'Estudiante Eliminado',
                                msg: 'El estudiante ha sido eliminado exitosamente.'
                            });
                        },
                        error: function() {
                            $.messager.show({
                                title: 'Error',
                                msg: 'Hubo un error al eliminar el estudiante.'
                            });
                        }
                    });
                }
            });
        }
    }

    function buscarEstudiante() {
        var cedula = $('#buscarCedula').textbox('getValue');
        if (cedula) {
            $.ajax({
                url: 'http://localhost/Proyecto_SOA/controllers/API.php?cedula=' + cedula,
                method: 'GET',
                success: function(result) {
                    var data = typeof result === 'string' ? JSON.parse(result) : result;
                    if (Array.isArray(data) && data.length > 0) {
                        $('#dg').datagrid('loadData', data);
                    } else if (typeof data === 'object' && Object.keys(data).length > 0) {
                        $('#dg').datagrid('loadData', [data]);
                    } else {
                        $.messager.alert('No encontrado', 'No se encontró un estudiante con la cédula proporcionada', 'info');
                    }
                },
                error: function() {
                    $.messager.alert('Error', 'No se pudo conectar al servidor', 'error');
                }
            });
        } else {
            $.messager.alert('Error', 'Por favor ingresa una cédula para buscar', 'error');
        }
    }
</script>


    <!--  javascript easyui -->
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <!--  javascript easyui -->
</body>

</html>