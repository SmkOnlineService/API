<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class User extends RestController
{

    public function index_get(){
        $token = $this->get('token');
        $get_users = $this->db->get_where('users', ['token' => $token])->result_array();
        if($get_users){
            $this->response([
                'status' => true,
                'message' => 'success',
                'result' => $get_users
            ],200);
        }else{
            $this->response([
                'status' => false,
                'message' => 'user not found',
            ],404);
        }
    }
}
