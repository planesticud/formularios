<?php
$nombre_fichero = $_GET["nombre"];
//rename ("encuentro", "desactivadoencuentro");
if (file_exists($nombre_fichero)) {
    
    
    echo "Activo";
} else {
    
   
    if (file_exists("aa11bbccdesactivado". $nombre_fichero)) {
   
        echo "Inactivo";
    }
}
?>