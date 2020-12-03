<?php

class UserController extends Controller {

    public function __construct($name, $request) {
        parent::__construct($name, $request);
        //echo 'this is user controller' ;
    }

    public function processRequest()
    {
         switch ($this->request->getHttpMethod()) {
            case 'GET':
                return $this->getUserInfos();
                break;
            case 'PUT':
                return $this->updateUserInfos();
                break;
            case 'POST':
                return $this->addUser();
                break;
            case 'DELETE':
                return $this->deleteUser();
                break;

        }
        return Response::errorResponse("unsupported parameters or method in users");
    }

    protected function deleteUser(){
        $id =  $this->request->getUriParameters();
        User::deleteUser($id);
        $res = array(
                "message" => "User was deleted.",
        );
        return $res;
    }
 
    protected function addUser(){
        $jsonRecieved = json_decode(file_get_contents("php://input"));
        User::addUser($jsonRecieved);
        $res = array(
                "message" => "User was added.",
            );
        return $res;
    }

    protected function updateUserInfos(){
        $login =  $this->request->getUriParameters();
        $jsonRecieved = json_decode(file_get_contents("php://input"));
        User::updateUserInfoByLogin($login,$jsonRecieved);
        $res = array(
                "message" => "User was updated.",
            );
        return $res;
        
    }
    protected function getUserInfos()
    {
        $login =  $this->request->getUriParameters();
        $userinfo = User::getUserByLogin($login);
        return $userinfo;
    }


}

?>