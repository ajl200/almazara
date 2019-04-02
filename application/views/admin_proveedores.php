<script>


        // VALIDACION DNI:
    function validar_dni (opc){
        validar_ajax = false;
        dni = $("#"+opc+"_dni").val();
        element = $("#"+opc+"_dni")[0];
        var abecedario = 'TRWAGMYFPDXBNJZSQVHLCKE';
        var dni_length = dni.length;
        var acum = "";
        dni_def = $('#dni_'+id).text();
        // -1 sin la letra:
        for( i = 0; i < dni_length -1 ; i++){
            var n = dni.charAt(i);
            acum += n;
        }
        var letra_input = dni.charAt(dni_length-1);
        var letra = abecedario.charAt(parseInt(acum % 23));
        console.log(letra , letra_input);
    if (letra != letra_input){
            $("#submit_insert").prop("disabled", true);
            element.setCustomValidity('Introduzca un DNI válido.');
    } else {
        if (opc == 'ins'){   
        // Si vamos a insertar y la letra es = al input realizará la validación de ajax.          
        validar_ajax = true;
        // Si vamos a modificar y la letra es = al input y el dni no ha sido modificado no hará la validacion por ajax. 
        // Si es distinta si hará la comprobación del nuevo dni
    } else {
        if (dni == dni_def){
        validar_ajax = false;
        $("#submit_insert").prop("disabled", false);
        element.setCustomValidity('');
    } else {
        validar_ajax = true;
    }
    }
    }
    }
    
    $(document).ready(function(){   
       
    $("#ins_dni").on('change', function(e){
        validar_dni('ins');
        if(validar_ajax){  
            a();
            e.preventDefault(); 
        }
    });

    function a (){
        var formData = {
                        'dni' : dni
                    };
        $.ajax({
                    type     : "POST",
                    cache    : false,
                    url      : "<?php echo base_url(); ?>index.php/Proveedores/validar_dni",
                    data     : formData,
                    dataType : 'json',
                    encode : true
                    })
                    .done(function(r) {
                        console.log('llega ' + r );
                        if (r == 1 ){
                            $("#submit_insert").prop("disabled", true);
                            element.setCustomValidity('Ya se encuentra un usuario asociado a este DNI.');
                        }else {
                            console.log('DONE!');
                            $("#submit_insert").prop("disabled", false);
                            element.setCustomValidity('');
                        }
                        })
                        .fail(function(r) {
                            console.log('error ' + r );
                            alert( "error" );
                        }); 
    }
    $("#upd_dni").on('change', function(e){
        validar_dni('upd');
        if(validar_ajax){
            a();
            e.preventDefault(); 
        }
    });

    $("#enlace_proveedores").toggleClass('active');

    $('#tabla_proveedores').DataTable({
        "language": {
            "search": "Buscador:",
            "info": "Mostrando de _START_ - _END_ de _TOTAL_ entrada(s).",
            "emptyTable": "No hay datos disponibles",
            "infoEmpty":      "",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando petición...",
            "zeroRecords":    "No se encuentran coincidencias",
            "lengthMenu":     "Mostrar _MENU_ entradas",
            "paginate": {
                "first":      "<<",
                "last":       ">>",
                "next":       ">",
                "previous":   "<"
            },
        }
    });
    
        // Establecemos un placeholder para el buscador.
        $("input[type='search']").attr('placeholder','Buscar Proveedor');
        $("select[name='tabla_proveedores_length']").addClass("form-control form-control-sm");
        // Añadimos la clase form-control para que el buscador tenga el aspecto de bootstrap.
        $("input[type='search']").addClass('form-control');
    
    
    $(document).on('click',"#btn_update", function(){
        element = $("#upd_dni")[0];
        element.setCustomValidity('');

        id = $(this).data('id');
        var nombre = $('#nombre_'+id).text();
        var apellido1 = $('#apellido1_'+id).text();
        var apellido2 = $('#apellido2_'+id).text();
        var dni = $('#dni_'+id).text();
        var telf = $('#telf_'+id).text();
        
        $('#upd_id').val(id); 
        $('#upd_nombre').val(nombre); 
        $('#upd_apellido1').val(apellido1); 
        $('#upd_apellido2').val(apellido2); 
        $('#upd_dni').val(dni); 
        $('#upd_telefono').val(telf); 
    });

    $(document).on('click','.tt', function(){
        $("#ins_aportacion").trigger('reset');
        $('#modal_insert_aportacion').modal('toggle');
       var id = $(this).data('id');
       var dni = $('#dni_'+id).text();
       $('#prov_id').val(dni);
       var nombre = $('#nombre_'+id).text();
       var apellido1 = $('#apellido1_'+id).text();
       var apellido2 = $('#apellido2_'+id).text();
       $('#prov_nombre').val(nombre + " " + apellido1 + " " + apellido2);
       ;
    });

    $("#btn_insert").on('click', function(){
        $("#form_insert").trigger('reset');
    });

    $("#ins_dni").on('blur', function () {
        if ($(this).val() != ""){
            var ins = 'ins';
            validar_dni(ins);
        }
    });

    $("#submit_ins_aportacion").on('submit', function(){
        console.log('submitted');
    });

    $("#upd_dni").on('blur', function () {
        if ($(this).val() != ""){
            var upd = 'upd';
            validar_dni(upd);
        }
    });
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
                <table id='tabla_proveedores' class="table table-hover ">
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
                            echo ("<td class='tt' data-id=".$proveedor["id"]." id='proveedor_".$proveedor["id"]."'>".$proveedor["id"]."</td>");
                            echo ("<td class='tt' data-id=".$proveedor["id"]." id='nombre_".$proveedor["id"]."'>".$proveedor["nombre"]."</td>");
                            echo ("<td class='tt' data-id=".$proveedor["id"]." id='apellido1_".$proveedor["id"]."'>".$proveedor["apellido1"]."</td>");
                            echo ("<td class='tt' data-id=".$proveedor["id"]." id='apellido2_".$proveedor["id"]."'>".$proveedor["apellido2"]."</td>");
                            echo ("<td class='tt' data-id=".$proveedor["id"]." id='dni_".$proveedor["id"]."'>".$proveedor["dni"]."</td>");
                            echo ("<td class='tt' data-id=".$proveedor["id"]." id='telf_".$proveedor["id"]."'>".$proveedor["telf"]."</td>");
                            echo ("<td>");
                            echo anchor("Proveedores/update/".$proveedor['id'],"<span class='far fa-edit'></span>","  data-id=".$proveedor['id']." id='btn_update' class='btn-update btn bg-transparent ' data-toggle='modal'  data-target='#modal_update'");
                            echo ("</td>");  
                            echo ("<td>");
                            echo anchor("Proveedores/delete/".$proveedor['id'],"<span class='fas fa-trash-alt text-danger'></span>","id='btn_delete' class='btn bg-transparent'");
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
                        <?php echo form_open_multipart('Proveedores/insert','id="form_insert" class="ui-filterable"'); ?>

                        <div class='form-group'>
                            <label for='ins_nombre'>Nombre</label>
                            <input type='text' class='form-control' placeholder='Introduce un nombre' name='ins_nombre' id='ins_nombre' value='' required />
                        </div>
                        
                        <div class='form-group'>
                            <label for='ins_apellido1'>Primer Apellido</label>
                            <input type='text' class='form-control' placeholder='Introduzca el primer apellido' name='ins_apellido1' id='ins_apellido1' value='' required />
                        </div>

                        <div class='form-group'>
                            <label for='ins_apellido2'>Segundo Apellido</label>
                            <input type='text' class='form-control' placeholder='Introduzca el segundo apellido' name='ins_apellido2' id='ins_apellido2' value='' required />                 
                        </div>

                        <div class='form-group'>
                            <label for='ins_dni'>DNI</label>
                            <input type='text' minlength="9" maxlength="9" class='form-control' placeholder='Introduzca el DNI' name='ins_dni' id='ins_dni' value='' required />                 
                        </div>

                        <div class='form-group'>
                            <label for='ins_telefono'>Teléfono</label>
                            <input type='text' minlength="9" maxlength="9" class='form-control' placeholder='Introduzca su teléfono' name='ins_telefono' id='ins_telefono' value='' required />                 
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
                        <input type='text' class='d-none' value='' name='upd_id' id='upd_id' required/>
                        
                        <div class='form-group'>
                            <label for='upd_nombre'>Nombre</label>
                            <input type='text' class='form-control' placeholder='Introduzca un nombre' name='upd_nombre' id='upd_nombre' required />
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
                            <label for='upd_dni'>DNI</label>
                            <input type='text' minlength="9" maxlength="9" class='form-control' placeholder='Introduzca el DNI' name='upd_dni' id='upd_dni' required />                 
                        </div>

                        <div class='form-group'>
                            <label for='upd_telf'>Teléfono</label>
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
        
        
        <div class="modal fade" id="modal_insert_aportacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Añadir Aportación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- ****************** CUERPO DEL CUADRO MODAL INSERT *********************** -->
                        <?php echo form_open_multipart('Aportaciones/insert','id="ins_aportacion" class="ui-filterable"'); ?>
                        <input type='text' id='prov_id' name='prov_id' class='d-none'/>

                        <div class='form-group'>
                            <label for='ins_aportacion_kg'>Fecha: </label>
                            <input type='date' class='form-control' value='<?php echo date('Y-m-d'); ?>' name='prov_fecha' id='prov_fecha' required/>
                        </div>

                        <div class='form-group'>
                            <label for='ins_aportacion_kg'>Proveedor: </label>
                            <input type='text' class='form-control' value='' name='prov_nombre' id='prov_nombre' disabled/>
                        </div>

                        <div class='form-group'>
                            <label for='ins_aportacion_kg'>Kilogramos: </label>
                            <input type='number' min='1' class='form-control' placeholder='Kilogramos aportados' name='ins_aportacion_kg' id='ins_aportacion_kg' required />
                        </div>

                        <div class='form-group'>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Variedad</label>
                                </div>
                                <?php echo form_dropdown('ins_variedad', $lista_variedades, "", "class='custom-select' required"); ?>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Localidad</label>
                                </div>
                                <?php echo form_dropdown('ins_localidad', $lista_localidades, "", "class='custom-select' required"); ?>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="cb_eco">
                            <label class="form-check-label" for="cb_eco"> Ecológica </label>
                        </div>

                        <br><br><br><br><br><br><br>
                        
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            <input type="submit" name="submit" id="ins_aportacion" value="Insertar" class="btn btn-primary">
                        </div>
                        <?php 
                            echo form_close(); 
                        ?>
                    </div>
                </div> <!-- cierra el modal body -->
            </div>
        </div> <!-- modal_insert -->
</div>

