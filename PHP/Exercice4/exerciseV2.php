<?php
function getAllMondaysOfMonth ($myYear, $myMonth){
    
    $startingDate = mktime(0,0,0,$myMonth, 1, $myYear);
    $endingDate = strtotime('last day of this month', $startingDate);

    echo ("starting date = $startingDate");
    echo ("ending date = $endingDate");
    
    for ($i = $startingDate; $i <= $endingDate; $i += 86400){
        $jour = date ('N', $i);
        if ($jour == 1){
            echo "lundi" . "\n";
            $myDate = date ("l j, M Y", $i);
            echo $myDate . "\n";
            $result[] = $myDate;
        }
        
    }
    var_dump($result);
    return $result;
    
}





