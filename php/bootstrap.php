<?php

if(!headers_sent()){
    header('Content-Type: text/html; charset=utf8');
}

require_once 'Db.php';
require_once 'Path.php';
require_once 'Grabber.php';
require_once 'Merger.php';

define('MY_USER_NAME', 'spendlively');
define('MY_ROOT_PATH', dirname(__DIR__));
define('MY_PHP_PATH', dirname(__DIR__). '/php/');
define('MY_SOUNDS_PATH', dirname(__DIR__) . '/sounds/');
define('MY_SOUNDS_SILENCE_PATH', dirname(__DIR__) . '/sounds/silence/');
define('MY_SOUNDS_USER_PATH', dirname(__DIR__) . '/sounds/' . MY_USER_NAME . '/');
define('MY_SOUNDS_USER_WORD_PATH', MY_SOUNDS_USER_PATH . 'words/');
define('MY_SOUNDS_USER_TRANSLATE_PATH', MY_SOUNDS_USER_PATH . 'translate/');
define('MY_SOUNDS_USER_PHRASE_PATH', MY_SOUNDS_USER_PATH . 'phrase/');
define('MY_SOUNDS_USER_TRPHRASE_PATH', MY_SOUNDS_USER_PATH . 'trphrase/');

//var_dump(MY_SOUNDS_PATH);die();
