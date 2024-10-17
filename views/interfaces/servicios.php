<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" type="image/png">

    <!-- Etilo boostrap -->
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
            url="http://localhost/cuarto/controllers/apiREST.php" method="GET"
                toolbar="#toolbar" pagination="true"
                rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="CED_EST" width="50">CEDULA</th>
                        <th field="NOM_EST" width="50">NOMBRE</th>
                        <th field="APE_EST" width="50">APELLIDO</th>
                        <th field="DIR_EST" width="50">DORECCION</th>
                        <th field="TEL_EST" width="50">TELEFONO</th>
                    </tr>
                </thead>
            </table>
            <div id="toolbar">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">NUEVO</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">EDITAR</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">ELIMIAR</a>
                <input id="buscarCedula" class="easyui-textbox" label="Buscar:" style="width:300px">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" onclick="buscarEstudiante()">Buscar</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload " onclick=""></a>
            </div>

            <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
                <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                    <h3>INGRESE ESTUDIANTE</h3>
                    <div style="margin-bottom:10px">
                        <input id="CED_EST" name="CED_EST" class="easyui-textbox" required="true" label="CEDULA:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="NOM_EST" name="NOM_EST" class="easyui-textbox" required="true" label="NOMBRE:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="APE_EST" name="APE_EST" class="easyui-textbox" required="true" label="APELLIDO:" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="DIR_EST" name="DIR_EST" class="easyui-textbox" required="true" label="DIRECCION" style="width:100%">
                    </div>
                    <div style="margin-bottom:10px">
                        <input id="TEL_EST" name="TEL_EST" class="easyui-textbox" required="true" label="TELEFONO" style="width:100%">
                    </div>
                </form>
            </div>
            <div id="dlg-buttons">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()" style="width:120px">GUARDAR</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:120px">CANCELAR</a>
            </div>
        </section>
    </center>
    <script type="text/javascript">
        var url;
        var isEditMode = false;
        var originalCedula = null;
        function newUser() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Estudiante');
            $('#fm').form('clear');
            url = 'http://localhost/cuarto/controllers/apiREST.php';
            isEditMode = false;
            originalCedula = null;
        }

        function editUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Edit User');
                $('#fm').form('load', row); // Carga los datos del usuario en el formulario

                // Guardamos la cedula original para compararla más tarde
                originalCedula = row.CED_EST;

                isEditMode = true;
            }
        }

        function saveUser() {
    var data = {
        CED_EST: $('#CED_EST').textbox('getValue'),  // Usar CED_EST en lugar de cedula
        NOM_EST: $('#NOM_EST').textbox('getValue'),  // Usar NOM_EST en lugar de nombre
        APE_EST: $('#APE_EST').textbox('getValue'),  // Usar APE_EST en lugar de apellido
        DIR_EST: $('#DIR_EST').textbox('getValue'),  // Usar DIR_EST en lugar de direccion
        TEL_EST: $('#TEL_EST').textbox('getValue')   // Usar TEL_EST en lugar de telefono
    };

    if (isEditMode) {
        data.originalCedula = originalCedula;
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        headers: isEditMode ? {
            'X-HTTP-Method-Override': 'PUT'
        } : {},
        success: function(result) {
            $('#dlg').dialog('close');
            $('#dg').datagrid('reload');
            $.messager.show({
                title: 'Success',
                msg: isEditMode ? 'User updated successfully' : 'User created successfully'
            });
        },
        error: function() {
            $.messager.show({
                title: 'Error',
                msg: isEditMode ? 'There was an error while updating the user' : 'There was an error while creating the user'
            });
        }
    });
}

        function destroyUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirm', 'Are you sure you want to destroy this user?', function(r) {
                    if (r) {
                        $.ajax({
                            url: 'http://localhost/cuarto/controllers/apiREST.php?CED_EST=' + row.CED_EST,
                            type: 'DELETE',
                            success: function(result) {
                                $('#dg').datagrid('reload');
                                $.messager.show({
                                    title: 'Usuario Borrado',
                                    msg: result.errorMsg
                                });
                            },
                            error: function() {
                                $.messager.show({
                                    title: 'Error',
                                    msg: 'There was an error while deleting the user'
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
                    url: 'http://localhost/cuarto/controllers/apiREST.php?cedula=' + cedula,
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