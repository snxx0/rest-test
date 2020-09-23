<?php
$lineas = file('.env');
$claves = ['TFM_SEG_GLOB','TFM_SEG_GET','TFM_SEG_POST','TFM_SEG_PUT','TFM_SEG_DEL','TFM_SEG_UP'];

foreach($lineas as $linea) {
    $tmp = explode('=', $linea);
    if($tmp[0]=='APP_DEBUG') 
        $linea = 'APP_DEBUG=' . (mt_rand(0,10) > 5 ? 'true' : 'false') . "\n"; // 50%
    if($tmp[0]=='APP_AUTH') 
        $linea = 'APP_AUTH=' . (mt_rand(1,3) == 2 ? 'false' : 'true') . "\n"; // 33%
    if(in_array($tmp[0], $claves)) {
        $linea = $tmp[0] . "=" . mt_rand(1,10) . "\n";
    }
}

file_put_contents('.env', $result);