# Critical Report On Methodology, Tools Utilized For Document Processing.

## Document Processing A: Extract to CSV

In processing the **air-quality-data-2004-2019.csv** utilization of PHP was crucial in breaking this file down into smaller files. 

The `extract-to-csv.php` reads in the `air-quality-data-2004-2019.csv` using an SPL file object, this class offers an object-oriented interface for a file. This class provides multiple different functions that we can utilize.

The PHP file iterates over the contents of the file using the **EOF function**. This function is placed within a while loop and will continue to run until it reaches the end of the file. This will ensure that this PHP file will read the entire contents of our CSV. While reading every line the function `fgets` is used to get to the contents of the line. We then check the line to see if it contains content by using the trim and empty functions given to us within PHP if it is empty, we skip the line.

Once the line has been validated, we explode it using the delimiter `;` this then converts the line that has been read, into columns or an array of the contents split by the specified delimiter. We use this array to organise and filter out unnecessary data using the array slice function. At the end of all the array slicing, we then merge these arrays together.

Upon writing to a file, we cache the target site ID that the record needs to be written to. If the site ID data file does not exist, we create a new data file to track the file pointer and write in the data. If it does exist already, we append to the file. At the end of the process all file pointers are closed.

Small example of generated contents of `data-188.csv`:
```csv
siteid,ts,nox,no2,no,pm10,nvpm10,vpm10,nvpm2.5,pm2.5,vpm2.5,co,o3,so2,location,lat,long
188,1084518000,73.0,42.0,20.0,14.0,,,,,,0.2,38.0,3.0,AURN Bristol Centre,51.4572041156,-2.58564914143
188,1084528800,78.0,44.0,23.0,23.0,,,,,,0.1,52.0,3.0,AURN Bristol Centre,51.4572041156,-2.58564914143
188,1084539600,53.0,32.0,14.0,23.0,,,,,,0.2,56.0,3.0,AURN Bristol Centre,51.4572041156,-2.58564914143
```

## Document Processing B:  Normalize to XML:

The `normalize-to-xml.php` reads in all the cleansed and refactored csv files using glob function with the matching criteria `data-*.csv`. From the glob function is an array of files to be read. These csv files are then read in using the SPL file object one at a time. This PHP file creates an instance of a stream parser named `XMLWriter`, this is then used to generate XML content from the data. This PHP file utilises similar functions used within the `extract-to-csv.php` to obtain row and column data, this includes the usage of function explode using `,` delimiter instead as we have refactored and cleansed the data. The `XMLWriter` is instantiated with indenting set to **true** with and indenting string of `\t` and with document ending **UTF-8**. Attributes for each `<rec>` dom element are auto generated from the header excluding ID, name and geocode.

Small example of generated contents of `data-188.xml`:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<station id="188" name="AURN Bristol Centre" geocode="51.4572041156,-2.58564914143">
	<rec ts="1084518000" nox="73.0" no2="42.0" no="20.0" pm10="14.0" co="0.2" o3="38.0" so2="3.0"/>
	<rec ts="1084528800" nox="78.0" no2="44.0" no="23.0" pm10="23.0" co="0.1" o3="52.0" so2="3.0"/>
	<rec ts="1084539600" nox="53.0" no2="32.0" no="14.0" pm10="23.0" co="0.2" o3="56.0" so2="3.0"/>
</station>
```
DOM oriented parses will read an entire document and is very useful in reading small file sizes that are quick and easy to load, however when it comes to larger files such as this `air-quality-data-2004-2019.csv`, we simply could have a system that won’t have enough ram or processing capability to handle the entire file. In this case stream-oriented parses are handy to fetch data when we need it and nothing else, this is more efficient on memory. 

## Google Charts: Extending Usage & Enhancing Visualisation

The google chart component used to visualise the carbon monoxide and selectable major pollutants was separated into 2 charts. The chart visualisation of the data could have been compacted into a single chart with more user selectable parameters to change the view of the data. For example, a user slider could have been used to narrow the time selection to desired interval of hours, weeks, days, months. In addition, we could have also plotted all data from all the stations onto a single chart and made it so that we can view multiple station and major pollutants simultaneously with another selectable parameter. The chart data visualiser also does not take usage of the other data embedded within the XML files such as particle matter readings, air pressure, 03, concentration of SO2, and relative humidity. And a last change would be the ability for users to input an advance query using XSD schemer or some sort of xpath to allow users to narrow down on for stricter data searching.

## Educational Attainment: 

This assignment was an interesting challenge with difficulties and problems that had to be resolved with new additional knowledge. This section of the report will outline the learning outcomes achieved within this assignment.

The major skill acquired during this assignment is the awareness, usage, and now reliance of using xpath for indexing, searching, and filtering for specific desired data that has been normalized and refactored. Utilization of xpath for fetching data was more performant and faster than using javascript to filter the data from a provided xml file. Using ajax request worked for charts as the data was selective and thus only 1 xml document was required at a time. Xpath was crucial in getting the map visualisation to work as we have multiple stations of data to selection from. Another turning point within the assignment was avoiding the use of storing data within arrays because the csv files was too large for them to be handled within ram.

Xpath and XSD schemers has the potential to enforce data validation in various numerous ways and is a very adaptable and versatile means of enforcing validation on complex data structures as it uses DOM based elements to store data.

## Running Demo

You can find a running demo of the bristol city pollution monitoring stations [here][cedwards-php-pipeline-demo]:
The simple demo will process the large volumes normalized data into a viewable form. with selectable simple filters. So will take time to construct fully.

To add this was quite interesting implementing a proxy endpoint to hide the api key from the clientside javascript

[cedwards-php-pipeline-demo]: https://charlesedwards.dev/demos/PHP-CSV-XML-Pipeline/map/



