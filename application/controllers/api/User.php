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
                'result' => null
            ],404);
        }
    }

    public function index_put(){
        $token = $this->put('token');
        $fullname = $this->put('fullname');
        $phone = $this->put('phone');

        $data = [
            'fullname' => $fullname,
            'phone' => $phone,
            'updated' => date('Y-m-d H:i:s'),
        ];

        $this->db->where('token', $token);
        $this->db->update('users', $data);
        if($this->db->affected_rows()){
            $this->response([
                'status' => true,
                'message' => 'success update user',
                'result' => null
            ],200);
        }else{
            $this->response([
                'status' => false,
                'message' => 'token invalid',
                'result' => null
            ],404);
        }
    }
}
