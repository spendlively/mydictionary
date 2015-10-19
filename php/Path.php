<?php

class Path {
    
    static public function preparePath($path){
        
        if(!is_dir($path)){
            shell_exec("mkdir -m 777 -p {$path}");
        }
    }
}
