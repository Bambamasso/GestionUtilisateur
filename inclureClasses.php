<?php
function inclureClasses($className){
    if(file_exists($fichier=_DIR_.'/'.$className.'php')){
     return $fichier;
    }
    spl_autoload_register('inclureClasses');

    
}
?>