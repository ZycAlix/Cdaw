<?php
include_once __ROOT_DIR . '/libs/php-jwt/src/BeforeValidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/ExpiredException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/SignatureInvalidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;
/*
* A Controller is dedicated to process a request
* its responsabilities are:
* - analyses the action to be done
* - analyses the parameters
* - act on the model objects to perform the action
* - process the data
* - call the view and passes it the data
* - return the response
*/

abstract class Controller {

    protected $name;
    protected $request;

    public function __construct($name, $request) {
        $this->request = $request;
        $this->name = $name;
    }

    public abstract function processRequest();

    public function execute() {
        $response = $this->processRequest();
        //echo var_dump($response);
        if(empty($response)) {
            // $response = Response::serverErrorResponse("error processing request in ". self::class); // Oh my PHP!
            $response = Response::serverErrorResponse("error processing request in ". static::class);
        }
        if($this->name=="Login"||$this->name=="Register"){
            return $response;
        }
        try {
            //echo var_dump($this->request);
            $jwt_token = $this->request->getJwtToken();
            $decodedJWT = JWT::decode($jwt_token, JWT_BACKEND_KEY, array('HS256'));
            $jsonResult = json_encode(array(
                "message" => "Access granted.",
                "data" => $response
            ));
        } catch (Exception $e){
            header('WWW-Authenticate: Bearer realm="'.JWT_ISSUER.'"');

            $jsonResult =  json_encode(array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            ));
            return Response::unauthorizedResponse($jsonResult);
        }
        $response = Response::okResponse($jsonResult);
        return $response;
    }

}