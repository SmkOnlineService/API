<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Access extends RestController
{

    public function logreg_post(){
        $name = $this->post('name');
        $email = $this->post('email');
        $photo = $this->post('photo');
        $token = $this->post('token');

        $data = [
            'name' => $name,
            'email' => $email,
            'photo' => $photo,
            'token' => $token,
            'updated' => date('Y-m-d H:i:s'),
        ];

        if($name != null && $email != null){
            // Cek Akun
            $get_users = $this->db->get_where('users', ['email' => $email])->result_array();
            if($get_users){
                //update data token dan time
                $data_update = [
                    'token' => $token,
                    'updated' => date('Y-m-d H:i:s'),
                ];
                $this->db->where('email', $email);
                $this->db->update('users', $data_update);
                if($this->db->affected_rows()){
                    $this->response([
                        'status' => true,
                        'message' => 'success update user',
                    ],200);
                }else{
                    $this->response([
                        'status' => false,
                        'message' => 'failed update user',
                    ],404);
                }
            }else{
                //buat akun
                $CreateUser = $this->db->insert('users', $data);
                if($CreateUser){
                    $this->response([
                        'status' => true,
                        'message' => 'success create user',
                    ],200);
                }else{
                    $this->response([
                        'status' => false,
                        'message' => 'failed create user',
                    ],404);
                }
            }
        }else{
            $this->response([
                'status' => false,
                'message' => 'empty parameter',
            ],404);
        }
    }
}
