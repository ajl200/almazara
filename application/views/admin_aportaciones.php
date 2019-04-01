<script>
/*
SELECT aportacion.id as id, variedad.variedad as id_variedad, localidad.localidad as localidad, aportacion.kilos as kilos, aportacion.eco as eco, proveedores.id as id_proveedor, proveedores.nombre as nombre, proveedores.apellido1 as apellido1, proveedores.apellido2 as apellido2, proveedores.dni as dni, proveedores.telf as telf  FROM `aportacion` inner join proveedores on aportacion.id_proveedor = proveedores.id inner join variedad on aportacion.id_variedad = variedad.id inner join localidad on aportacion.id_localidad = localidad.id
*/

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
            <?php echo anchor('Aportaciones/index/','Historial de aportaciones',' class="btn btn-primary"'); ?>

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
                            <th scope="col">Ecologica</th>
                            <th scope="col">ID Proveedor</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
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
                            echo ("<td  data-id=".$aport["id"]." id='variedad_".$aport["id"]."'>".$aport["eco"]."</td>");
                            echo ("<td  data-id=".$aport["id"]." id='proveedor_".$aport["id"]."'>".$aport["id_proveedor"]."</td>");
                            echo ("<td>");
                            echo anchor("Aportaciones/update/".$aport['id'],"<span class='far fa-edit'></span>","  data-id=".$aport['id']." id='btn_update' class='btn-update btn bg-transparent ' data-toggle='modal'  data-target='#modal_update'");
                            echo ("</td>");  
                            echo ("<td>");
                            echo anchor("Aportaciones/delete/".$aport['id'],"<span class='fas fa-trash-alt text-danger'></span>","class='btn bg-transparent'");
                            echo ("</td>");
                            echo ("</tr>");
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>

