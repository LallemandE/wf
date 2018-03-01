<?php
require_once 'data_download\download.php';
require_once 'data_format\format.php';
require_once 'data_insert\insert.php';

use function dataDownload\data_download as dataDownload;
use function dataFormat\data_format as dataFormat;
use function dataInsert\data_insert as dataInsert;

dataDownload();

$downloadResult = dataDownload();

$formattedResult = dataFormat($downloadResult);

dataInsert($formattedResult);
// var_dump($formattedResult);

