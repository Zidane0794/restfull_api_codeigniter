<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Api extends REST_Controller {

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('M_barang', 'brg');
        
    }

    public function index_get()
    {
        $id = $this->input->get('id');

        if(!empty($id)) {

            $data = $this->brg->get_by_id($id)->result();

            if($data) {
                $res['error'] = false;
                $res['message'] = 'success get data by id';
                $res['data'] = $data;

            } else {
                $res['error'] = true;
                $res['message'] = 'failed get data';
            }

        }else {

            $data = $this->brg->get_all()->result();

            if($data) {
                $res['error'] = false;
                $res['message'] = 'success get all data';
                $res['data'] = $data;

            } else {
                $res['error'] = true;
                $res['message'] = 'failed get data';
            }

        }

        $this->response($res, 200);

        
    }

    public function index_post()
    {
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $stock = $this->input->post('stock');
        $unit = $this->input->post('unit');

        $data = array(
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'unit' => $unit
        );

        $insert = $this->brg->save($data);

        if($insert) {
            $res['error'] = false;
            $res['message'] = 'insert success';
            $res['data'] = $data;
        } else {
            $res['error'] = true;
            $res['message'] = 'insert failed';
            $res['data'] = null;
        }

        $this->response($res, 200);
        
    }

    public function index_put()
    {
        $id = $this->input->get('id');

        $name = $this->put('name');
        $price = $this->put('price');
        $stock = $this->put('stock');
        $unit = $this->put('unit');

        $data = array(
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'unit' => $unit
        );

        if(!empty($id)) {
           $update = $this->brg->edit($id, $data);

           if($update) {
                $res['error'] = false;
                $res['message'] = 'update success';
                $res['data'] = $data;
           } else {
                $res['error'] = true;
                $res['message'] = 'update failed';
                $res['data'] = null;
           }
        } else {
            $res['error'] = true;
            $res['message'] = 'update failed';
            $res['data'] = null;
        }

        $this->response($res, 200);
        
    }

    public function index_delete()
    {
        $id = $this->input->get('id');

        if(!empty($id)) {

            $delete = $this->brg->delete($id);

            if($delete) {
                $res['error'] = false;
                $res['message'] = 'delete success';
                
           } else {
                $res['error'] = true;
                $res['message'] = 'delete failed';
                
           }
        } else {
            $res['error'] = true;
            $res['message'] = 'delete failed';
        }

        $this->response($res, 200);
        
    }

}

/* End of file Api.php */
