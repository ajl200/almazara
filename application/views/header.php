<!DOCTYPE html>
<html lang='es'>

<head>
    <title>Almazara</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- jQuery -->
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- LOS ICONOS FONTAWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- DATATABLES: -->
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel='shortcut icon' type='image/png' href='<?php echo base_url()?>/assets/img/i.png'/>
    <!-- ESTILOS PROPIOS:-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estilo.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script
			  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
			  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
			  crossorigin="anonymous"></script>


     <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBWGgeZBxE6j7R8FUbWai2dZTgCil-AF4&callback=initMap"
  type="text/javascript"></script> 
</head>

<script>
    $(document).ready(function (){
        $(".alert").delay(4000).fadeOut();
    });

     google.charts.load('current', {
       'packages': ['geochart'],
       // Note: you will need to get a mapsApiKey for your project.
       // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
       
     });
     google.charts.setOnLoadCallback(drawMarkersMap);

      function drawMarkersMap() {
      var data = google.visualization.arrayToDataTable([
        ['City',   'Population', 'Area'],
        ['Almeria',      2761477,    1285.31],
        ['Albox',      2761477,    1285.31],
        ['El Ejido',      2761477,    1285.31],
      ]);

      var options = {
        region: 'ES',
        displayMode: 'markers',
        colorAxis: {colors: ['green', 'blue']}
      };

      var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    };





</script>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="nav nav-pills flex-column flex-sm-row">
                <?php
                if (isset($this->session->userdata["id"])) {
                    $id = $this->session->userdata["id"];
                    $nivel = $this->modelUser->getNivel($id);
                    $path =  "<img src='".base_url("/assets/img/i.png")."' id='favicon'>";
                    if (isset($noHeader)) {
                        if ($noHeader == false) {
                        }
                        else {
                            // Administrador:
                            if ($nivel == 2) {
                                echo anchor('Proveedores/index/', $path,' class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Proveedores/index/','Proveedores',' id="enlace_proveedores" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Aportaciones/index/','Aportaciones',' id="enlace_aportaciones" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Bodega/index/','Bodega',' id="enlace_bodega" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Estadisticas/index/','Estadisticas',' id="enlace_estadisticas" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Users/view_users/','Administrar Usuarios',' id="enlace_usuarios" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout',' ',' class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x"');
                            }
                            // Usuario:
                            else if ($nivel == 1) {
                                echo anchor('Proveedores/index/', $path,' class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Proveedores/index/','Proveedores',' id="enlace_proveedores" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Aportaciones/index/','Aportaciones',' id="enlace_aportaciones" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Bodega/index/','Bodega',' id="enlace_bodega" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Estadisticas/index/','Estadisticas',' id="enlace_estadisticas" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout',' ','class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x"');
                            }
                        }
                    }
                    else {
                        // Administrador:
                        if ($nivel == 2) {
                            
                            echo anchor('Proveedores/index/', $path,' class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Proveedores/index/','Proveedores',' id="enlace_proveedores" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Aportaciones/index/','Aportaciones',' id="enlace_aportaciones" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Bodega/index/','Bodega',' id="enlace_bodega" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Users/view_users/','Administrar Usuarios',' id="enlace_usuarios" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Estadisticas/index/','Estadisticas',' id="enlace_estadisticas" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Login/logout',' ',' class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x"');
                        }
                        // Usuario
                        else if ($nivel == 1) {
                            echo anchor('Proveedores/index/', $path,' class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Proveedores/index/','Proveedores',' id="enlace_proveedores" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Aportaciones/index/','Aportaciones',' id="enlace_aportaciones" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Bodega/index/','Bodega',' id="enlace_bodega" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Estadisticas/index/','Estadisticas',' id="enlace_estadisticas" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Login/logout',' ','class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x"');
                        }
                    }
                }
                
                ?>
                </nav>
            </div>
        </div>
    
