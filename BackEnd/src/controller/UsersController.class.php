<?php

class UsersController extends Controller {

    public function __construct($name, $request) {
        parent::__construct($name, $request);
    }

    // ==============
    // Actions
    // ==============

    public function processRequest()
    {
         switch ($this->request->getHttpMethod()) {
            case 'GET':
                return $this->getAllUsers();
                break;
        }
        return Response::errorResponse("unsupported parameters or method in users");
    }

    protected function getAllUsers()
    {
        $users = User::getList();
        return $users;
    }
}