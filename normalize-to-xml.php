<?php

    // set the php flags
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 300);
    ini_set('auto_detect_line_endings', true);

    //time stamp the execution start time of this script
    $time_start = microtime(true); 

    // look in the root directory of this script and find files with data-*.csv
    $files = glob("data-*.csv");

    // for each file open it and read it
    foreach ($files as &$file_name) {

        // make sure the file name is not data-unknown
        if($file_name == "data-unknown.csv") 
        {
            // due to the previous extract-to-csv.php it can generate an unknown file
            // which we want to ignore
            continue;
        }

        // use SPL to read in the file information
        $file = new SplFileObject($file_name, "r");
        $header = NULL; // this will store the header information from the first line of the CSV
        $i = 0; // used to track lines

        // create a new instance of XMLWriter
        $writer = new XMLWriter();

        // openRI to export data to
        $file_name = str_replace(".csv", ".xml", $file_name);
        $writer->openURI($file_name);

        // set the format of the XML file
        $writer->setIndent(true);

        // set indent string to tab
        $writer->setIndentString("\t");

        // start the document, ensure encoding is UTF-8
        $writer->startDocument('1.0', 'UTF-8');

        // write root element
        $writer->startElement('station');

        // while the file is not at the end
        while (!$file->eof()) 
        {
            $i++; // increment line count
     
            // get the current line data
            $line = $file->fgets();
            
            // trim it, and then check if its empty
            if (empty(trim($line))) {
                // skips the current iteration if line is empty
                continue;
            }
                
            // separate the csv line into an array
            $columns = explode(",", $line);
            
            if ($i == 2) // if we are on the second line only
            {
                // write attributes, because we now have data to do so
                $writer->writeAttribute('id', $columns[0]); // site id
                $writer->writeAttribute('name', $columns[14]); // site name
                $writer->writeAttribute('geocode', trim($columns[15]) . "," . trim($columns[16]) ); // site lat, long
            }

            if($i == 1) // if we are on the first line only
            {
                $header = $columns; // cache the header information
            }
            else // for every other line than the first
            {
                // only write the record if it contains the required indexes
                if ( ( !empty(trim($columns[2])) || !empty(trim($columns[11])) ) && ( !empty(trim($columns[3])) ) )
                {
                    // start a new element rec
                    $writer->startElement('rec');

                    // for loop that iterates between 2nd and the 13th column
                    for ($j = 1; $j < 14; $j++) {

                        // if the column is empty, skip it
                        if (empty(trim($columns[$j]))) 
                        {
                            continue;
                        }

                        // automatically write attribute with their assigned header name and associated value
                        $writer->writeAttribute(strtolower($header[$j]), $columns[$j]);
                    }
        
                    // close the element
                    $writer->endElement();
                }
            }
        }

        // // echo the xml lines read
        // echo "<p>SplFileObject -> finished reading $file_name with $i lines</p>";

        // end element
        $writer->endElement();

    }

    // time stamp of code execution time at the end of this script
    $time_end = microtime(true);

    //dividing with 60 will give the execution time in minutes otherwise seconds
    $execution_time = ($time_end - $time_start);

    // output execution time of the script
    echo '<b>Total Execution Time:</b> '.$execution_time.' seconds';
?>