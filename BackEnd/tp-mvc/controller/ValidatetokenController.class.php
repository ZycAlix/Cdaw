<?php

include_once __ROOT_DIR . '/libs/php-jwt/src/BeforeValidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/ExpiredException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/SignatureInvalidException.php';
include_once __ROOT_DIR . '/libs/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

class ValidatetokenController extends Controller {

   public function __construct($name, $request) {
      parent::__construct($name, $request);
   }

    public function processRequest() {
      try {
         $jwt_token = $this->request->getJwtToken();

         $decodedJWT = JWT::decode($jwt_token, JWT_BACKEND_KEY, array('HS256'));
         $jsonResult = json_encode(array(
             "message" => "Access granted.",
             "data" => $decodedJWT
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