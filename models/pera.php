<br><h2>Tabla con Boostrap</h2>
    <div class="container mt-5">
        <table id="estudiantes" class="table" 
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <th field="est_cedula" width="50">Cedula</th>
                <th field="est_nombre" width="50">Nombre</th>
                <th field="est_apellido" width="50">Apellido</th>
                <th field="est_direccion" width="50">Direccion</th>
                <th field="est_telefono" width="50">Telefono</th>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
    <script>
    function cargarEstudiantes() {
        $.ajax({
            url: 'models/select.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                
                $('#estudiantes tbody').empty();

              
                $.each(data, function (index, row) {
                    $('#estudiantes tbody').append('<tr>' +
                        '<td>' + row.est_cedula + '</td>' +
                        '<td>' + row.est_nombre + '</td>' +
                        '<td>' + row.est_apellido + '</td>' +
                        '<td>' + row.est_direccion + '</td>' +
                        '<td>' + row.est_telefono + '</td>' +
                        '</tr>');
                });
            },
            error: function (error) {
                console.log('Error al obtener estudiantes:', error);
            }
        });
    }

    $(document).ready(function () {
        cargarEstudiantes();
    });
</script>

    
    
   
    
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Ingreso Estudiante</h3>
            <div style="margin-bottom:10px">
                <input name="est_cedula" class="easyui-textbox" required="true" label="Cedula: " style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="est_nombre" class="easyui-textbox" required="true" label="Nombre: " style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="est_apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="est_direccion" class="easyui-textbox" required="true" label="Direccion:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="est_telefono" class="easyui-textbox" required="true" label="Telefono:" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','New User');
            $('#fm').form('clear');
            url = 'models/guardar.php';
            cargarEstudiantes();
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
                $('#fm').form('load',row);
                url = 'models/actualizar.php?est_cedula='+row.est_cedula;
            }
            
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                iframe: false,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
            cargarEstudiantes();
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Eliminar','Estas seguro de que seas eliminar a este estudiante?',function(r){
                    if (r){
                        cargarEstudiantes();
                        $.post('models/eliminar.php',{est_cedula:row.est_cedula},function(result){
                            if (!result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                       
                    }
                });
            }}