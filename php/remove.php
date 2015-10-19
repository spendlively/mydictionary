<?php

require_once 'bootstrap.php';

$idsParam = isset($_REQUEST['ids']) ? $_REQUEST['ids'] : '';

$ids = array();
if($idsParam){
    $idsParam = json_decode($idsParam);
}
//var_dump($idsParam);die();
if(!empty($idsParam)){
    foreach($idsParam as $id){
        $id = (int)$id;
        Db::query("DELETE FROM words WHERE id = {$id}");
    }
}
else{
    echo json_encode(array('result' => false));
    die();
}

echo json_encode(array('result' => true));
die();
