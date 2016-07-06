<?php

class Merger {
    
    static public $pause = 2;
    
    static public function downloadFile($ids, $isPlain = true){

        if(empty($ids))return false;

        $resultFileName = self::getResultFileName();
        $silencePauseFile = MY_SOUNDS_SILENCE_PATH . self::$pause . ".mp3";
        shell_exec("rm -r {$resultFileName}");

        $plnCmd = "mp3wrap {$resultFileName}";
        $revCmd = "mp3wrap {$resultFileName}";
        foreach($ids as $id){

            $file = $id . ".mp3";

            $word = "";
            if(is_file(MY_SOUNDS_USER_WORD_PATH . $file) && is_readable(MY_SOUNDS_USER_WORD_PATH . $file)){
                $word = MY_SOUNDS_USER_WORD_PATH . $file;
            }

            $translate = "";
            if(is_file(MY_SOUNDS_USER_TRANSLATE_PATH . $file) && is_readable(MY_SOUNDS_USER_TRANSLATE_PATH . $file)){
                $translate = MY_SOUNDS_USER_TRANSLATE_PATH . $file;
            }

            $phrase = "";
            if(is_file(MY_SOUNDS_USER_PHRASE_PATH . $file) && is_readable(MY_SOUNDS_USER_PHRASE_PATH . $file)){
                $phrase = MY_SOUNDS_USER_PHRASE_PATH . $file;
            }

            $translatePhrase = "";
            if(is_file(MY_SOUNDS_USER_TRPHRASE_PATH . $file) && is_readable(MY_SOUNDS_USER_TRPHRASE_PATH . $file)){
                $translatePhrase = MY_SOUNDS_USER_TRPHRASE_PATH . $file;
            }

            $plnCmd .= " {$word} {$silencePauseFile} {$word} {$silencePauseFile} {$translate} {$silencePauseFile} {$phrase} {$silencePauseFile} {$translatePhrase} {$silencePauseFile}";
            $revCmd .= " {$translate} {$silencePauseFile} {$translatePhrase} {$silencePauseFile} {$word} {$silencePauseFile} {$phrase} {$silencePauseFile} {$silencePauseFile}";
        }

        if($isPlain){
            shell_exec($plnCmd);
        }
        else{
            shell_exec($revCmd);
        }
        shell_exec("mv " . self::getMp3wrapFileName() . " " . self::getResultFileName());

        self::download();
    }
    
    static public function getResultFileName(){
        return MY_SOUNDS_USER_PATH . "result.mp3";
    }

    static public function getMp3wrapFileName(){
        return MY_SOUNDS_USER_PATH . "result_MP3WRAP.mp3";
    }

    static public function download(){

        $resultFileName = self::getResultFileName();
        if (file_exists($resultFileName)) {
            header('Content-Description: File Transfer');
            header('Content-Type: audio/mpeg');
            header('Content-Disposition: attachment; filename='.basename($resultFileName));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($resultFileName));
            readfile($resultFileName);
            die();
        }
    }
}
