<?php

require_once 'bootstrap.php';

$phraseTranslate = 'Hello everybody';
$output = "test";
$lang = "en";

Grabber::saveAudio($phraseTranslate, $output, $lang);

var_dump($url);die();
echo json_encode($response);
