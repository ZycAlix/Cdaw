<?php

    // define __ROOT_DIR constant which contains the absolute path on disk
    // of the directory that contains this file (index.php)
    // e.g. http://eden.imt-lille-douai.fr/~luc.fabresse/index.php => __ROOT_DIR = /home/luc.fabresse/public_html
    $rootDirectoryPath = realpath(dirname(__FILE__));
    define ('__ROOT_DIR', $rootDirectoryPath );
    header('Access-Control-Allow-Origin:*');//允许所有来源访问
    header('Access-Control-Allow-Method:POST,GET');//允许访问的方式
    // Load all application config
    require_once(__ROOT_DIR . "/config/config.php");

    // Load the Loader class to automatically load classes when needed
    require_once(__ROOT_DIR . '/classes/AutoLoader.class.php');

    // Reify the current request
    $request = Request::getCurrentRequest();

    //$r = new Request();
    //print_r($request);
    //exit;

    Response::interceptEchos();
    //$users = UsersController::processRequest();

     try {
         $controller = Dispatcher::dispatch($request);
         //print_r($controller);
         $response = $controller->execute();
         //echo $response;
     } catch (Exception $e) {
        $log = Response::getEchos();
        $log .= " " . $e->getMessage();
        $response = Response::errorResponse($log);
    }
    //echo var_dump($response);
    $response->send();
?>