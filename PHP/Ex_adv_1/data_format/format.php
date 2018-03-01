<?php
namespace dataFormat;

function data_format($jsonInput){
    return json_decode( $jsonInput,true);
}
