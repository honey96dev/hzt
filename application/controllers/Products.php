<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model', 'products');
    }

    public function index()
    {
        $header_data = [
            'menu' => 'products',
            'title' => 'Productos',
        ];

        $data = [
            'products' => $this->products->get_product_list(),
            'create_url' => base_url('products/create'),
            'update_url' => base_url('products/update'),
            'delete_url' => base_url('products/delete'),
            'confirm_url' => base_url('products/confirm'),
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('products/products', $data);
        $this->load->view('includes/footer');
    }

    public function create()
    {
        $header_data = [
            'menu' => 'products',
            'title' => 'Agregar un nuevo producto',
            'create_action_url' => base_url('products/create_action'),
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('products/create_product');
        $this->load->view('includes/footer');
    }

    public function create_action()
    {
        if ($this->input->post()) {
            $new_data = $this->input->post();
            if ($this->products->create($new_data)) {
                echo json_encode(['result' => 'success']);
            } else {
                echo json_encode(['result' => 'failed']);
            }
        } else {
            echo json_encode(['result' => 'error']);
        }
        return;
    }

    public function update($id = 0)
    {
        if ($id == 0) {
            redirect(base_url('products'));
        }

        $header_data = [
            'menu' => 'products',
            'title' => 'Editar un nuevo producto',
            'update_action_url' => base_url('products/update_action/' . $id),
        ];

        $data = [
            'product' => $this->products->get_product_by_id($id),
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('products/update_product', $data);
        $this->load->view('includes/footer');
    }

    public function update_action($id = 0)
    {
        if ($id != 0 && $this->input->post()) {
            $new_data = $this->input->post();
            if ($this->products->update($id, $new_data)) {
                echo json_encode(['result' => 'success']);
            } else {
                echo json_encode(['result' => 'failed']);
            }
        } else {
            echo json_encode(['result' => 'error']);
        }
        return;
    }

    public function delete($id = 0)
    {
        $this->products->delete($id);
        redirect(base_url('products'));
    }
}
