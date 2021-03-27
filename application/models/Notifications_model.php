<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notifications_model extends CI_Model
{
    public $table = '';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'notifications';
        $this->customer_table = 'users';
        $this->load->model('customers_model', 'customers');
    }

    public function create_confirm_notify($customer_info = [])
    {
        $new_notification = [
            'user_id' => $customer_info['id'],
            'detail' => 'Confirmed your goal status : $' . $customer_info['goal_status'] . ' You will receive $' . show_number($customer_info['goal_status'] / 50) . ' .',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert($this->table, $new_notification);
    }

    public function create_check_notify($customer_id = 0)
    {
        $customer_info = $this->customers->get_customer_by_id($customer_id);

        $new_notification = [
            'user_id' => $this->session->user['id'],
            'detail' => $customer_info['first_name'] . ' ' . $customer_info['surname'] . ' has been reached goal score. $' . show_number($customer_info['goal']) . '/$' . show_number($customer_info['goal_status']) . ' .',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert($this->table, $new_notification);
    }

    public function get_notification_list($customer_id = 0)
    {
        $this->db->from($this->table);
        if ($customer_id != 0) {
            $this->db->where('user_id', $customer_id);
        }
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_unread_notifications_count($customer_id = 0)
    {
        $this->db->from($this->table);
        if ($customer_id != 0) {
            $this->db->where('user_id', $customer_id);
        }
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
