<?php
namespace dataInsert ;

function data_insert($inputArray){
    $i = 0;
    $csvFile = fopen("output.csv", "w");
    $newfileEntry = 'TITLE' . ";" .
        'DESCRIPTION' . ";" .
        'VERSION' .  ";" .
        'CREATION' . ";" .
        'UPDATE' . "\n";
        fwrite($csvFile, $newfileEntry, strlen($newfileEntry));
    
    foreach ($inputArray as $key => $value) {
      //  echo "{$key} => \n";
        $preferredVersion=$value["preferred"];
      //  echo $preferredVersion . "\n";
        
        $selectedVersion = $value["versions"][$preferredVersion];
        // $value est de nouveau un associative array
        $createdEntry = (isset($selectedVersion["added"])?$selectedVersion["added"]:"");
        // $createdEntry = $selectedVersion["added"];
        $versionName = (isset($selectedVersion["info"]["contact"]["name"])?$selectedVersion["info"]["contact"]["name"]:"");
        // $versionName = $selectedVersion["info"]["contact"]["name"];
        $versionDescription = (isset($selectedVersion["info"]["description"])? substr($selectedVersion["info"]["description"], 0,50):"");
        // $versionDescription = substr($selectedVersion["info"]["description"], 0,50);
        $versionTitle = (isset($selectedVersion["info"]["title"])?$selectedVersion["info"]["title"]:"");
        // $versionTitle = $selectedVersion["info"]["title"];
        $versionUpdate = (isset($selectedVersion["updated"])?$selectedVersion["updated"]:"");
        // $versionUpdate = $selectedVersion["updated"];
        
        /*
        echo "Ce que l'on veut = " . $versionTitle. ";" . 
            $versionDescription . ";" .
            $versionName .  ";" .
            $createdEntry . ";" .
            $versionUpdate . "\n";
      
            
        echo "Les dates à convertir = " . 
            $createdEntry . "  ;  " .
            $versionUpdate . "\n";
            // 2017-03-15T14:45:58.000Z
            //(d-m-Y H:i:s)
         
        */   
            $myNewCreatedEntryDatetime = date("d-m-Y H:i:s", strtotime($createdEntry));
            $myNewVersionUpdate = date("d-m-Y H:i:s", strtotime($versionUpdate));
            
            $newfileEntry = '"' . $versionTitle.'"'.  ";" .
                '"'. $versionDescription . '"' . ";" .
                '"'. $versionName . '"' .  ";" .
                $myNewCreatedEntryDatetime . ";" .
                $myNewVersionUpdate . "\n";
            
            // echo $newfileEntry;
            
            fwrite($csvFile, $newfileEntry, strlen($newfileEntry));
            
            
            // Le \ devant DateTime en dessous est nécessaire car DateTime est dans le global namespace alors que le fichier dans lequel on est utilise un namespace spécifique.
            
            
            
           /* $format = 'd-m-Y H:i:s';
       $myCreatedEntryDatetime = \DateTime::createFromFormat('Y-m-d\TH:i:s:u\Z', $createdEntry);
       $myNewCreatedEntryDatetime = $myCreatedEntryDatetime->format($format);
       echo $myNewCreatedEntryDatetime . "\n";*/
            
        /*  
        
        
        $i++;
        if ($i==2){
            die(0);
        };
        */
    }
}