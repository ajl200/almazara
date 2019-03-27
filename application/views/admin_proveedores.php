<script>
    $(document).ready(function(){
    $("#enlace_proveedores").toggleClass('active');
    
    $("#btn_insert").on('click', function(){
        $("#insercion").trigger('reset');
    });
    // VALIDACION DNI:
    
        function validar_dni (){
        var element = $("#ins_dni")[0];
        var abecedario = 'TRWAGMYFPDXBNJZSQVHLCKE';
        var dni = $("#ins_dni").val();
        var dni_length = dni.length;
        var acum = "";
        // -1 sin la letra:
        for( i = 0; i < dni_length -1 ; i++){
            var n = dni.charAt(i);
            acum += n;
        }
        var letra_input = dni.charAt(dni_length-1);
        var letra = abecedario.charAt(parseInt(acum % 23));
        
        if (letra == letra_input){
            element.setCustomValidity('');
        }
    }

    $("#ins_dni").on('blur', validar_dni);
    $("#submit_insert").on('click', validar_dni);


});
</script>

<div class="container-fluid">
    <div class='box'>
        <?php
            if (isset($msg)){
                switch ($msg) {
                    case 0:
                        echo "<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.</div>";
                        break;
                    case 1:
                        echo "<div class='alert alert-danger' role='alert'> Se ha producido un error.</div>";  
                        break;
                }
            }
        ?>
    </div>

    <div class="row">
            <div class="col-md-12 botones">
                <button type="button" id="btn_insert" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert"> Insertar Proveedor </button>
            </div>
    </div>

    <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Primer Apellido</th>
                            <th scope="col">Segundo Apellido</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        for($i = 0; $i < count($lista_proveedores);$i++){
                            $proveedor = $lista_proveedores[$i];
                            echo ("<tr>");
                            echo ("<td id='proveedor_".$proveedor["id"]."'>".$proveedor["id"]."</td>");
                            echo ("<td id='nombre_".$proveedor["id"]."'>".$proveedor["nombre"]."</td>");
                            echo ("<td id='apellido1_".$proveedor["id"]."'>".$proveedor["apellido1"]."</td>");
                            echo ("<td id='apellido2_".$proveedor["id"]."'>".$proveedor["apellido2"]."</td>");
                            echo ("<td id='dni_".$proveedor["id"]."'>".$proveedor["dni"]."</td>");
                            echo ("<td id='telf".$proveedor["id"]."'>".$proveedor["telf"]."</td>");
                            echo ("<td>");
                                    echo anchor("Proveedores/update/".$proveedor['id'],"<span class='far fa-edit'></span>","  data-id='".$proveedor['id']."' class='btn-update btn btn-info' data-toggle='modal' id='update_button' data-target='#modal_update'");
                            echo ("</td>");  
                            echo ("<td>");
                                    echo anchor("Proveedores/delete/".$proveedor['id'],"<span class='fas fa-trash-alt'></span>","class='btn btn-danger'");
                            echo ("</td>");
                            echo ("</tr>");
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>


    <!-- *********************** INSERCIÓN DE UN PROVEEDOR ************************** -->
    <div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Insertar Proveedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- ****************** CUERPO DEL CUADRO MODAL INSERT *********************** -->
                        <?php echo form_open_multipart('Proveedores/insert','id="insercion" class="ui-filterable"'); ?>

                        <div class='form-group'>
                            <label for='ins_nombre'>Nombre</label>
                            <input type='text' class='form-control' placeholder='Introduce un nombre' name='ins_nombre' id='ins_nombre' required />
                        </div>
                        
                        <div class='form-group'>
                            <label for='ins_apellido1'>Primer Apellido</label>
                            <input type='text' class='form-control' placeholder='Introduzca el primer apellido' name='ins_apellido1' id='ins_apellido1' required />
                        </div>

                        <div class='form-group'>
                            <label for='ins_apellido2'>Segundo Apellido</label>
                            <input type='text' class='form-control' placeholder='Introduzca el segundo apellido' name='ins_apellido2' id='ins_apellido2' required />                 
                        </div>

                        <div class='form-group'>
                            <label for='ins_apellido2'>DNI</label>
                            <input type='text' minlength="9" maxlength="9" class='form-control' placeholder='Introduzca el DNI' name='ins_dni' id='ins_dni' required />                 
                        </div>

                        <div class='form-group'>
                            <label for='ins_apellido2'>Teléfono</label>
                            <input type='text' minlength="9" maxlength="9" class='form-control' placeholder='Introduzca su teléfono' name='ins_telefono' id='ins_telefono' required />                 
                        </div>
                    
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            <input type="submit" name="submit" id="submit_insert" value="Insertar Proveedor" class="btn btn-primary">
                        </div>
                        <?php 
                            echo form_close(); 
                        ?>
                    </div>
                </div> <!-- cierra el modal body -->
            </div>
        </div> <!-- modal_insert -->

        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Modificar datos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- ****************** CUERPO DEL CUADRO MODAL INSERT *********************** -->
                        <?php echo form_open_multipart('Proveedores/update','id="update" class="ui-filterable"'); ?>

                        <div class='form-group'>
                            <label for='upd_nombre'>Nombre</label>
                            <input type='text' class='form-control' placeholder='Introduce un nombre' name='upd_nombre' id='upd_nombre' required />
                        </div>
                        
                        <div class='form-group'>
                            <label for='upd_apellido1'>Primer Apellido</label>
                            <input type='text' class='form-control' placeholder='Introduzca el primer apellido' name='upd_apellido1' id='upd_apellido1' required />
                        </div>

                        <div class='form-group'>
                            <label for='upd_apellido2'>Segundo Apellido</label>
                            <input type='text' class='form-control' placeholder='Introduzca el segundo apellido' name='upd_apellido2' id='upd_apellido2' required />                 
                        </div>

                        <div class='form-group'>
                            <label for='upd_apellido2'>DNI</label>
                            <input type='text' minlength="9" maxlength="9" class='form-control' placeholder='Introduzca el DNI' name='upd_dni' id='upd_dni' required />                 
                        </div>

                        <div class='form-group'>
                            <label for='upd_apellido2'>Teléfono</label>
                            <input type='text' minlength="9" maxlength="9" class='form-control' placeholder='Introduzca su teléfono' name='upd_telefono' id='upd_telefono' required />                 
                        </div>
                    
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            <input type="submit" name="submit" id="submit_update" value="Aplicar Cambios" class="btn btn-primary">
                        </div>
                        <?php 
                            echo form_close(); 
                        ?>
                    </div>
                </div> <!-- cierra el modal body -->
            </div>
        </div> <!-- modal_insert -->


</div>

