<?php
//para la parte de los mensajes
function mensaje_mostrar($tipo, $mensaje){
    return array(
        'tipo'=>$tipo,
        'mensaje'=>$mensaje
    );
}

use Hashids\Hashids;
//rodry
function encriptar($id){
    $encriptado = new Hashids('eyJpdiI6Im42S3d0MzZwSlc2ZWZjOXlVTlZ4YXc9PSIsInZhbHVlIjoia1hmN08vNE9nUFRWcXR6a3E3YTNHZz09IiwibWFjIjoiZTEzOTVhY2NmNzljZTQ0OGQ0YzVkZmIxM2Q3MmJiYTU0NmUxZTVlZDEzNjhjNjBiZWY5MGE3MTRjZGNmZjUwYyIsInRhZyI6IiJ9', 15);
    $id1 = $encriptado->encodeHex($id);
    return $id1;
}


function desencriptar($id){
    $encriptado = new Hashids('eyJpdiI6Im42S3d0MzZwSlc2ZWZjOXlVTlZ4YXc9PSIsInZhbHVlIjoia1hmN08vNE9nUFRWcXR6a3E3YTNHZz09IiwibWFjIjoiZTEzOTVhY2NmNzljZTQ0OGQ0YzVkZmIxM2Q3MmJiYTU0NmUxZTVlZDEzNjhjNjBiZWY5MGE3MTRjZGNmZjUwYyIsInRhZyI6IiJ9', 15);
    $id1 = $encriptado->decodeHex($id);
    return $id1;
}
