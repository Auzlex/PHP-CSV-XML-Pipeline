
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
<!DOCTYPE html>
<html>
  <head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- import css -->
    <link rel="stylesheet" href="css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // TODO: Restrict the years

      var xml = null;
      var records = null;

      function find_month_in_calculated_data(calculated_data, current_month)
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

      function traverse_and_fetch_carbon_monoxide_records()
      {

        if(records == null)
        {
          alert("Please select a file to view");
          return;
        }

        var year = document.getElementById("year").value;
        var time = document.getElementById("time").value;

        //console.log(year, time);
        
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

        //console.log(data);

        var calculated_data = [];

        sum = 0;
        count = 0;

        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        current_month = 0;
        // for all of the data
        for(var i = 0; i < data.length; i++)
        {
          //console.log(current_month)
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
            //console.log(current_month_average, months[current_month], sum, count);
            
            sum = 0;
            count = 0;
            
            current_month = data[i][0];

            sum += data[i][1];
            count += 1;

          }

          // if last element in the data well then calculate it
          if (i == data.length - 1)
          {
            current_month_average = sum / count;
            calculated_data.push([current_month, current_month_average]);
            //console.log(current_month_average, months[current_month], sum, count);
          }
        }

        //console.log(calculated_data);

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
        for(var i = 0; i < 12; i++)
        {
          var data = find_month_in_calculated_data(calculated_data, i)

          //check if calculated_data has the month
          if(data != -1)
          {
            data_array.push([months[data[0]], data[1]]);
          }
          else
          {
            // append an empty array to the data_array
            data_array.push([ months[i], 0 ]);
          }
        }

        // draw the chart
        draw_scatter_chart(
          data_array
        );

      }

      function traverse_and_fetch_pollutant_records()
      {
        //
        if(records == null)
        {
          alert("Please select a file to view");
          return;
        }

        // get the values of the checkboxes nox, no, no2 as boolean
        var nox = document.getElementById("nox").checked;
        var no = document.getElementById("no").checked;
        var no2 = document.getElementById("no2").checked;

        // get the date value selection_date
        var selection_date = document.getElementById("selection_date").value;

        // output all the values console.log
        console.log(nox, no, no2, selection_date);

        // check if selection_date is empty
        if(selection_date == "")
        {
          return;
        }

        // if none of them are selected return
        if(!nox && !no && !no2)
        {
          return;
        }

        // convert the selection date string into date
        var converted_date = new Date(selection_date);

        var searched_data = [];

        // for every record
        for(var i = 0; i < records.length; i++)
        {
          // fetch time stamp attribute
          var timestamp = records[i].getAttribute("ts");

          // convert time stamp into date, make sure its parsed as int
          var date = new Date(parseFloat(timestamp) * 1000); // javascript handles in ms not s

          // check if the date and hours match selected year and time
          if(date.getFullYear() == converted_date.getFullYear() && date.getMonth() == converted_date.getMonth() && date.getDate() == converted_date.getDate())
          {

            var temp_array = [];

            // // a loop x between 0 and 23 to find the hours
            // for(var x = 0; x < 24; x++)
            // {
            //   // check if the 
            // }
            // TODO: it seems the code already fetches 23 hours of data anyway with the given conditions above
            // but if it is glitched then I will need to make it check for the hours


            // get the hour of the record plus 1 to offset as java counts 0-23
            temp_array.push(date.getHours() + 1);

            // include the record if the checkbox is checked
            if(nox)
            {
              // push nox into temp_array
              temp_array.push(parseFloat(records[i].getAttribute("nox")));
            }

            if(no)
            {
              // push nox into temp_array
              temp_array.push(parseFloat(records[i].getAttribute("no")));
            }

            if(no2)
            {
              // push nox into temp_array
              temp_array.push(parseFloat(records[i].getAttribute("no2")));
            }

            // push the temp_array into searched_data
            searched_data.push(temp_array);

          } 
        }

        // sort the searched_data by first index (hours)
        searched_data.sort(function(a, b) {
          return a[0] - b[0];
        });

        // a line chart
        // selectable pollutants NOX, NO, NO2 only (by user)
        // shows 24 hours of data for selected day (by user)
        // from desired listening station
        // display for every hour get pollution of type NOX, NO, NO2

        //console.log(searched_data);

        var data_array = [
  
        ]

        var data_types = ["hour"];

        // include the record if the checkbox is checked
        if(nox)
        {
          // push nox into temp_array
          data_types.push("nox");
        }

        if(no)
        {
          // push nox into temp_array
          data_types.push("no");
        }

        if(no2)
        {
          // push nox into temp_array
          data_types.push("no2");
        }

        // push temp_array into data_array
        data_array.push(data_types);

        // for every element in searched_data push into data_array
        for(var i = 0; i < searched_data.length; i++)
        {
          data_array.push(searched_data[i]);
        }

        // merge searched_data into data_array
        //data_array.concat(searched_data);

        // draw the chart
        draw_line_chart(
          data_array
        );

      }

      function update_selection_query(data) 
      {

        // data is an xml document object
        xml = data;

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
        var fulldates = []; // stores full date
        records = root.getElementsByTagName("rec"); // get all records under the root

        // clear the element with id years of options
        $("#year").html("");

        // clear the element with id time of options
        $("#time").html("");

        // reset selection date value to nothing
        document.getElementById("selection_date").value = "";

        // reset the checkboxes to false
        document.getElementById("nox").checked = false;
        document.getElementById("no").checked = false;
        document.getElementById("no2").checked = false;

        // reset chart_div2 to be empty html
        $("#chart_div2").html("");

        // for every records
        for(var i = 0; i < records.length; i++)
        {
          // fetch time stamp attribute
          var timestamp = records[i].getAttribute("ts");

          // convert time stamp into date, make sure its parsed as int
          var date = new Date(parseFloat(timestamp) * 1000); // javascript handles in ms not s

          // if the date is not between 01/01/2015 to 31/12/2019 continue
          if(date.getFullYear() < 2015 || date.getFullYear() > 2019)
          {
            continue;
          }


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

          var month = date.getMonth() + 1;
          var day = date.getDate();

          if(month < 10)
              month = '0' + (month).toString();

          if(day < 10)
              day = '0' + day.toString();

          var dateformat = date.getFullYear() + "-" + month + "-" + day;


          // check if the full date already exists in fulldates array
          if(fulldates.indexOf(dateformat) == -1)
          {
            // if not, add it to the fulldates array
            fulldates.push(dateformat);
          }
        }

        // sort the years highest to lowest
        dates.sort(function(a, b){return b-a});

        // sort the times lowest to highest
        times.sort(function(a, b){return a-b});

        // sort the dates
        fulldates.sort(function(a, b) {
            var c = new Date(a);
            var d = new Date(b);
            return c-d;
        });

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

        // adjust the input date to min max of the dates array
        $("#selection_date").attr("min", fulldates[0]);
        $("#selection_date").attr("max", fulldates[fulldates.length - 1]);

        //console.log(fulldates)

        //console.log(dates);
        //console.log(times);

        // fetch time information
        traverse_and_fetch_carbon_monoxide_records();


       




        // TODO: for maps use open street maps



      }

      function draw_scatter_chart(pre_computed_data)
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

      function draw_line_chart(pre_computed_data)
      {
        console.log(pre_computed_data)

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
            'title':'Major Pollutants (NOX, NO, NO2) per hour for selected day',
            'titleTextStyle': { 'fontSize': 11 },
            'width':640,
            'height':240,
            'legend': { 'position':'bottom' },
            hAxis: {
              title:"Hour Of Day",
              // array from 0 to 23
              ticks: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]
            },
            vAxis: {title: 'Pollutant Intensity', minValue: 0},
            'series': {"0":{"color":"66aabb"},"1":{"color":"66ddee"},"3":{"color":"e8f8ff"},"2":{"color":"bbeeff"}},
            'chartArea': { 'width': '90%', 'left': 60, 'right': 20 },
            'bar': { 'groupWidth': '80%' },
            'isStacked':true
          };

          // generate scatter chart
          var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
          chart.draw(data, options);
        });
      }


    </script>
  </head>
  <body>

    <label for="fname">Selection Station:</label>
    <select name="files" id="file">
      <option id='loading_tick' value='none'>Validating XML files. Please Wait.</option>
      <?php

        // for each file
        foreach ($files as &$file_name) {

          // remove the directory from the file name
          $file_name = str_replace($root . "/", "", $file_name);

          // read the xml file 
          $xml = simplexml_load_file($root . "/" . $file_name);

          // check if the xml actually has data
          if ($xml) {

            // get the name of the station
            $station_name = $xml->attributes()->name;

            // get the geo location of the station
            $station_geo = $xml->attributes()->geocode;

            // perform xpath query on the xml to find all records timestamp values
            $ts = $xml->xpath("//station/rec/@ts");
          
            // this value will count the dates found
            $dates_found = 0;

            // check if the dates between the range 2015-01-01 to 2019-12-31
            $startDate = date('Y-m-d', strtotime("2015-01-01"));
            $endDate = date('Y-m-d', strtotime("2019-12-31"));

            foreach ($ts as $key => $value) 
            {
              // convert the timestamp to a date
              $ts_date = date('Y-m-d',intval($value));
            
              // check if ts date is between start date and end date
              if (($ts_date >= $startDate) && ($ts_date <= $endDate))
              {
                // increment the dates found within the range
                $dates_found += 1;
              }
            }

            // $dates_found is greater than zero
            if($dates_found > 0)
            {
              // remove the extension from the file name
              $file_name = str_replace(".xml", "", $file_name);

              // remove data- from the file name
              $file_name = str_replace("data-", "", $file_name);

              // create a html option
              echo "<option value='$file_name'>$file_name - $station_name</option>";
            }

          }
        }

        // echo javascript to rename the loading tick
        echo "<script>$('#loading_tick').html('--');</script>";
      ?>
    </select>

    <!-- title and subtitle of station -->
    <h2 id="title" style="margin-bottom: 0px;"></h2>
    <h4 id="subtitle" style="margin-bottom: 0px; margin-top: 0px;"></h4>

    </br>

    <!-- SELECTION YEAR -->
    <label for="fname">Select Year:</label>
    <select name="years" id="year">
    </select>

    <!-- SELECTION TIME -->
    <label for="fname">Select Time:</label>
    <select name="times" id="time">
    </select>

    <!-- scatter chart -->
    <div id="chart_div" style="width: 900px; height: 250px;  margin-top: 10px;"></div>

    <!-- date selection -->
    <label for="date">Select Day:</label>
    <input type="date" id="selection_date"/>

    <!-- SELECTION pollutant -->
    <label for="nox">Select Pollutants:</label>

    <input type="checkbox" id="nox" name="nox" value="nox">
    <label for="nox">NOX</label>

    <input type="checkbox" id="no" name="no" value="no">
    <label for="no">NO</label>

    <input type="checkbox" id="no2" name="no2" value="no2">
    <label for="no2">NO2</label>

    <!-- line chart -->
    <div id="chart_div2" style="width: 900px; height: 250px;  margin-top: 10px;"></div>

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
      document.getElementById("year").addEventListener("change", traverse_and_fetch_carbon_monoxide_records);
      document.getElementById("time").addEventListener("change", traverse_and_fetch_carbon_monoxide_records);

      // on change of select pollutant
      document.getElementById("nox").addEventListener("change", traverse_and_fetch_pollutant_records);
      document.getElementById("no").addEventListener("change", traverse_and_fetch_pollutant_records);
      document.getElementById("no2").addEventListener("change", traverse_and_fetch_pollutant_records);

      // on change of the date
      document.getElementById("selection_date").addEventListener("change", traverse_and_fetch_pollutant_records);

    </script>

  </body>
</html>
