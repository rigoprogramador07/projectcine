<?php
function log_past($log)
{   
    if (!file_exists('log.txt')){
        file_put_contents('log.txt', '');
    }
    date_default_timezone_set('America/Mexico_City');
    $time = date('Y-m-d h:i:A', time());

    $contents = file_get_contents('log.txt');
    $contents .= "$time\t Descripcion: $log\r\n";

    file_put_contents('log.txt', $contents);
    
}
?>