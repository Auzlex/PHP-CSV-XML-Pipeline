
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
      //google.charts.load('current', {'packages':['corechart']});
      
      var records = null;

      function toMonthName(monthNumber) {
        const date = new Date();
        date.setMonth(monthNumber - 1);

        return date.toLocaleString('en-US', {
          month: 'long',
        });
      }

      //google.charts.setOnLoadCallback(update_selection_query);
      function traverse_and_fetch_records()
      {

        if(records == null)
        {
          alert("Please select a file to view");
          return;
        }

        var year = document.getElementById("year").value;
        var time = document.getElementById("time").value;

        console.log(year, time);
        
        // get the last selected month
        var last_month = 0;
        var data = []; // empty array to store the data
        var current_month_average = 0;

        // for every records
        for(var i = 0; i < records.length; i++)
        {
          // fetch time stamp attribute
          var timestamp = records[i].getAttribute("ts");

          // convert time stamp into date, make sure its parsed as int
          var date = new Date(parseFloat(timestamp) * 1000); // javascript handles in ms not s

          // check if the date and hours match selected year and time
          if(date.getFullYear() == year && date.getHours() == time)
          {
            
            // fetch carbon monoxide value
            var value = records[i].getAttribute("no");

            // average a list of values to the month changes
            var month = date.getMonth();
          
            // append the month number with value
            data.push([parseInt(month), parseFloat(value), timestamp]);
          }
          
        }
        // sort the data by month number lowest to high
        data.sort(function(a, b) {
          return a[0] - b[0];
        });

        console.log(data);

        var calculated_data = [];

        sum = 0;
        count = 0;

        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        current_month = 0;
        // for all of the data
        for(var i = 0; i < data.length; i++)
        {
          if(data[i][0] == current_month)
          {
            sum += data[i][1];
            count += 1;
          }
          else if( data[i][0] != current_month )
          {
            // calculate average
            current_month_average = sum / count;
            calculated_data.push([current_month, current_month_average]);
            console.log(current_month_average, months[current_month], sum, count);
            
            sum = 0;
            count = 0;
            
            current_month = data[i][0];

            sum += data[i][1];
            count += 1;

          }
        }

        console.log(calculated_data);

        // console.log(sum, count, sum/count);

        // // for all the data calculate each months average and append to the calculated_data array
        // for(var i = 0; i < data.length; i++)
        // {
        //   // if the month is different from the last month
        //   if(data[i][0] != last_month)
        //   {
        //     // if the last month is not 0
        //     if(last_month != 0)
        //     {
        //       // calculate the average of the last month
        //       var average = current_month_average / i;

        //       console.log(average, i)

        //       // append the average to the calculated_data array
        //       calculated_data.push([last_month, average]);
        //     }

        //     // reset the current month average
        //     current_month_average = 0;
        //   }

        //   // add the value to the current month average
        //   current_month_average += data[i][1];

        //   // set the last month to the current month
        //   last_month = data[i][0];
        // }


        // insert an empty array into calculated_data array at the start
        //calculated_data.unshift(["Month", "Average NO"]);

        data_array = [
          
            ["Month", "NO"],
          
        ]

        
        // for every calculated_data push into data_array
        // NOTE: if the charts are displaying the wrong data, it might be because OF THIS FUNCTION
        // WARNING
        // WARNING
        // WARNING
        // WARNING
        // WARNING

        function find_month_in_calculated_data(current_month)
        {
          for(var i = 0; i < calculated_data.length; i++)
          {
            if(calculated_data[i][0] == current_month)
            {
              return calculated_data[i];
            }
          }

          return -1;
        }

        for(var i = 0; i < 12; i++)
        {
          var data = find_month_in_calculated_data(i)

          //check if calculated_data has the month
          if(data != -1)
          {
            //console.log(calculated_data[i][0], toMonthName(calculated_data[i][0]));
            data_array.push([months[data[0]], data[1]]);
          }
          else
          {
            // append an empty array to the data_array
            data_array.push([ months[i], 0 ]);
          }
        }

        // draw the chart
        draw_chart(
          data_array
        );

      }

      function update_selection_query(data) 
      {

        // data is an xml document object
        var xml = data;

        // set active xml to the xml document
        active_xml = xml;

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
        records = root.getElementsByTagName("rec"); // get all records under the root

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
            $("#time").append("<option value='" + times[i] + "'>" + new Date('1970-01-01T' + "0"+times[i] + ":00:00" + '').toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false }) + "</option>");
          }
          else
          {

            $("#time").append("<option value='" + times[i] + "'>" + new Date('1970-01-01T' + times[i] + ":00:00" + '').toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false }) + "</option>");
          }
        }

        //console.log(dates);
        //console.log(times);

        // fetch time information
        traverse_and_fetch_records();
      }

      function draw_chart(pre_computed_data)
      {

        // load google charts
        google.charts.load('current', {
          packages: ['corechart'],
          language: 'nl'
        }).then(function () {

          // format data for google charts
          var data = google.visualization.arrayToDataTable(pre_computed_data);

          // format month
          var formatMonth = new google.visualization.DateFormat({
            pattern: 'MMM yyyy'
          });

          formatMonth.format(data, 0);

          /// https://developers.google.com/chart/interactive/docs/points
          // options for the chart
          var options = {
            'title':'Average Carbon Monoxide (NO) per month',
            'titleTextStyle': { 'fontSize': 11 },
            'width':640,
            'height':240,
            'legend': { 'position':'bottom' },
            vAxis: {title: 'Carbon Monoxide', minValue: 0, maxValue: 10},
            'series': {"0":{"color":"66aabb"},"1":{"color":"66ddee"},"3":{"color":"e8f8ff"},"2":{"color":"bbeeff"}},
            'chartArea': { 'width': '90%', 'left': 60, 'right': 20 },
            'bar': { 'groupWidth': '80%' },
            'isStacked':true
          };

          // generate scatter chart
          var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        });
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

        // replace the inner contents of the element "title"
        $("#title").html("Fetching information...");
        // replace the inner contents of the element "subtitle"
        $("#subtitle").html("Please standby...");

        // perform an ajax request to the server
        $.ajax({
          url: "xml_generator.php?fname=" + file,
          type: "POST",
          success: function(data) {
            // update selection query data
            update_selection_query(data);
          },
          error: function(data) 
          {
            // console log why we failed to get data
            console.log("Error: " + data);

            // replace the inner contents of the element "title"
            $("#title").html("ERROR: Failed to get data");
            // replace the inner contents of the element "subtitle"
            $("#subtitle").html("Error message: " + data);
          }
        });

      }

      // on change of select year and time
      document.getElementById("year").addEventListener("change", traverse_and_fetch_records);
      document.getElementById("time").addEventListener("change", traverse_and_fetch_records);

    </script>

    <!-- scatter chart -->
    <div id="chart_div" style="width: 900px; height: 500px;"></div>

    <!-- line chart -->
    <div id="chart_div2" style="width: 900px; height: 500px;"></div>

  </body>
</html>
