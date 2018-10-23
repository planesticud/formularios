<?php
$nombre_fichero = $_GET["nombre"];
//rename ("encuentro", "desactivadoencuentro");
if (file_exists($nombre_fichero)) {
    
    rename ($nombre_fichero, "aa11bbccdesactivado". $nombre_fichero);
    echo "El fichero $nombre_fichero quedo desactivado";
} else {
    
    $nombre_fichero_desactivado = "aa11bbccdesactivado". $nombre_fichero;
    if (file_exists($nombre_fichero_desactivado)) {
    rename ( "aa11bbccdesactivado". $nombre_fichero ,$nombre_fichero);
    echo "El fichero $nombre_fichero quedo activado";
    }
}
?>