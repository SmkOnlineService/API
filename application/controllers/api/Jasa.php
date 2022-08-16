<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Jasa extends RestController
{
    public function index_post(){
        $nama_jasa = $this->post('nama_jasa');
        $insert = $this->db->insert('jasa', ['nama' => $nama_jasa]);
        if($insert){
            $this->response([
                'status' => true,
                'message' => 'success',
                'result' => null
            ],200);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed',
                'result' => null
            ],404);
        }
    }

    public function index_get(){
        $this->db->order_by('nama', 'asc');
        $get_jasa = $this->db->get('jasa')->result_array();
        if($get_jasa){
            $this->response([
                'status' => true,
                'message' => 'success',
                'result' => $get_jasa
            ],200);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed',
                'result' => null
            ],404);
        }
    }

    public function index_put(){
        $id_jasa = $this->put('id_jasa');
        $nama_jasa = $this->put('nama_jasa');
        $this->db->where('id_jasa', $id_jasa);
        $this->db->update('jasa', ['nama' => $nama_jasa]);
        if($this->db->affected_rows()){
            $this->response([
                'status' => true,
                'message' => 'success',
                'result' => null
            ],200);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed',
                'result' => null
            ],404);
        }
    }

    public function index_delete(){
        $id_jasa = $this->delete('id_jasa');
        $this->db->where('id_jasa', $id_jasa);
        $this->db->delete('jasa');
        if($this->db->affected_rows()){
            $this->response([
                'status' => true,
                'message' => 'success',
                'result' => null
            ],200);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed',
                'result' => null
            ],404);
        }
    }
}