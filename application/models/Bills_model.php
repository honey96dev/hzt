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
    }

    /**
     * @return Array of result
     * @param {String} filter
     */
    public function get_bill_list($filter = '')
    {
        $this->db->select("$this->table.*, $this->customer_table.first_name as first_name, $this->customer_table.surname as surname");
        $this->db->from($this->table);
        if ($filter != '') {
            $this->db - where('(' . $filter . ')');
        }
        $this->db->join($this->customer_table, "$this->customer_table.id = $this->table.user_id", "left");
        $this->db->order_by("$this->table.updated_at", 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_bill_by_id($id = 0)
    {
        if ($id == 0) {
            return false;
        }

        $this->db->from($this->table);
        // $this->db->join($this->customer_table, "$this->customer_table.id = $this->table.user_id", "left");
        $this->db->where("id", $id);
        $query = $this->db->get();
        return $query->row_array();
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
            'bill_number'   => $new_data['bill_number'],
            'tax_id'        => $new_data['tax_id'],
            'user_id'       => $new_data['customer'],
            'company_name'  => $new_data['company_name'],
            'product_name'  => $new_data['product_name'],
            'quantity'      => $new_data['quantity'],
            'total_amount'  => $new_data['total_amount'],
            'bill_date'     => date('Y-m-d', (int)strtotime($new_data['bill_date'])),
            'status'        => (isset($new_data['status']) && $new_data['status'] == "on") ? 1 : 0,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        return $this->db->insert($this->table, $insert_data);
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
            'bill_number'   => $new_data['bill_number'],
            'tax_id'        => $new_data['tax_id'],
            'user_id'       => $new_data['customer'],
            'company_name'  => $new_data['company_name'],
            'product_name'  => $new_data['product_name'],
            'quantity'      => $new_data['quantity'],
            'total_amount'  => $new_data['total_amount'],
            'bill_date'     => date('Y-m-d', (int)strtotime($new_data['bill_date'])),
            'status'        => (isset($new_data['status']) && $new_data['status'] == "on") ? 1 : 0,
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        return $this->db->update($this->table, $update_data, ['id' => $id]);
    }

    public function delete($id = 0) {
        if ($id == 0) {
            return false;
        }

        return $this->db->delete($this->table, ['id' => $id]);
    }
}
