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

    <!-- ESTILOS PROPIOS:-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estilo.css" />

    
    <!-- JS PROPIOS: -->
<!--    <script src=<    ?php echo base_url("assets/js/Mapas.js");?>></script>
    <script src=<              ?php echo base_url("assets/js/demo.js");?>></script>
    <script src=<        ?php echo base_url("assets/js/jquery.hotspot.js");?>></script>
--> 
    <script type="text/javascript" src="https://cdn.rawgit.com/asvd/dragscroll/master/dragscroll.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="nav nav-pills flex-column flex-sm-row">
                <?php
                if (isset($this->session->userdata["id"])) {
                    $id = $this->session->userdata["id"];
                    $nivel = $this->modelUser->getNivel($id);
                    if (isset($noHeader)) {
                        if ($noHeader == false) {
                        }
                        else {
                            // Administrador:
                            if ($nivel == 2) {
                                echo anchor('Users/view_users/','Admin Usuarios',' id="enlace_usuarios" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout',' ',' class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x"');
                            }
                            // Usuario:
                            else if ($nivel == 1) {
                                echo anchor('Login/logout',' ','class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x"');
                            }
                        }
                    }
                    else {
                        // Administrador:
                        if ($nivel == 2) {
                            echo anchor('Users/view_users/','Admin Usuarios',' id="enlace_usuarios" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Login/logout',' ',' class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x"');
                        }
                        // Usuario
                        else if ($nivel == 1) {
                            echo anchor('Login/logout',' ','class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x"');
                        }
                    }
                }
                
                ?>
                </nav>
            </div>
        </div>
    </div>
