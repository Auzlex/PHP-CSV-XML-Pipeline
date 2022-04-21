
<?php 

  //date_default_timezone_get("GMT");
  ini_set('memory_limit', '512M');
  ini_set('max_execution_time', 300);
  ini_set('auto_detect_line_endings', true);

  // get the root of the website
  $root = $_SERVER['DOCUMENT_ROOT'];

  // look in the root directory of this script and find files with data-*.xml
  $files = glob($root . "/data-*.xml");

  // function that reads a given xml file path
  function read_xml_file($file_path) {
    echo "Reading file: " . $file_path . "<br>";
    $xml = simplexml_load_file($file_path);
    return $xml;
  }

  $xml_data = read_xml_file($files[0]);

?>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      //google.charts.setOnLoadCallback(drawChart);

      function drawChart(data) {

        // data is an xml document object
        var xml = data;

        // get the root of the xml document
        var root = xml.getElementsByTagName("station")[0];

        // get the name of the station
        var station_name = root.getAttribute("name");
        
        // get the geo location of the station
        var station_geo = root.getAttribute("geo");

        // print the station name and geo location
        //document.write("<h1>" + station_name + "</h1>");
        //document.write("<h2>" + station_geo + "</h2>");

        // // print the first child of the root
        // //console.log(root.childNodes[0]);
      
        // // using jquery xpath get all the rec nodes that have the time at 8AM
        // var rec_nodes = $(xml).find("rec[time='8:00:00']");

        // console.log(rec_nodes);

        // var data = google.visualization.arrayToDataTable([
        //   ['Time', 'Nox'],

        //   <?php
        //     // $i = 0;
        //     // foreach ($xml_data->children() as $child) {

        //     //   if ($i > 200)
        //     //   {
        //     //     break;
        //     //   }

        //     //   $i = $i + 1;


        //     //   // convert $child->attributes()->ts to int
        //     //   $ts = intval($child->attributes()->ts);
        //     //   // convert unix time to human readable time
        //     //   $time = date("Y-m-d H:i:s", $ts );

        //     //   // echo nox value from xml children
        //     //   echo "['" . $time . "', " . $child->attributes()->nox . "],\n";

        //     //   // echo "['" . $child->getName() . "', " . $child->attributes()->value . "],";
        //     // }
        //   ?>

        //   // [ 8,      12],
        //   // [ 4,      5.5],
        //   // [ 11,     14],
        //   // [ 4,      5],
        //   // [ 3,      3.5],
        //   // [ 6.5,    7]
        // ]);

        // var options = {
        //   title: 'Time vs. Nox comparison',
        //   hAxis: {title: 'TS'},//, minValue: 0, maxValue: 15},
        //   vAxis: {title: 'NOX'},//, minValue: 0, maxValue: 15},
        //   legend: 'none'
        // };

        // var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        // chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <select name="files" id="file">
      <?php
        // for each file
        foreach ($files as &$file_name) {

          // remove the directory from the file name
          $file_name = str_replace($root . "/", "", $file_name);

          // remove the extension from the file name
          $file_name = str_replace(".xml", "", $file_name);

          // remove data- from the file name
          $file_name = str_replace("data-", "", $file_name);

          // create a html option
          echo "<option value='$file_name'>$file_name</option>";

        }
      ?>
    </select>
    <script>
      // on change of the file select
      document.getElementById("file").onchange = function() {
        // get the selected file
        var file = document.getElementById("file").value;

        console.log("Selected file: " + file);

        // perform an ajax request to the server
        $.ajax({
          url: "chart_data_fetcher.php?fname=" + file,
          type: "POST",
          success: function(data) {
            console.log("Success: " + data);

            // invoke draw chart but pass in the data which is an xml document object
            drawChart(data);

          },
          error: function(data) {
            console.log("Error: " + data);
          }
        });

      }
    </script>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
