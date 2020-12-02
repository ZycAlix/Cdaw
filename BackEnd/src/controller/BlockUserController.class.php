<?php


class BlockUserController extends Controller {

    public function __construct($name, $request) {
        parent::__construct($name, $request);
    }

    public function processRequest() {
        if($this->request->getHttpMethod() !== 'PUT')
            return Response::errorResponse('{ "message" : "Unsupported endpoint" }' );

        $json = $this->request->jsonContent();
        
        
        if(!isset($json->USER_LOGIN)) {
            $r = new Response(422,"login fields is mandatory");
            $r->send();
        }
        $admin = Admin::tryFindAdminByLogin($json->USER_LOGIN);
        //var_dump($admin);
        if(empty($admin)) {
            $r = new Response(404,"Admin not founded");
            $r->send();
        }
        Admin::tryBlockUserByLogin($json);
        $jsonResult = json_encode(
            array(
                "message" => "User was blocked.",
            )
        );
        return Response::okResponse($jsonResult);
    }
}