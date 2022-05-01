# Advance Topics In Web Development: Critical Report On Methodology, Tools Utilized For Document Processing.

## Document Processing A: Extract to CSV

In processing the **air-quality-data-2004-2019.csv** utilization of PHP was crucial in breaking this file down into smaller files. 

The `extract-to-csv.php` reads in the `air-quality-data-2004-2019.csv` using an SPL file object, this class offers an object-oriented interface for a file. This class provides multiple different functions that we can utilize.

The PHP file iterates over the contents of the file using the **EOF function**. This function is placed within a while loop and will continue to run until it reaches the end of the file. This will ensure that this PHP file will read the entire contents of our CSV. While reading every line the function `fgets` is used to get to the contents of the line. We then check the line to see if it contains content by using the trim and empty functions given to us within PHP if it is empty, we skip the line.

Once the line has been validated, we explode it using the delimiter `;` this then converts the line that has been read, into columns or an array of the contents split by the specified delimiter. We use this array to organise and filter out unnecessary data using the array slice function. At the end of all the array slicing, we then merge these arrays together.

Upon writing to a file, we cache the target site ID that the record needs to be written to. If the site ID data file does not exist, we create a new data file to track the file pointer and write in the data. If it does exist already, we append to the file. At the end of the process all file pointers are closed.

## Document Processing B:  Normalize to XML:

...

## Google Charts: Extending Usage & Enhancing Visualisation

Sample Text

## Educational Attainment: 

Sample Text