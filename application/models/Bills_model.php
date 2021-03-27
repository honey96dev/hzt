<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bills_model extends CI_Model
{
    public $table = '';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'bills';
        $this->customer_table = 'users';
        $this->load->model('notifications_model', 'notifications');
    }

    /**
     * @return Array of result
     * @param {String} filter
     */
    public function get_bill_list($filter = '', $limit = 0, $offset = 0, $order = '', $dir = 'asc')
    {
        $this->db->select("$this->table.*, $this->customer_table.first_name as first_name, $this->customer_table.surname as surname");
        $this->db->from($this->table);
        if ($filter != '') {
            $this->db->where('(' . $filter . ')');
        }
        $this->db->join($this->customer_table, "$this->customer_table.id = $this->table.user_id", "left");
        if ($order != '') {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by("$this->table.updated_at", 'desc');
        }
        if ($limit != 0) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    /**
     * @return Number of result
     * @param {String} filter
     */
    public function get_bill_count($filter = '')
    {
        $this->db->from($this->table);
        if ($filter != '') {
            $this->db->where('(' . $filter . ')');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_total_billing_amount_by_status($status = -1, $bill_date = '', $customer_id = 0)
    {
        $this->db->select('SUM(total_amount) as total');
        $this->db->from($this->table);
        if ($status != -1) {
            $this->db->where('status', $status);
        }

        if ($bill_date != '') {
            $this->db->where('bill_date', $bill_date);
        }

        if ($customer_id != 0) {
            $this->db->where('user_id', $customer_id);
        }
        $query = $this->db->get();
        $result = $query->row_array();
        return (!empty($result) && $result['total'] != '') ? $result['total'] : 0;
    }

    public function get_bill_by_id($id = 0)
    {
        if ($id == 0) {
            return false;
        }

        $this->db->from($this->table);
        $this->db->where("id", $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function confirm_bill_status($customer_id = 0) {
        $this->db->update($this->table, ['status' => 2], ['user_id' => $customer_id, 'status' => 1]);
    }
    /**
     * @return {Boolean} true for success, false for otherwise
     * @param {Array} new bill data
     */
    public function create($new_data = [])
    {
        if (empty($new_data)) {
            return false;
        }

        $insert_data = [
            'bill_number' => $new_data['bill_number'],
            'tax_id' => $new_data['tax_id'],
            'user_id' => $new_data['customer'],
            'company_name' => $new_data['company_name'],
            'product_name' => $new_data['product_name'],
            'quantity' => $new_data['quantity'],
            'total_amount' => $new_data['total_amount'],
            'bill_date' => date('Y-m-d', (int) strtotime($new_data['bill_date'])),
            'status' => (isset($new_data['status']) && $new_data['status'] == "on") ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->db->insert($this->table, $insert_data)) {
            if ($insert_data['status'] == 1) {
                $origin_customer_info = $this->customers->get_customer_by_id($insert_data['user_id']);
                $goal = $origin_customer_info['goal'];
                $goal_status = $origin_customer_info['goal_status'];
                $this->customers->add_goal_score($new_data['total_amount'], $new_data['customer']);
                if ($goal_status < $goal && ($goal_status + $insert_data['total_amount'] > $goal)) {
                    $this->notifications->create_check_notify($insert_data['user_id']);
                }
            }
            return true;
        } else {
            return false;
        }
    }
    /**
     * @return  {Boolean}   true for success, false for otherwise
     * @param   {Number}    bill id
     *          {Array}     data to update
     */
    public function update($id = 0, $new_data = [])
    {
        if (empty($new_data) || $id == 0) {
            return false;
        }

        $update_data = [
            'bill_number' => $new_data['bill_number'],
            'tax_id' => $new_data['tax_id'],
            'user_id' => $new_data['customer'],
            'company_name' => $new_data['company_name'],
            'product_name' => $new_data['product_name'],
            'quantity' => $new_data['quantity'],
            'total_amount' => $new_data['total_amount'],
            'bill_date' => date('Y-m-d', (int) strtotime($new_data['bill_date'])),
            'status' => (isset($new_data['status']) && $new_data['status'] == "on") ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $origin_data = $this->get_bill_by_id($id);
        if ($this->db->update($this->table, $update_data, ['id' => $id])) {
            if ($origin_data['status'] == 1 && $update_data['status'] == 0) {
                return $this->customers->sub_goal_score($origin_data['total_amount'], $update_data['user_id']);
            } else if ($origin_data['status'] == 1 && $update_data['status'] == 1) {
                return $this->customers->sub_goal_score($origin_data['total_amount'], $update_data['user_id']) &&
                $this->customers->add_goal_score($update_data['total_amount'], $update_data['user_id']);
            } else if ($origin_data['status'] != 1 && $update_data['status'] == 1) {
                return $this->customers->add_goal_score($update_data['total_amount'], $update_data['user_id']);
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function delete($id = 0)
    {
        if ($id == 0) {
            return false;
        }

        $origin_data = $this->get_bill_by_id($id);
        if ($this->db->delete($this->table, ['id' => $id])) {
            if ($origin_data['status'] == 1) {
                return $this->customers->sub_goal_score($origin_data['total_amount'], $origin_data['user_id']);
            }
            return true;
        } else {
            return false;
        }
    }
}
