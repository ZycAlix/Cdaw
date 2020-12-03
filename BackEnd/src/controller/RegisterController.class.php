<?php


class RegisterController extends Controller {

   public function __construct($name, $request) {
      parent::__construct($name, $request);
   }

    public function processRequest() {
        if($this->request->getHttpMethod() !== 'POST')
            return Response::errorResponse('{ "message" : "Unsupported endpoint" }' );

        $json = $this->request->jsonContent();

        if(!isset($json->USER_LOGIN) || !isset($json->USER_PASSWORD)) {
            $r = new Response(422,"login and pwd fields are mandatory");
            $r->send();
        }
        User::tryRegister($json);
        $jsonResult = json_encode(
            array(
                "message" => "User was registered.",
            )
        );
        return Response::okResponse($jsonResult);
    }
}