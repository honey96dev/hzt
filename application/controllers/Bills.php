<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bills extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bills_model', 'bills');
        $this->load->model('customers_model', 'customers');
    }

    public function index()
    {
        $header_data = [
            'menu' => 'bills',
            'title' => 'Bills',
        ];

        $data = [
            'bills' => $this->bills->get_bill_list(),
            'create_url'    => base_url('bills/create'),
            'update_url'    => base_url('bills/update'),
            'delete_url'    => base_url('bills/delete'),
        ];

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
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('bills/create_bill', $data);
        $this->load->view('includes/footer');
    }

    public function create_action()
    {
        if ($this->input->post()) {
            $new_data = $this->input->post();
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
            'menu'  => 'bills',
            'title' => 'Edit a new bill',
            'update_action_url' => base_url('bills/update_action/' . $id),
        ];

        $data = [
            'bill' => $this->bills->get_bill_by_id($id),
            'customers' => $this->customers->get_customer_list(),
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('bills/update_bill', $data);
        $this->load->view('includes/footer');
    }

    public function update_action($id = 0) {
        if ($id != 0 && $this->input->post()) {
            $new_data = $this->input->post();
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

    public function delete($id = 0) {
        $this->bills->delete($id);
        redirect(base_url('bills'));
    }
}
