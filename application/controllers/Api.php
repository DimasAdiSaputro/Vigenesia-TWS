<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }


    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $api = $this->db->get('user')->result();
        } else {
            $this->db->where('id', $id);
            $api = $this->db->get('user')->result();
        }
        $this->response($api, 200);
    }



    function index_post()
    {
        $data = array(
            'iduser'           => $this->post('iduser'),
            'nama'          => $this->post('nama'),
            'profesi'    => $this->post('profesi'),
            'email'    => $this->post('email'),
            'password'    => $this->post('password'),
            'role_id'    => $this->post('role_id'),
            'is_active'    => $this->post('is_active'),
            'tanggal_input'    => $this->post('tanggal_input')
        );
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }



    function index_put()
    {
        $id = $this->put('iduser');
        $data = array(
            'iduser'           => $this->put('iduser'),
            'nama'          => $this->put('nama'),
            'profesi'    => $this->put('profesi'),
            'email'    => $this->put('email'),
            'password'    => $this->put('password'),
            'role_id'    => $this->put('role_id'),
            'is_active'    => $this->put('is_active'),
            'tanggal_input'    => $this->put('tanggal_input')
        );
        $this->db->where('iduser', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete($id)
    {
        $this->db->where('iduser', $id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
