
<?php 

  //date_default_timezone_get("GMT");
  ini_set('memory_limit', '512M');
  ini_set('max_execution_time', 300);
  ini_set('auto_detect_line_endings', true);

  // get the root of the website
  $root = $_SERVER['DOCUMENT_ROOT'];

  // look in the root directory of this script and find files with data-*.xml
  $files = glob($root . "/data-*.xml");

?>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      
      //google.charts.setOnLoadCallback(drawChart);

      function drawChart(data) 
      {

        // data is an xml document object
        var xml = data;

        var root = xml.getElementsByTagName("station")[0]; // get the root of the xml document
        var station_name = root.getAttribute("name"); // get the name of the station
        var station_geo = root.getAttribute("geocode"); // get the geo location of the station

        $("#title").html(station_name); // replace the inner contents of the element "title"
        $("#subtitle").html("Location GPS: " + station_geo); // replace the inner contents of the element "subtitle"

        // TODO: We need to generate 2 charts
        // 1: A scatter chart to show a years worth of data (averaged by month) 
        // from a specific station 
        // for Carbon Monoxide (NO) at a certain time of day - say 08.00 hours.

        // generate a list of years from unix time stamp from elements inside the root xml element
        var dates = []; // stores dates
        var times = []; // stores times
        var records = root.getElementsByTagName("rec"); // get all records under the root

        // clear the element with id years of options
        $("#year").html("");

        // clear the element with id time of options
        $("#time").html("");

        // for every records
        for(var i = 0; i < records.length; i++)
        {
          // fetch time stamp attribute
          var timestamp = records[i].getAttribute("ts");

          // convert time stamp into date, make sure its parsed as int
          var date = new Date(parseFloat(timestamp) * 1000); // javascript handles in ms not s

          // check if the date already exists in dates array
          if(dates.indexOf(date.getFullYear()) == -1)
          {
            // if not, add it to the dates array
            dates.push(date.getFullYear());
          }
          
          // check if the time already exists in times array
          if(times.indexOf(date.getHours()) == -1)
          {
            // if not, add it to the times array
            times.push(date.getHours());
          }
        }

        // sort the years highest to lowest
        dates.sort(function(a, b){return b-a});

        // sort the times lowest to highest
        times.sort(function(a, b){return a-b});

        // for every year
        for(var i = 0; i < dates.length; i++)
        {
          // add an option to the element with id years of options
          $("#year").append("<option value='" + dates[i] + "'>" + dates[i] + "</option>");
        }

        // for every time
        for(var i = 0; i < times.length; i++)
        {
          // add an option to the element with id time of options
          if ((times[i]).toString().length == 1 ) {
            $("#time").append("<option value='" + times[i] + "'>" + new Date('1970-01-01T' + "0"+times[i] + ":00:00" + 'Z').toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false }) + "</option>");
          }
          else
          {

            $("#time").append("<option value='" + times[i] + "'>" + new Date('1970-01-01T' + times[i] + ":00:00" + 'Z').toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false }) + "</option>");
          }
        }

        console.log(dates);
        console.log(times);
      
        // extract year from unix timestamp


        // 2: A line chart showing levels in any 24 hour period on any day (user selectable) for any of the six stations (user selectable) for any of the major pollutants (nox, no, no2) in the date range downloaded.

        // print the station name and geo location
        // document.write("<h1>" + station_name + "</h1>");
        // document.write("<h2>" + station_geo + "</h2>");

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

    <label for="fname">Selection Station:</label>
    <select name="files" id="file">
      <option value='none'>--</option>
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
      
    <!-- SELECTION YEAR -->
    <label for="fname">Select Year:</label>
    <select name="years" id="year">
    </select>

    <!-- SELECTION TIME -->
    <label for="fname">Select Time:</label>
    <select name="times" id="time">
    </select>

    <!-- title and subtitle of station -->
    <br>
    <h2 id="title" style="margin-bottom: 0px;"></h2>
    <h3 id="subtitle" style="margin-bottom: 0px; margin-top: 0px;"></h3>

    <!-- SELECTION javascript -->
    <script>
      // on change of the file select
      document.getElementById("file").onchange = function() {
        // get the selected file
        var file = document.getElementById("file").value;

        // if the file is not none
        if (file == "none") {
          // replace the inner contents of the element "title"
          $("#title").html("Please select a valid station");
          // replace the inner contents of the element "subtitle"
          $("#subtitle").html("...");
          return;
        }

        console.log("Selected file: " + file);

        // replace the inner contents of the element "title"
        $("#title").html("Fetching information...");
        // replace the inner contents of the element "subtitle"
        $("#subtitle").html("Please standby...");

        // perform an ajax request to the server
        $.ajax({
          url: "xml_generator.php?fname=" + file,
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
