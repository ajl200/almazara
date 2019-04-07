<script>
    $(document).ready(function(){
        $("#enlace_bodega").toggleClass('active');
    });
</script>

    <div class="row">
            <div class="col-md-12 botones">
                        
            </div>
    </div>

    <div class="row">
            <div class="col-md-12">
                <table id='tabla_bidones' class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">Bidón</th>
                            <th scope="col">Litros Almacenados</th>
                            <th scope="col">Litros Máximos</th>
                            <th scope="col">Variedad</th>
                            <th scope="col">Ecológico</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        for($i = 0; $i < count($lista_bidones);$i++){
                            $bidon = $lista_bidones[$i];
                            echo ("<tr>");
                            echo ("<td data-id=".$bidon["id"]." id='bidon_".$bidon["id"]."'>".$bidon["id"]."</td>");
                            echo ("<td data-id=".$bidon["id"]." id='litros_almacenados_".$bidon["id"]."'>".$bidon["litros_almacenados"]."</td>");
                            echo ("<td data-id=".$bidon["id"]." id='litros_max_".$bidon["id"]."'>".$bidon["litros_max"]."</td>");
                            echo ("<td data-id=".$bidon["id"]." id='variedad_".$bidon["id"]."'>".$bidon["variedad"]."</td>");
                            if ($bidon["eco"] == 1){
                                echo ("<td data-id=".$bidon["id"]."><span class='fas fa-leaf'></span></td>");
                            } else {
                                echo ("<td  data-id=".$bidon["id"]."><span class='fas fa-times'></span></td>");
                            }
                            echo ("</tr>");
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>