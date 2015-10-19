<?php

require_once 'bootstrap.php';

$idsParam = isset($_REQUEST['ids']) ? $_REQUEST['ids'] : '';
$isPlain = isset($_REQUEST['plain']) && $_REQUEST['plain'] === 'false' ? false : true;

$ids = array();
if($idsParam){
    $idsParam = json_decode($idsParam);
}

if(!empty($idsParam)){
    foreach($idsParam as $id){
        $ids[] = (int)$id;
    }
}
else{
    die();
}

Merger::downloadFile($ids, $isPlain);
//var_dump($ids);
//header($string)
