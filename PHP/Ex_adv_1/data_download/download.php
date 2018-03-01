<?php
namespace dataDownload;

function data_download (){
    $resource = fopen('https://api.apis.guru/v2/list.json', "r");
    $content = "";
    
    do {
    $content .= fread($resource, 1);
    } while (! feof($resource));
    
    
    return $content;
}