<?php

class Grabber {
    
    static public function saveAudio($string, $output, $path, $lang = "en"){
        
        Path::preparePath($path);
        $output .= ".mp3";
        $fullPath = $path . $output;
        $url = "http://translate.google.com/translate_tts?ie=UTF-8&tl={$lang}&q={$string}";
        $cmd = "wget -q -U Mozilla -O \"{$fullPath}\" \"{$url}\"";
        
        shell_exec($cmd);
    }
    
    static public function saveAll($strings = array(), $output){

        //Скачивание английского слова
        if(isset($strings["word"])){
            self::saveAudio($strings["word"], $output, MY_SOUNDS_USER_WORD_PATH, "en");
        }
        
        //Скачивание перевода английского слова
        if(isset($strings["translate"])){
            self::saveAudio($strings["translate"], $output, MY_SOUNDS_USER_TRANSLATE_PATH, "ru");
        }
        
        //Скачивание английской фразы
        if(isset($strings["phrase"])){
            self::saveAudio($strings["phrase"], $output, MY_SOUNDS_USER_PHRASE_PATH, "en");
        }
        
        //Скачивание перевода английской фразы
        if(isset($strings["phraseTranslate"])){
            self::saveAudio($strings["phraseTranslate"], $output, MY_SOUNDS_USER_TRPHRASE_PATH, "ru");
        }
    }
}
