<?php

/*
* Analyses a request, created the right Controller passing it the request
*/

class Dispatcher {

    public static function dispatch($request) {
        return static::dispatchToController($request->getControllerName(),$request);
      
    }

    public static function dispatchToController($controllerName, $request) {
     
        $controllerClassName = ucfirst($controllerName) . 'Controller';
        //echo 'control name: '.$controllerClassName.'<br>';
        if(!class_exists($controllerClassName))
            throw new Exception("$controllerClassName does not exist");
        return new $controllerClassName($controllerName,$request);
    }
}