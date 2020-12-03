<?php

class RoomController extends Controller {

    public function __construct($name, $request) {
        parent::__construct($name, $request);
        //echo 'this is user controller' ;
    }

    public function processRequest()
    {
         switch ($this->request->getHttpMethod()) {
            case 'GET':
                //return $this->getUserInfos();
                //break;
            case 'PUT':
                //return $this->updateUserInfos();
                //break;
            case 'POST':
                return $this->createRoom();
                break;
            case 'DELETE':
                //eturn $this->deleteUser();
                //break;

        }
        return Response::errorResponse("unsupported parameters or method in users");
    }

    protected function deleteRoom(){
        $id =  $this->request->getUriParameters();
        User::deleteUser($id);
        $jsonResult = json_encode(
            array(
                "message" => "User was deleted.",
            )
        );
        return Response::okResponse($jsonResult);
    }
 
    protected function createRoom(){
        $jsonRecieved = json_decode(file_get_contents("php://input"));
        //var_dump($jsonRecieved);
        Room::addRoom($jsonRecieved);

        $res = array(
                "id" => "blbl"
            );
        return $res;
    }

    protected function updateUserInfos(){
        $id =  $this->request->getUriParameters();
        $jsonRecieved = json_decode(file_get_contents("php://input"));
        User::updateUserInfoById($id,$jsonRecieved);
        $jsonResult = json_encode(
            array(
                "message" => "User was updated.",
            )
        );
        return Response::okResponse($jsonResult);
        
    }
    protected function getUserInfos()
    {
        $id =  $this->request->getUriParameters();
        $userinfo = User::getUserById($id);
        $jsonResult = json_encode($userinfo);
        return Response::okResponse($jsonResult);
    }

   
    // public function getUserIdFromUri(){
    //     $uriParameters = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    //     $uriSegments = explode('/', $uriParameters);
    //     return end($uriSegments);
    // }

}

?>