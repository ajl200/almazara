  <script>
   $(document).ready(function (){
        $("#enlace_estadisticas").toggleClass('active');
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
    ["City", "Cantidad"],

  <?php
    foreach ($localidades as $row) {
  ?>

    [<?="'".$row['city']."'"?>, <?=$row['cantidad']?>],

  <?php
    }
  ?>

  ]);
  console.log(data);

      var options = {
        region: 'ES',
        displayMode: 'markers',
        colorAxis: {colors: ['green', 'blue']}
      };

      var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    };
</script>
<div class="row">
  <div class="col-md-1"> </div>
  <div class="col-md-10"> 
    <div id="chart_div"></div>
  </div>
  <div class="col-md-1"> </div>
</div>
<div class="row">
            <div class="col-md-12 botones">
                        
            </div>
    </div>

    <div class="row">
            <div class="col-md-12">
                <table id='tabla_proveedores' class="table table-hover ">
                  <thead>
                          <th scope="col">Ranking</th>
                          <th scope="col">Localidad</th>
                          <th scope="col">Cantidad Aportada</th>
                  </thead>
                  <tbody>
                  <?php
                      for ($i = 0 ; $i < count($localidades) ; $i++){
                        $localidad = $localidades[$i];                         
                          echo ("<tr>");
                          $rank = $i+1;
                          echo ("<td>".$rank."º</td>");
                          echo ("<td  data-id=".$localidad["id"]." id='localidad_".$localidad["id"]."'>".$localidad["city"]."</td>");
                          echo ("<td  data-id=".$localidad["id"]." id='cantidad_".$localidad["id"]."'>".$localidad["cantidad"]."</td>");
                          echo ("</tr>");
                      }
                      
                  ?>
                  </tbody>
              </table>
            </div>
      </div>


