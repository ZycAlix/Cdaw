<?php


class DeleteAdminController extends Controller {

    public function __construct($name, $request) {
        parent::__construct($name, $request);
    }

    public function processRequest() {
        if($this->request->getHttpMethod() !== 'PUT')
            return Response::errorResponse('{ "message" : "Unsupported endpoint" }' );

        $json = $this->request->jsonContent();

        if(!isset($json->USER_LOGIN)) {
            $r = new Response(422,"Login field is mandatory");
            $r->send();
        }
        $admin = Admin::tryFindAdminByLogin($json->USER_LOGIN);
        
        if(empty($admin)) {
            $r = new Response(404,"Admin not founded");
            $r->send();
        }
        Admin::tryDeleteAdmin($json);

        if($admin->USER_ROLE !== "1"){
            $r = new Response(400,"This is not an admin");
            $r->send();
        }
        $res = array(
                "message" => "Admin was deleted.",
            );
        return $res;
    }
}