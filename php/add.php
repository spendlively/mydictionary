<?php

require_once 'bootstrap.php';


$word = isset($_REQUEST['word']) ? trim($_REQUEST['word']) : null;
$word = preg_replace("@\\\*@ui", "", $word);
$translate = isset($_REQUEST['translate']) ? trim($_REQUEST['translate']) : null;
$translate = preg_replace("@\\\*@ui", "", $translate);
$phrase = isset($_REQUEST['phrase']) ? trim($_REQUEST['phrase']) : null;
$phrase = preg_replace("@\\\*@ui", "", $phrase);
$phraseTranslate = isset($_REQUEST['phraseTranslate']) ? trim($_REQUEST['phraseTranslate']) : null;
$phraseTranslate = preg_replace("@\\\*@ui", "", $phraseTranslate);

if(!$word || !$translate || !$phrase || !$phraseTranslate){
    echo '';die();
}

$id = (int)Db::select('SELECT MAX(id) FROM words');
$id++;

$pdo = Db::getPdo();
$insert = "
    INSERT INTO words 
    (id, word, trans_word, phrase, trans_phrase)
    VALUES
    (:id,:word,:trans_word,:phrase,:trans_phrase)
";

try {
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();
    $sth = $pdo->prepare($insert);
    $sth->bindParam(':id', $id);
    $sth->bindParam(':word', $word);
    $sth->bindParam(':trans_word', $translate);
    $sth->bindParam(':phrase', $phrase);
    $sth->bindParam(':trans_phrase', $phraseTranslate);
    $result = $sth->execute();
    $pdo->commit();
} catch (\Exception $e) {
    $pdo->rollBack();
    var_dump($e->getMessage());die();
}

Grabber::saveAll(array(
    "word" => $word,
    "translate" => $translate,
    "phrase" => $phrase,
    "phraseTranslate" => $phraseTranslate,
), $id);

echo json_encode(array('result' => true));die();
