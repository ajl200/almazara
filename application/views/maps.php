  <script>
   $(document).ready(function (){
        $("#enlace_estadisticas").toggleClass('active');
        $(".alert").delay(4000).fadeOut();


    });
var ar = <?php echo json_encode($localidades) ?>;
console.log(ar[0]);
     google.charts.load('current', {
       'packages': ['geochart'],
       // Note: you will need to get a mapsApiKey for your project.
       // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
       
     });
     google.charts.setOnLoadCallback(drawMarkersMap);

    function drawMarkersMap() {
      var data = google.visualization.arrayToDataTable(ar);

      var options = {
        region: 'ES',
        displayMode: 'markers',
        colorAxis: {colors: ['green', 'blue']}
      };

      var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    };
</script>

<table id='tabla_proveedores' class="table table-hover ">
                    <thead>
                    </thead>
                    <tbody>
                    <?php
                        for ($i = 0 ; $i < count($localidades) ; $i++){
                            $localidad = $localidades[$i];
                            echo ("<tr>");
                            echo ("<td  data-id=".$localidad["id"]." id='id_".$localidad["id"]."'>".$localidad["id"]."</td>");
                            echo ("<td  data-id=".$localidad["id"]." id='localidad_".$localidad["id"]."'>".$localidad["City"]."</td>");
                            echo ("<td  data-id=".$localidad["id"]." id='cantidad_".$localidad["id"]."'>".$localidad["Cantidad"]."</td>");
                            echo ("</tr>");
                        }
                    ?>
                    </tbody>
                </table>

