<?php


class BlockIpController extends Controller {

    public function __construct($name, $request) {
        parent::__construct($name, $request);
    }

    public function processRequest() {
        if($this->request->getHttpMethod() !== 'PUT')
            return Response::errorResponse('{ "message" : "Unsupported endpoint" }' );

        $json = $this->request->jsonContent();

        if(!isset($json->ADRESS_IP)) {
            $r = new Response(422,"adress ip field is mandatory");
            $r->send();
        }
        $admin = Admin::tryFindAdminByIp($json->ADRESS_IP);
        
        if(empty($admin)) {
            $r = new Response(404,"Admin not founded");
            $r->send();
        }
        Admin::tryBlockUserByIp($json);
        $jsonResult = json_encode(
            array(
                "message" => "User was blocked.",
            )
        );
        return Response::okResponse($jsonResult);
    }
}