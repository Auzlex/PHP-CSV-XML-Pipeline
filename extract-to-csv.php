
<!-- 
    This HTML code is simply here to allow tables to be displayed in the browser.
-->
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid;
}
</style>
</head>
<body>

<?php

    // set the php flags
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 300);
    ini_set('auto_detect_line_endings', true);

    //time stamp the execution start time of this script
    $time_start = microtime(true); 

    // use SPL to read in the air-quality-data-2004-2019.csv
    $file = new SplFileObject("air-quality-data-2004-2019.csv", "r");

    $i = 0; // line index counter
    $header = NULL; // header information is stored temporarily here
    $open_files = array();  // empty 2d array that contains file-pointers

    // function moveElement moves selected element to desired index position
    function moveElement(&$array, $a, $b) 
    {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);
    }
    
    // function is used to validate if 2 given indexes are valid and contain data within an array
    function validate_array_indexes($array, $x, $y)
    {
        // check if the given indexes are valid
        return !empty(trim($array[$x])) || !empty(trim($array[$y]));
    }

    // the indexes we want to make sure are included into a record
    // if a record does not contain these indexes, then it is skipped
    $index_validator_a = 2;
    $index_validator_b = 11;

    // the target indexes we want to extract site ID from the CSV
    $index_site_id_key = 4;

    // NOTE: performance code comparison can be found here https://grobmeier.solutions/performance-ofnonblocking-write-to-files-via-php-21082009.html
    // iterate over its contents of the file
    while (!$file->eof()) {
        $i++; // increment the counter

        // get the current line
        $line = $file->fgets();

        if (empty(trim($line))) {
            // skips the current iteration
            continue;
        }

        // separate the csv line into an array
        $columns = explode(";", $line);

        // trim array to only contain the first 14 columns
        $columns_sliced = array_slice($columns, 0, 14);
        
        // trim the array to for columns 18 and 19
        $columns_geo_location = array_slice($columns, 17, 2);

        // merge the two arrays
        $columns_merged = array_merge($columns_sliced, $columns_geo_location);

        // move the index 4 the start but preserve the original order
        moveElement($columns_merged, 4, 0);

        // target_site_id
        $target_site_id = "unknown";

        // this segment of code attempts to fetch the site id from the array columns to generate a file
        // if not found it will default to unknown
        if($columns[$index_site_id_key] ?? null) {
            $target_site_id = $columns[$index_site_id_key];
        }
        
        if($i == 1) // if index is the first line
        {
            // cache the header information from the first line read in
            $header = $columns_merged;
        }

        if ($i > 1) // if line is greater than 1
        {
            // using site id for every column append 
            $file_name = "data-". $target_site_id .".csv";

            // this will replace timestamp str to ts
            $columns_merged[1] = strtotime($columns_merged[1]);

            // check if this file name is already got an open file pointer
            if (array_key_exists( $target_site_id, $open_files )) 
            {
                // validate if the array indexes contain information before writing to the file
                if ( validate_array_indexes( $columns_merged, $index_validator_a, $index_validator_b ) ) {
                    fwrite($open_files[ $target_site_id ], implode(",", $columns_merged) . PHP_EOL);
                }
            } 
            else 
            {

                // since this is a new file pointer, create a new file and write the header
                $file_pointer = fopen( $file_name, "w");

                // modify the header to rename Date Time to ts and geo_point_2d to lat,long
                $str_edited = str_replace("Date Time", "ts", implode(",", $header));
                $str_edited = str_replace("geo_point_2d", "lat,long", $str_edited);
                $str_edited = strtolower($str_edited);
                
                // write teo file
                fwrite($file_pointer, $str_edited . "\n");

                // validate if the array indexes contain information before writing to the file
                if ( validate_array_indexes( $columns_merged, $index_validator_a, $index_validator_b ) ) {
                    fwrite($file_pointer,implode(",", $columns_merged) . "\n");
                }

                // append array to open_files array
                $open_files[ $target_site_id ] = $file_pointer;
            }
        }
    }

    // create another time stamp of the code execution
    $time_end = microtime(true); 
    
    // close all open file pointers
    foreach ($open_files as $val) {
        
        // delete the last line in the file
        //ftruncate($val, ftell($val) - 1); // this was to meet the line count because it for some reasons spawns an empty end of line character, increases execution time but it was needed to meet the spec
        
        // append the current line to the file pointer
        fclose($val);
    }
    
    //dividing with 60 will give the execution time in minutes otherwise seconds
    $execution_time = ($time_end - $time_start);

    // all file pointers have been closed
    echo "<p>All file pointers closed</p><br>";

    // echo the count of line
    echo "<p>". $i . " lines read</p><br>";
    
    //execution time of the script
    echo '<b>Total Execution Time:</b> '.$execution_time.' seconds';

?>


</body>
</html>