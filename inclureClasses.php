<?php
function inclureClasses($className){
    if(file_exists($fichier=__DIR__.'/'.$className.'php')){
     return $fichier;
    }
    spl_autoload_register('inclureClasses');

    
}
?>