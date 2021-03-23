<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goals extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('goals_model', 'goals');
        $this->load->model('customers_model', 'customers');
    }

    public function index()
    {
        $header_data = [
            'menu' => 'goals',
            'title' => 'Goals Status',
        ];

        $data = [
        ];

        $this->load->view('includes/header', $header_data);
        $this->load->view('goals/goals', $data);
        $this->load->view('includes/footer');
    }
}
