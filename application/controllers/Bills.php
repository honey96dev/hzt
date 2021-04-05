<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bills extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bills_model', 'bills');
        $this->load->model('customers_model', 'customers');
        $this->load->model('products_model', 'products');
    }

    public function index()
    {
        $header_data = [
            'menu' => 'bills',
            'title' => 'Facturas',
        ];

        $data = [
            'bills' => $this->bills->get_bill_list(),
            'create_url' => base_url('bills/create'),
            'update_url' => base_url('bills/update'),
            'delete_url' => base_url('bills/delete'),
        ];

        $customer_id = current_customer_id();
        $data['bills'] = is_admin() ? $this->bills->get_bill_list() : $this->bills->get_bill_list('user_id = ' . $customer_id);
        $this->load->view('includes/header', $header_data);
        $this->load->view('bills/bills', $data);
        $this->load->view('includes/footer');
    }

    public function create()
    {
        $header_data = [
            'menu' => 'bills',
            'title' => 'Add a new Bill',
            'create_action_url' => base_url('bills/create_action'),
        ];

        $data = [
            'customers' => $this->customers->get_customer_list(),
            'products' => $this->products->get_product_list(),
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('bills/create_bill', $data);
        $this->load->view('includes/footer');
    }

    public function create_action()
    {
        if ($this->input->post()) {
            $new_data = $this->input->post();

            $config['upload_path'] = BILLING_DOC_PATH;
            $config['allowed_types']        = 'pdf|doc|docx|rar|zip';
            $config['max_size'] = 10240;
            $config['file_name'] = md5(time());

            $this->load->library('upload', $config);
            if ( $this->upload->do_upload('bill_doc')) {
                $upload_info = $this->upload->data();
                $new_data['bill_doc'] = $upload_info['file_name'];
            } else {
                echo  $this->upload->display_errors();
                $new_data['bill_doc'] = '';
            }

            if ($this->bills->create($new_data)) {
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
            redirect(base_url('bills'));
        }

        $header_data = [
            'menu' => 'bills',
            'title' => 'Edit a new bill',
            'update_action_url' => base_url('bills/update_action/' . $id),
        ];

        $data = [
            'bill' => $this->bills->get_bill_by_id($id),
            'customers' => $this->customers->get_customer_list(),
            'products' => $this->products->get_product_list(),
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('bills/update_bill', $data);
        $this->load->view('includes/footer');
    }

    public function update_action($id = 0)
    {
        if ($id != 0 && $this->input->post()) {
            $new_data = $this->input->post();
            $config['upload_path'] = BILLING_DOC_PATH;
            $config['allowed_types']        = 'pdf|doc|docx|rar|zip';
            $config['max_size'] = 10240;
            $config['file_name'] = md5(time());

            $this->load->library('upload', $config);
            $origin_bill_info = $this->bills->get_bill_by_id($id);
            if ( $this->upload->do_upload('bill_doc')) {
                $origin_bill_file_path = BILLING_DOC_PATH . DIRECTORY_SEPARATOR . $origin_bill_info['bill_doc'];
                if (@file_exists($origin_bill_info)) {
                    @unlink($origin_bill_file_path);
                }
                $upload_info = $this->upload->data();
                $new_data['bill_doc'] = $upload_info['file_name'];
            } else {
                echo  $this->upload->display_errors();
                $new_data['bill_doc'] = $origin_bill_info['bill_doc'];
            }

            if ($this->bills->update($id, $new_data)) {
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
        $this->bills->delete($id);
        redirect(base_url('bills'));
    }
}
