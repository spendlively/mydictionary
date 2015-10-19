<?php

require_once 'bootstrap.php';

$rows = Db::select_all("SELECT * FROM words ORDER BY TS DESC");
$data = array();
//echo "<pre>";
//print_r($rows);
//echo "</pre>";
//die();
if(!empty($rows)){
    foreach($rows as $row){
        $data[] = array(
            "id" => $row['ID'], 
            "word" => $row['WORD'], 
            "translate" => $row['TRANS_WORD'],
            "phrase" => $row['PHRASE'],
            "translatePhrase" => $row['TRANS_PHRASE'],
            "time" => $row['TS'],
        );
    }
}

echo json_encode($data);
die();
