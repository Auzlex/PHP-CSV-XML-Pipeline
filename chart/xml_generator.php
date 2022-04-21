<?php

    // define the header of the file so that it is treated as xml
    header('Content-Type: application/xml');

    // define php flags
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 300);
    ini_set('auto_detect_line_endings', true);

    // get the root of the website
    $root = $_SERVER['DOCUMENT_ROOT'];

    // function called when we want to validate input
    function ValidateInput( $arg )
    {
        // check if the given argument is not empty and set
        return ( !empty($arg) && isset($arg) );
    }

    $file_name = NULL; // the target file name

    if(isset($_GET["fname"]))   // validate input
        $file_name = $_GET["fname"];   // used to determine this scripts indexing mode

    if(!ValidateInput($file_name))
    {
        // return http response code bad request
        http_response_code(400);
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
            return;
        }

        // read the xml file from given file name
        $xml = simplexml_load_file($target_file);

        // format as XML
        $xml = $xml->asXML();
        
        // echo the XML to the page
        echo $xml; // this will then be a php that dynamically creates a xml file
        
    }

?>
