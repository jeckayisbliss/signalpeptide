<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var datasa = 'test';
          jQuery.ajax({
            url: "controller/graphController.php",
            type: "post",
            async: false,
            data: {
              'func' : 'getData' 
            },
            success: function(datas){
              
              datasa = datas;
            }
          });
        // var data = google.visualization.arrayToDataTable
        // (datasa);
          var datasa1 = JSON.parse(datasa);
          //console.log("["+datasa1+"]");

        // var options = {
        //   title: 'Lengths of dinosaurs, in meters',
        //   legend: { position: 'none' },
        // };

        // var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
        // chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>