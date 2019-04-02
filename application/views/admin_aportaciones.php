<script>
    $(document).ready(function(){   
    $("#enlace_aportaciones").toggleClass('active');

    $('#tabla_aportaciones').DataTable({
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
        $("input[type='search']").attr('placeholder','Buscar Aportación');
        $("select[name='tabla_aportaciones_length']").addClass("form-control form-control-sm");
        // Añadimos la clase form-control para que el buscador tenga el aspecto de bootstrap.
        $("input[type='search']").addClass('form-control');

        $(document).on('click',"#btn_update", function(){
        id = $(this).data('id');
        var kilos = $('#kilos_'+id).text();
        var variedad = $('#id_variedad_'+id).text();
        var localidad = $('#id_localidad_'+id).text();
        var eco = $('#eco_'+id).text(); // eco = 1
        var dni = $('#dni_'+id).text();
        var fecha = $('#fecha_'+id).text();

            console.log(variedad, localidad, eco);
        $('#upd_aportacion_id').val(id); 
        $('#upd_aportacion_kg').val(kilos); 
        if (eco == 1){
            
            $('#upd_cb_eco').prop('checked',true);
        } else {
            $('#upd_cb_eco').prop('checked',false);

        }
        $('#upd_aportacion_fecha').val(fecha); 
        $('#upd_variedad').val(variedad);
        $('#upd_localidad').val(localidad); 
        $('#upd_dni').val(dni); 
          
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
            </div>
    </div>

    <div class="row">
            <div class="col-md-12">
                <table id='tabla_aportaciones' class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">ID Aportación</th>
                            <th scope="col">Kilogramos</th>
                            <th scope="col">Variedad</th>
                            <th scope="col">Localidad</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Ecológica</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                            <th class='d-none'></th>
                            <th class='d-none'></th>
                            <th class='d-none'></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        for($i = 0; $i < count($lista_aportaciones);$i++){
                            $aport = $lista_aportaciones[$i];
                            echo ("<tr>");
                            echo ("<td  data-id=".$aport["id"]." id='aport_".$aport["id"]."'>".$aport["id"]."</td>");
                            echo ("<td  data-id=".$aport["id"]." id='kilos_".$aport["id"]."'>".$aport["kilos"]."</td>");
                            echo ("<td  data-id=".$aport["id"]." id='variedad_".$aport["id"]."'>".$aport["variedad"]."</td>");
                            echo ("<td  data-id=".$aport["id"]." id='localidad_".$aport["id"]."'>".$aport["localidad"]."</td>");
                            echo ("<td  class='d-none' data-id=".$aport["id"]." id='id_localidad_".$aport["id"]."'>".$aport["id_localidad"]."</td>");
                            echo ("<td  class='d-none' data-id=".$aport["id"]." id='id_variedad_".$aport["id"]."'>".$aport["id_variedad"]."</td>");
                            echo ("<td  class='d-none' data-id=".$aport["id"]." id='eco_".$aport["id"]."'>".$aport["eco"]."</td>");
                            echo ("<td  data-id=".$aport["id"]." id='dni_".$aport["id"]."'>".$aport["id_proveedor"]."</td>");
                            echo ("<td data-id=".$aport["id"]." id='fecha_".$aport["id"]."'>".$aport["fecha"]."</td>");
                            if ($aport["eco"] == 1){
                                echo ("<td  data-id=".$aport["id"]."><span class='fas fa-leaf'></span></td>");
                            } else {
                                echo ("<td  data-id=".$aport["id"]."><span class='fas fa-times'></span></td>");
                            }
                            echo ("<td>");
                            echo anchor("Aportaciones/update/".$aport['id'],"<span class='far fa-edit'></span>","  data-id=".$aport['id']." id='btn_update' class='btn-update btn bg-transparent ' data-toggle='modal'  data-target='#modal_update'");
                            echo ("</td>");  
                            echo ("<td>");
                            echo anchor("Aportaciones/delete/".$aport['id'],"<span class='fas fa-trash-alt text-danger'></span>","id='btn_delete' class='btn bg-transparent'");
                            echo ("</td>");
                            echo ("</tr>");
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Modificar Aportación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- ****************** CUERPO DEL CUADRO MODAL INSERT *********************** -->
                        <?php echo form_open_multipart('Aportaciones/update','id="upd_aportacion" class="ui-filterable"'); ?>
                        <input type='hidden' class='form-control' value='' name='upd_aportacion_id' id='upd_aportacion_id' required/>

                        <div class='form-group'>
                            <label for='upd_aportacion_fecha'>Fecha: </label>
                            <input type='date' class='form-control' value='' name='upd_aportacion_fecha' id='upd_aportacion_fecha' required/>
                        </div>

                        <div class='form-group'>
                            <label for='upd_aportacion_kg'>Kilogramos: </label>
                            <input type='number' min='1' class='form-control' placeholder='Kilogramos aportados' name='upd_aportacion_kg' id='upd_aportacion_kg' required />
                        </div>

                        <div class='form-group'>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="upd_variedad">Variedad</label>
                                </div>
                                <?php echo form_dropdown('upd_variedad', $lista_variedades, "", "id='upd_variedad' class='custom-select' required"); ?>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="upd_localidad">Localidad</label>
                                </div>
                                <?php echo form_dropdown('upd_localidad', $lista_localidades, "", "id='upd_localidad' class='custom-select' required"); ?> 
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id='upd_cb_eco'  name="upd_cb_eco">
                                <label class="form-check-label" for="upd_cb_eco"> Ecológica </label>
                            </div>
                        </div>
                        
                        <div class='form-group'>
                            <label for='upd_dni'>Proveedor</label>
                            <input type='text' minlength="9" maxlength="9" class='form-control' placeholder='Introduzca el DNI' name='upd_dni' id='upd_dni' required />                 
                        </div>

                        <br><br><br><br><br><br><br>
                        
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            <input type="submit" name="submit" id="upd_aportacion" value="Aplicar cambios" class="btn btn-primary">
                        </div>
                        <?php 
                            echo form_close(); 
                        ?>
                    </div>
                </div> <!-- cierra el modal body -->
            </div>
        </div> <!-- modal_insert -->
</div>
