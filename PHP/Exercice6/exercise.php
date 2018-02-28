<?php
function easterReverse ($filename){
    
   $myResource = fopen($filename, 'r+');
   $fileLength = filesize($filename);
   $fileContent = fread($myResource, $fileLength);
   
   $positionInFile = floor(strlen($fileContent) / 2);
   

   
   $firstPart = substr($fileContent, 0, $positionInFile);
   $secondPart = strrev(substr($fileContent, $positionInFile, $fileLength-$positionInFile));
   
   // echo ("firstpart = $firstPart" . "\n\n\n");
   // echo ("secondpart = $secondPart\n\n\n");
   
   fseek ($myResource, $positionInFile, SEEK_SET);
   fwrite($myResource, $secondPart, strlen($secondPart));
   
   fclose($myResource);
   
}