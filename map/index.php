<!-- <!DOCTYPE html> -->
<html>
<head>

  <!-- import css -->
  <link rel="stylesheet" href="css/main.css">

  <!-- import google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <!-- import leaflet map -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

  <!-- import jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

  <h2 id="title" style="margin-bottom: 0px;">INDEXING ALL STATION RECORDS</h2>
  <h4 id="subtitle" style="margin-bottom: 0px; margin-top: 0px;">PLEASE WAIT...</h4>

  </br>

  <div id="pollutant_selection" style="background-color: var(--tertiary-color); padding: 15px; color: var(--secondary-color); display: none;">

    <!-- pollutant table -->
    <table border="0" cellpadding="2" cellspacing="0" style="border-left: 1px solid rgb(51, 51, 51); border-top: 1px solid rgb(51, 51, 51); margin: 1em 0px; padding: 0px; border-right-style: initial; border-bottom-style: initial; border-right-color: initial; border-bottom-color: initial; border-image: url('') initial; font-weight: normal; font-style: normal; font-size: 12.8px; vertical-align: baseline; border-collapse: separate; border-spacing: 0px; color: rgb(0, 0, 0); font-family: verdana, geneva, sans-serif; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); border-right-width: 0px; border-bottom-width: 0px;" width="100%">
        <tbody style="margin: 0px; padding: 0px; border: 0px; font-weight: inherit; font-style: inherit; font-size: 12.8px; vertical-align: baseline;">
          <tr style="margin: 0px; padding: 0px; border: 0px; font-weight: inherit; font-style: inherit; font-size: 12.8px; vertical-align: baseline;">
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);" width="80">Index</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">1</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">2</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">3</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">4</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">5</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">6</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">7</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">8</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">9</th>
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">10</th>
          </tr>
          <tr style="margin: 0px; padding: 0px; border: 0px; font-weight: inherit; font-style: inherit; font-size: 12.8px; vertical-align: baseline;">
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">Band</th>
            <td class="bg_low1" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(156, 255, 156); border-left-width: 0px; border-top-width: 0px;">Low</td>
            <td class="bg_low2" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(49, 255, 0); border-left-width: 0px; border-top-width: 0px;">Low</td>
            <td class="bg_low3" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(34, 34, 34); background-color: rgb(49, 207, 0); border-left-width: 0px; border-top-width: 0px;">Low</td>
            <td class="bg_moderate4" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(255, 255, 0); border-left-width: 0px; border-top-width: 0px;">Moderate</td>
            <td class="bg_moderate5" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(255, 207, 0); border-left-width: 0px; border-top-width: 0px;">Moderate</td>
            <td class="bg_moderate6" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(34, 34, 34); background-color: rgb(255, 154, 0); border-left-width: 0px; border-top-width: 0px;">Moderate</td>
            <td class="bg_high7" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(255, 100, 100); border-left-width: 0px; border-top-width: 0px;">High</td>
            <td class="bg_high8" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(255, 255, 255); background-color: rgb(255, 0, 0); border-left-width: 0px; border-top-width: 0px;">High</td>
            <td class="bg_high9" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(255, 255, 255); background-color: rgb(153, 0, 0); border-left-width: 0px; border-top-width: 0px;">High</td>
            <td class="bg_very_high10" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(255, 255, 255); background-color: rgb(206, 48, 255); border-left-width: 0px; border-top-width: 0px;">Very High</td>
          </tr>
          <tr style="margin: 0px; padding: 0px; border: 0px; font-weight: inherit; font-style: inherit; font-size: 12.8px; vertical-align: baseline;">
            <th style="margin: 0px; padding: 3px; border: 0px; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; background-color: rgb(1, 53, 103); color: rgb(255, 255, 255);">Âµg/mÂ³</th>
            <td class="bg_low1" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(156, 255, 156); border-left-width: 0px; border-top-width: 0px;">0-67</td>
            <td class="bg_low2" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(49, 255, 0); border-left-width: 0px; border-top-width: 0px;">68-134</td>
            <td class="bg_low3" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(34, 34, 34); background-color: rgb(49, 207, 0); border-left-width: 0px; border-top-width: 0px;">135-200</td>
            <td class="bg_moderate4" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(255, 255, 0); border-left-width: 0px; border-top-width: 0px;">201-267</td>
            <td class="bg_moderate5" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(255, 207, 0); border-left-width: 0px; border-top-width: 0px;">268-334</td>
            <td class="bg_moderate6" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(34, 34, 34); background-color: rgb(255, 154, 0); border-left-width: 0px; border-top-width: 0px;">335-400</td>
            <td class="bg_high7" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(0, 0, 0); background-color: rgb(255, 100, 100); border-left-width: 0px; border-top-width: 0px;">401-467</td>
            <td class="bg_high8" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(255, 255, 255); background-color: rgb(255, 0, 0); border-left-width: 0px; border-top-width: 0px;">468-534</td>
            <td class="bg_high9" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(255, 255, 255); background-color: rgb(153, 0, 0); border-left-width: 0px; border-top-width: 0px;">535-600</td>
            <td class="bg_very_high10" style="border-right: 1px solid rgb(51, 51, 51); border-bottom: 1px solid rgb(51, 51, 51); margin: 0px; padding: 2px 4px; border-top-style: initial; border-left-style: initial; border-top-color: initial; border-left-color: initial; border-image: url('') initial; font-weight: bold; font-style: inherit; font-size: 12.8px; vertical-align: top; text-align: left; line-height: normal; color: rgb(255, 255, 255); background-color: rgb(206, 48, 255); border-left-width: 0px; border-top-width: 0px;">601 or more</td>
          </tr>
        </tbody>
    </table>
    
    <!-- SELECTION pollutants -->
    <label for="nox">View Pollutants:</label>

    <input type="checkbox" id="nox" name="nox" value="nox">
    <label for="nox">NOX</label>

    <input type="checkbox" id="no" name="no" value="no">
    <label for="no">NO</label>

    <input type="checkbox" id="no2" name="no2" value="no2">
    <label for="no2">NO2</label>

    </br></br>

    <!-- SELECTION YEAR -->
    <label for="fname">Select Year:</label>
    <select name="years" id="year">
    </select>

    <!-- SELECTION TIME -->
    <label for="fname">Select Time:</label>
    <select name="times" id="time">
    </select>

    <!-- SELECTION MONTH -->
    <label for="fname">Select Month:</label>
    <select name="months" id="month">
    </select>

    </br>

  </div>

  </br>

  <!-- map container -->
  <div id="map" style="width:100%; height:70%;"></div>
    
  <!-- SELECTION javascript -->
  <script>

    // Creating map options
    var mapOptions = {
    center: [51.4527, -2.5978],
    zoom: 12
    }
    
    // Creating a map object
    var map = new L.map("map", mapOptions);
    
    var layerGroup = L.layerGroup().addTo(map);

    // Creating a Layer object
    //var layer = new L.TileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png");
    var layer = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
      maxZoom: 20,
      attribution: '© <a href="https://stadiamaps.com/">Stadia Maps</a>, © <a href="https://openmaptiles.org/">OpenMapTiles</a> © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
    });
    
    // Adding layer to the map
    map.addLayer(layer);

    // stores all the pollution data
    var pollutant_data = [];

  </script>

  <?php 

  //date_default_timezone_get("GMT");
  ini_set('memory_limit', '512M');
  ini_set('max_execution_time', 300);
  ini_set('auto_detect_line_endings', true);

  // get the root of the website
  $root = $_SERVER['DOCUMENT_ROOT'];

  // look in the root directory of this script and find files with data-*.xml
  $files = glob($root . "/data-*.xml");

  $stations_found = 0;
  $valid_files = array();
  $ts = null;

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

      // this value will count the dates found
      $dates_found = 0;

      // check if the dates between the range 2015-01-01 to 2019-12-31
      $startDate = date('Y-m-d', strtotime("2015-01-01"));
      $endDate = date('Y-m-d', strtotime("2019-12-31"));

      // perform an xpath that gets data between the specified ranges
      $valid_records = $xml->xpath("//station/rec[( @ts >= " . strtotime("2015-01-01") . " ) and ( @ts <= " . strtotime("2019-12-31") . " )]");

      // for every valid records
      foreach ($valid_records as &$valid_record) {

        // get the timestamp
        $timestamp = $valid_record->attributes()->ts;

        // get the pollutant values
        $nox = $valid_record->attributes()->nox;
        $no = $valid_record->attributes()->no;
        $no2 = $valid_record->attributes()->no2;

        // append to pollutant_data javascript
        echo "<script>pollutant_data.push([" . $timestamp . ", [" . $station_geo . " ] ," . $nox . "," . $no . "," . $no2 . "]);</script>";

      }

      // $dates_found is greater than zero
      if(count($valid_records) > 0)
      {
        // remove the extension from the file name
        $file_name = str_replace(".xml", "", $file_name);

        // remove data- from the file name
        $file_name = str_replace("data-", "", $file_name);

        // append option using javascript via echo
        echo "<script>
                $('#file').append('<option value=\"$file_name\">$file_name - $station_name</option>');
              </script>";

        $stations_found += 1;
        
        // add file name to valid_files array
        array_push($valid_files, $file_name);

        // https://stackoverflow.com/questions/34775308/leaflet-how-to-add-a-text-label-to-a-custom-marker-icon
        // https://github.com/Leaflet/Leaflet.label

        // split $station_geo into lat and long
        $station_geo_split = explode(",", $station_geo);

        // creates a marker for this station if its valid
        echo '
          <script>
          L.circleMarker([' . floatval( $station_geo_split[0] ) . ', ' . floatval( $station_geo_split[1] ) . '], {radius: 5, color:"#BBBBBB" }).addTo(map).bindTooltip("' . $file_name . " - " .  $station_name .'",{permanent: true, direction: "right"});
          </script>
        ';

      }

    }
  }

  // convert valid_files array to javascript via echo
  echo "<script>
          var valid_files = " . json_encode($valid_files) . ";
        </script>";
  
  ?>

  <script>

    // this function is called once to only fetch the selection query drop downs
    function update_selection_query()
    {
    
      // clear the element with id years of options
      $("#year").html("");

      // clear the element with id time of options
      $("#time").html("");

      // array of unique hours
      var unique_hours = [];

      // array of unique years
      var unique_years = [];

      // array of unique months
      var unique_months = [];

      // ts is a list of unix times as ints
      // for every ts element parse as new Date() and append any unique hours and years to their respective arrays
      for (var i = 0; i < pollutant_data.length; i++)
      {
        // convert the timestamp to a date
        var ts_date = new Date(pollutant_data[i][0] * 1000);

        // if the date is not between 2015-01-01 to 2019-12-31 continue
        if ((ts_date < new Date(2015, 1, 1)) || (ts_date > new Date(2019, 12, 31)))
        {
          continue;
        }

        // get the year
        var ts_year = ts_date.getFullYear();

        // get the hour
        var ts_hour = ts_date.getHours();

        // get the month
        var ts_month = ts_date.getMonth();

        // append the time to unique_times
        if(unique_hours.indexOf(ts_hour) == -1)
        {
          unique_hours.push(ts_hour);
        }

        // append the year to unique_years
        if(unique_years.indexOf(ts_year) == -1)
        {
          unique_years.push(ts_year);
        }

        // append the month to unique_months
        if(unique_months.indexOf(ts_month) == -1)
        {
          unique_months.push(ts_month);
        }

      }
      
      // sort the years from highest to lowest
      unique_years.sort(function(a, b){return b-a});

      // sort the times from lowest to highest
      unique_hours.sort(function(a, b){return a-b});

      // sort the months from lowest to highest
      unique_months.sort(function(a, b){return a-b});

      // console.log the unique hours and years
      //console.log(unique_hours);
      //console.log(unique_years);
      //console.log(unique_months);

      // for every year
      for(var i = 0; i < unique_years.length; i++)
      {
        // add an option to the element with id years of options
        $("#year").append("<option value='" + unique_years[i] + "'>" + unique_years[i] + "</option>");
      }

      // for every time
      for(var i = 0; i < unique_hours.length; i++)
      {
        // add an option to the element with id time of options
        if ((unique_hours[i]).toString().length == 1 ) {
          $("#time").append("<option value='" + unique_hours[i] + "'>" + new Date('1970-01-01T' + "0"+unique_hours[i] + ":00:00" + '').toLocaleTimeString("en-UK", { hour: '2-digit', minute: '2-digit', hour12: false }) + "</option>");
        }
        else
        {

          $("#time").append("<option value='" + unique_hours[i] + "'>" + new Date('1970-01-01T' + unique_hours[i] + ":00:00" + '').toLocaleTimeString("en-UK", { hour: '2-digit', minute: '2-digit', hour12: false }) + "</option>");
        }
      }

      var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      // for every month
      for(var i = 0; i < unique_months.length; i++)
      {
        // add an option to the element with id months of options
        $("#month").append("<option value='" + unique_months[i] + "'>" + months[unique_months[i]] + "</option>");
      }

      $("#title").html("Bristol Pollution Monitoring Stations".toUpperCase());
      // replace the inner contents of the element "subtitle"
      $("#subtitle").html("Successfully loaded <?php echo $stations_found; ?> stations records".toUpperCase());

      // check if #pollutant_selection is display none
      if($("#pollutant_selection").css("display") == "none")
      {
        // show the pollutant_selection fade in
        $("#pollutant_selection").fadeIn(1000);
      }
    
    }

    update_selection_query(); 

    function traverse_and_fetch_pollutant_records()
    {
      // get the values of the checkboxes nox, no, no2 as boolean
      var nox = document.getElementById("nox").checked;
      var no = document.getElementById("no").checked;
      var no2 = document.getElementById("no2").checked;

      // grab time and year from the selection query drop downs
      var time = $("#time").val();
      var year = $("#year").val();
      var month = $("#month").val();

      // if none of them are selected return
      if(!nox && !no && !no2)
      {
        alert("Please select pollutants to fetch data from!")
        return;
      }

      // remove all the markers in one go
      layerGroup.clearLayers();

      // disable the fetch button and checkboxes
      $('#nox').prop('disabled', true);
      $('#no').prop('disabled', true);
      $('#no2').prop('disabled', true);
      $("#year").prop('disabled', true);
      $("#time").prop('disabled', true);
      $("#month").prop('disabled', true);

      //console.log(valid_files);

      var ajax_array = [];

      var quarters = [
          { low: 0, high: 67, colour: "9CFF9C" }, 
          { low: 86, high: 134, colour: "31FF00" }, 
          { low: 135, high: 200, colour: "31CF00" }, 
          { low: 201, high: 267, colour: "FFFF00" },
          { low: 268, high: 334, colour: "FFCF00" },
          { low: 335, high: 400, colour: "FF9A00" },
          { low: 401, high: 467, colour: "FF6464" },
          { low: 468, high: 534, colour: "FF0000" },
          { low: 535, high: 600, colour: "990000" },
          { low: 601, high: Infinity, colour: "CE30FF" },
      ];

      function find_colour_code(value) {
        // return the colour code for the pollutant if the value lands between range in the quarters array
        for (var i = 0; i < quarters.length; i++) {
          if (value >= quarters[i].low && value <= quarters[i].high) {
            return quarters[i].colour;
          }
        }
      }

      //console.log(find_colour_code(134))

      // update the html title with records being processed
      $("#title").html(("Working...").toUpperCase() ); // replace the inner contents of the element "title"
      $("#subtitle").html("Please standby... filtering records...".toUpperCase() ); // replace the inner contents of the element "subtitle"

      // for every record in the pollutant_data array console.log
      for (var i = 0; i < pollutant_data.length; i++) 
      {
        // 0                    1                     2             3             4
        //[" . $timestamp . "," . $station_geo . "," . $nox . "," . $no . "," . $no2 . "]

        
        // convert the date time to a date object
        var record_date = new Date(parseInt(pollutant_data[i][0]) * 1000);

        //console.log(pollutant_data[i], parseInt(year), parseInt(time), record_date.getFullYear(), record_date.getHours());

        // check if the record_date matches the year and time
        if(record_date.getFullYear() == parseInt(year) && record_date.getHours() == parseInt(time) && record_date.getMonth() == month )
        {
          // if we are looking for nox only records
          if(nox)
          {
            // get the nox value of the record
            var nox_value = parseFloat(pollutant_data[i][2]);

            // add to the map if the nox is not empty
            if(nox_value > 0)
            {
              // add a circle to the map to show pollution data
              var circle = L.circle([ pollutant_data[i][1][0],  pollutant_data[i][1][1] ], {radius: nox_value, stroke:false, fillOpacity: 0.1, fillColor: "#" + find_colour_code(nox_value)} ).addTo(layerGroup);//.bindTooltip("NOx: " + nox_value);
              circle.bindTooltip("NOx: " + nox_value, {permanent: false, offset: [nox_value/2, 0] })

            }

          }

          // if we are looking for nox only records
          if(no)
          {
            // get the nox value of the record
            var no_value = parseFloat(pollutant_data[i][3]);

            // add to the map if the nox is not empty
            if(no_value > 0)
            {
              var circle = L.circle([ pollutant_data[i][1][0],  pollutant_data[i][1][1] ], {radius: no_value, stroke:false, fillOpacity: 0.1, fillColor: "#" + find_colour_code(no_value)} ).addTo(layerGroup);
              circle.bindTooltip("NO: " + nox_value, {permanent: false, offset: [no_value/2, 0] })
            }

          }

          // if we are looking for nox only records
          if(no2)
          {
            // get the nox value of the record
            var no2_value = parseFloat(pollutant_data[i][4]);

            // add to the map if the nox is not empty
            if(no2_value > 0)
            {
              var circle = L.circle([ pollutant_data[i][1][0],  pollutant_data[i][1][1] ], {radius: no2_value, stroke:false, fillOpacity: 0.1, fillColor: "#" + find_colour_code(no2_value)} ).addTo(layerGroup);
              circle.bindTooltip("NO2: " + nox_value, {permanent: false, offset: [no2_value/2, 0] })
            }

          }
        }
      }

      // enable the fetch button and checkboxes
      $('#nox').prop('disabled', false);
      $('#no').prop('disabled', false);
      $('#no2').prop('disabled', false);
      $("#year").prop('disabled', false);
      $("#time").prop('disabled', false);
      $("#month").prop('disabled', false);

      $("#title").html("Bristol Pollution Monitoring Stations".toUpperCase());
      // replace the inner contents of the element "subtitle"
      $("#subtitle").html("Successfully loaded <?php echo $stations_found; ?> stations records".toUpperCase());

    }

    function update_map()
    {
      traverse_and_fetch_pollutant_records();
    }


    // on change of select year and time
    document.getElementById("year").addEventListener("change", update_map);
    document.getElementById("time").addEventListener("change", update_map);
    document.getElementById("month").addEventListener("change", update_map);

    // on change of select pollutant
    document.getElementById("nox").addEventListener("change", update_map);
    document.getElementById("no").addEventListener("change", update_map);
    document.getElementById("no2").addEventListener("change", update_map);

  </script>  
</body>
</html>
