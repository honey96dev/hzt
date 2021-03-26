<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customers_model extends CI_Model
{
    public $table = '';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    /**
     * @return Array of result
     * @param {String} filter
     */
    public function get_customer_list($filter = '', $order = 'updated_at', $order_by = 'desc')
    {
        $this->db->from($this->table);
        if ($filter != '') {
            $this->db->where('(' . $filter . ')');
        }

        $this->db->order_by($order, $order_by);
        $query = $this->db->get();
        return $query->result_array();
    }
    /**
     * @return  Number  number of customers
     * @param   String  filter string
     */
    public function get_customer_count($filter = '')
    {
        $this->db->from($this->table);
        if ($filter != '') {
            $this->db->where('(' . $filter . ')');
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    /**
     * @return  Array   Customer information by id
     * @param   Number  Customer id
     */
    public function get_customer_by_id($id = 0)
    {
        if ($id == 0) {
            return false;
        }

        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return empty($result) ? false : $result;
    }
    /**
     * @return  Array   Customer information by email
     * @param   String  Customer email
     */
    public function get_customer_by_email($email = '')
    {
        if ($email == '') {
            return false;
        }

        $this->db->from($this->table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        $result = $query->row_array();
        return empty($result) ? false : $result;
    }
    /**
     * @return  Array   Customer information by username
     * @param   String  Customer username
     */
    public function get_customer_by_username($username = '')
    {
        if ($username == '') {
            return false;
        }

        $this->db->from($this->table);
        $this->db->where('user_name', $username);
        $query = $this->db->get();
        $result = $query->row_array();
        return empty($result) ? false : $result;
    }

    public function get_customer_goal($customer_id = 0) {
        if ($customer_id == 0) {
            return 0;
        }

        $customer_info = $this->get_customer_by_id($customer_id);
        return $customer_info['goal'];
    }
    /**
     * @return  Boolean true for add goal success, false for otherwise
     * @param   Number  Billed amount price
     *          Number  Customer id
     */
    public function add_goal_score($bill_amount = 0, $customer_id = 0)
    {
        if ($customer_id == 0) {
            return false;
        }

        $customer_info = $this->get_customer_by_id($customer_id);
        $new_bill_amount = $customer_info['goal_status'] + $bill_amount;
        return $this->db->update($this->table, ['goal_status' => $new_bill_amount, 'updated_at' => date('Y-m-d H:i:s')], ['id' => $customer_id]);
    }
    /**
     * @return  Boolean true for success, false for otherwise
     * @param   Number  Billed amount price
     *          Number  Customer id
     */
    public function sub_goal_score($bill_amount = 0, $customer_id = 0)
    {
        if ($customer_id == 0) {
            return false;
        }

        $customer_info = $this->get_customer_by_id($customer_id);
        $new_bill_amount = $customer_info['goal_status'] - $bill_amount;
        return $this->db->update($this->table, ['goal_status' => $new_bill_amount, 'updated_at' => date('Y-m-d H:i:s')], ['id' => $customer_id]);
    }
    /**
     * @return {Boolean} true for success, false for otherwise
     * @param {Array} new customer data
     */
    public function create($new_data = [])
    {
        if (empty($new_data)) {
            return false;
        }

        $insert_data = [
            'user_name' => $new_data['username'],
            'first_name' => $new_data['first_name'],
            'surname' => $new_data['last_name'],
            'password' => generate_password($new_data['password']),
            'email' => $new_data['email'],
            'role' => (isset($new_data['role']) && $new_data['role'] == "on") ? 1 : 0,
            'status' => (isset($new_data['status']) && $new_data['status'] == "on") ? 1 : 0,
            'goal' => $new_data['goal'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        return $this->db->insert($this->table, $insert_data);
    }
    /**
     * @return  {Boolean}   true for success, false for otherwise
     * @param   {Number}    customer id
     *          {Array}     data to update
     */
    public function update($id = 0, $new_data = [])
    {
        if (empty($new_data) || $id == 0) {
            return false;
        }

        $update_data = [
            'user_name' => $new_data['username'],
            'first_name' => $new_data['first_name'],
            'surname' => $new_data['last_name'],
            'email' => $new_data['email'],
            'role' => (isset($new_data['role']) && $new_data['role'] == "on") ? 1 : 0,
            'status' => (isset($new_data['status']) && $new_data['status'] == "on") ? 1 : 0,
            'goal' => $new_data['goal'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($new_data['password'] != "") {
            $update_data['password'] = md5($new_data['password']);
        }

        return $this->db->update($this->table, $update_data, ['id' => $id]);
    }

    public function delete($id = 0)
    {
        if ($id == 0) {
            return false;
        }

        return $this->db->delete($this->table, ['id' => $id]);
    }
}
