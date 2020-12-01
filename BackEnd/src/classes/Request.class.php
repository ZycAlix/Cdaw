<?php
class Request {

    protected $controllerName;
    protected $uriParameters;
    protected $jsonReceived;
    protected static $singleton =  NULL;

    public static function getCurrentRequest(){
        if(is_null(static::$singleton))
            static::$singleton = new static();
        return static :: $singleton;
    }

   public function __construct() {
      $this->initBaseURI();
      $this->initControllerAndParametersFromURI();
   }

   // intialise baseURI
   // e.g. http://eden.imt-lille-douai.fr/~luc.fabresse/api.php => __BASE_URI = /~luc.fabresse
   // e.g. http://localhost/CDAW/api.php => __BASE_URI = /CDAW
   protected function initBaseURI() {
      $uriParameters = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $uriSegments = explode('/', $uriParameters);
      $this->baseURI = $uriSegments[1];
   }

   // intialise controllerName et uriParameters
   // controllerName contient chaîne 'default' ou le nom du controleur s'il est présent dans l'URI (la requête)
   // uriParameters contient un tableau vide ou un tableau contenant les paramètres passés dans l'URI (la requête)
   // e.g. http://eden.imt-lille-douai.fr/~luc.fabresse/api.php
   //    => controllerName == 'default'
   //       uriParameters == []
   // e.g. http://eden.imt-lille-douai.fr/~luc.fabresse/api.php/user/1
   //    => controllerName == 'user'
   //       uriParameters == [ 1 ]
   protected function initControllerAndParametersFromURI(){
        $prefix = $_SERVER['SCRIPT_NAME'];
        $uriParameters = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $i=0;
        while($i<strlen($prefix) && $i<strlen($uriParameters))
        if($prefix[$i]===$uriParameters[$i])
        $i++;
        
        $uriParameters = substr($uriParameters, $i);
        
        $uriParameters = trim($uriParameters, '/');
        $uriSegments = explode('/', $uriParameters);
        
        $this->controllerName = array_shift($uriSegments) ?: "default";
        $this->uriParameters = $uriSegments;
        
  }

   // ==============
   // Public API
   // ==============

    // retourne le name du controleur qui doit traiter la requête courante
    public function getControllerName() {
      //echo $this->controllerName;
      return $this->controllerName;
   }

   public function getUriParameters() {
      //echo $this->controllerName;
      return $this->uriParameters[0];
   }

    // retourne la méthode HTTP utilisée dans la requête courante
   public function getHttpMethod() {
      return $_SERVER["REQUEST_METHOD"];
   }

   // returns the decoded JSON content of the request
   public function jsonContent() {
      if(is_null($this->jsonReceived))
         $this->jsonReceived = json_decode(file_get_contents("php://input"));
      return $this->jsonReceived;
   }

   // returns JWT token in Authorization header or throw an exception
   public function getJwtToken() {
      $headers = getallheaders();
      //var_dump($headers);
      $autorization = $headers['Authorization'];
      $arr = explode(" ", $autorization);

      if(count($arr)<2)
         throw new Exception("Missing JWT token");

      $jwt_token = $arr[1];

      return $jwt_token;
   }
}