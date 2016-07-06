<?php

class Grabber {
    
    static public function saveEnglishAudio($string, $output, $path, $lang = "en"){

        Path::preparePath($path);
        $fullPath = $path . $output;
        $string = urlencode($string);
//        $cmd = "curl 'http://api.naturalreaders.com/v2/tts/?t={{$string}}&r=1&s=1&requesttoken=5a6546725e5fcaa9f7ecfdddda2455fd' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Accept-Language: en-US,en;q=0.8,ru;q=0.6' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8' -H 'Cache-Control: max-age=0' -H 'Cookie: ys=mailchrome.2.8.0' -H 'Connection: keep-alive' --compressed > {$fullPath}.mp3";
        $cmd = "curl 'http://www.voicerss.org/controls/speech.ashx?hl=en-us&src={$string}&c=mp3' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Accept-Language: en-US,en;q=0.8,ru;q=0.6' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8' -H 'Cache-Control: max-age=0' -H 'Cookie: ys=mailchrome.2.8.0' -H 'Connection: keep-alive' --compressed > {$fullPath}.mp3";
//error_log($cmd);
        shell_exec($cmd);

    }

    static public function saveRussianAudio($string, $output, $path, $lang = "en"){
        Path::preparePath($path);
        $fullPath = $path . $output;
        $string = urlencode($string);
        $cmd = "curl 'https://tts.voicetech.yandex.net/generate?text={$string}&format=mp3&lang=ru-RU&speaker=jane&key=abddee50-afb2-4a9a-bd0d-3c266c7bc976' -H 'Accept-Encoding: gzip,deflate,sdch' -H 'Accept-Language: en-US,en;q=0.8,ru;q=0.6' -H 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.122 Safari/537.36' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8' -H 'Cache-Control: max-age=0' -H 'Cookie: ys=mailchrome.2.8.0' -H 'Connection: keep-alive' --compressed > {$fullPath}.mp3";
//error_log($cmd);
        shell_exec($cmd);
    }

    static public function saveAll($strings = array(), $output){

        //Скачивание английского слова
        if(isset($strings["word"])){
            self::saveEnglishAudio($strings["word"], $output, MY_SOUNDS_USER_WORD_PATH, "en");
        }
        
        //Скачивание перевода английского слова
        if(isset($strings["translate"])){
            self::saveRussianAudio($strings["translate"], $output, MY_SOUNDS_USER_TRANSLATE_PATH, "ru");
        }

        //Скачивание английской фразы
        if(isset($strings["phrase"])){
            self::saveEnglishAudio($strings["phrase"], $output, MY_SOUNDS_USER_PHRASE_PATH, "en");
        }

        //Скачивание перевода английской фразы
        if(isset($strings["phraseTranslate"])){
            self::saveRussianAudio($strings["phraseTranslate"], $output, MY_SOUNDS_USER_TRPHRASE_PATH, "ru");
        }
    }
}
