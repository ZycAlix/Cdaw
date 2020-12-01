<?php
class AutoLoader {

public function __construct() {
    spl_autoload_register( array($this, 'load') );
    // spl_autoload_register(array($this, 'loadComplete'));
}

// This method will be automatically executed by PHP whenever it encounters an unknown class name in the source code
private function load($className) {

    // TODO : compute path of the file to load (cf. PHP function is_readable)
    // it is in one of these subdirectory '/classes/', '/model/', '/controller/'
    // if it is a model, load its sql queries file too in sql/ directory
    $paths =  array('/classes/','/controller/','/model/');
    $fileToLoad = null;
    $i = 0;

    do{
        $fileToLoad = __ROOT_DIR . $paths[$i] . ucfirst($className) . '.class.php';
        $i++;
    } while((!is_readable($fileToLoad))&& $i<count($paths));

    if(! is_readable($fileToLoad)){
        echo 'file path:'. $fileToLoad;
        throw new Exception('Unknown class ' .$className);
    }
    require_once($fileToLoad);

    if(strlen(strstr($fileToLoad, '/model/'))>0){
        $sqlFileToLoad = __ROOT_DIR . '/sql/' . ucfirst($className) . '.sql.php';
        if(is_readable($sqlFileToLoad)){
            require_once($sqlFileToLoad);
        }
    }
 
}


}

$__LOADER = new AutoLoader();
?>