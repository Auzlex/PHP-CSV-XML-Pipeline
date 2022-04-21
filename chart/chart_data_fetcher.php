<?php

    header('Content-Type: application/xml');
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 300);
    ini_set('auto_detect_line_endings', true);

    //place this before any script you want to calculate time
    //$time_start = microtime(true); 

    // get the root of the website
    $root = $_SERVER['DOCUMENT_ROOT'];

    // function called when we want to validate input
    function ValidateInput( $arg )
    {
        // check if the given argument is not empty and set
        return ( !empty($arg) && isset($arg) );
    }

    $file_name = NULL;

    if(isset($_GET["fname"]))   // validate input
        $file_name = $_GET["fname"];   // used to determine this scripts indexing mode

    if(!ValidateInput($file_name))
    {
        // return http response code bad request
        http_response_code(400);

        //echo "Invalid input";
        return;
    }
    else
    {

        $target_file = $root . "/data-" . $file_name . ".xml";

        // validate if file exists
        if(!file_exists($target_file))
        {
            // return http response code bad request
            http_response_code(400);

            //echo "File does not exist";

            return;
        }

        // read the xml file from given file name
        $xml = simplexml_load_file($target_file);

        $xml = $xml->asXML();
        
        //echo '<root>';    
        echo $xml;#htmlspecialchars($xml);
        //echo '</root>';
        
        //echo htmlspecialchars($xml);

        //echo "Reading file: " . $target_file . "<br>";
        // read the xml file
        
        // load target xml file
        //$xml = simplexml_load_file($target_file);

        //echo $xml;
        
        //$xml_data = simplexml_load_string($xml);
        //echo $xml_data;

        // echo number of children
        //echo "Number of children: " . count($xml_data->children()) . "<br>";
    }



    // // end time
    // $time_end = microtime(true);

    // //dividing with 60 will give the execution time in minutes otherwise seconds
    // $execution_time = ($time_end - $time_start);

    //execution time of the script
    //echo '<b>Total Execution Time:</b> '.$execution_time.' seconds';

?>
