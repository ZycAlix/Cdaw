<?php
class Response {
   public $code;
   public $body;

   public function __construct($code = 404, $msg = "") {
      $this->code = $code;
      $this->body = $msg;
   }

   public static function errorResponse($message = "") {
      return new Response(400,$message);
   }

   public static function serverErrorResponse($message = "")
   {
      return new Response(500,$message);
   }

   public static function okResponse($message = "")
   {
      return new Response(200,$message);
   }

   public static function unauthorizedResponse($message = "")
   {
      return new Response(401,$message);
   }


   public static function notFoundResponse($message = "")
   {
      return new Response(404,$message);
   }

   public static function errorInParametersResponse($message = "")
   {
      return new Response(400,$message);
   }

   public static function interceptEchos() {
      ob_start();
   }

   public static function getEchos() {
      return ob_get_clean();
   }

   public function send() {
      // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
      header("Access-Control-Allow-Origin: *");

      header("Content-Type: application/json; charset=UTF-8");

      // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Methods
      header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");

      header("Access-Control-Max-Age: 3600"); // Maximum number of seconds the results can be cached.

      // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Headers
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

      http_response_code($this->code);
      echo $this->body;
      exit; // do we keep that?
   }
}