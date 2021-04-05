<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
{
    public $table = '';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'products';
        $this->load->model('bills_model', 'bills');
    }

    /**
     * @return Array of result
     * @param {String} filter
     */
    public function get_product_list($filter = '', $order = 'updated_at', $order_by = 'desc')
    {
        $this->db->from($this->table);
        if ($filter != '') {
            $this->db->where('(' . $filter . ')');
        }

        $this->db->order_by($order, $order_by);
        $query = $this->db->get();
        $result = $query->result_array();
        $res = [];
        if (!empty($result)) {
            for($i = 0, $l = count($result); $i < $l; $i++) {
                $res[$i] = $result[$i];
                $res[$i]['billed_amount'] = [
                    'paid' => $this->bills->get_total_billing_amount_by_status(1, '', 0, $result[$i]['id']),
                    'unpaid' => $this->bills->get_total_billing_amount_by_status(0, '', 0, $result[$i]['id']),
                    'confirmed' => $this->bills->get_total_billing_amount_by_status(2, '', 0, $result[$i]['id'])
                ];

                $res[$i]['billed_quantity'] = [
                    'paid' => $this->bills->get_amount_per_product(1, $result[$i]['id']),
                    'unpaid' => $this->bills->get_amount_per_product(0, $result[$i]['id']),
                    'confirmed' => $this->bills->get_amount_per_product(2, $result[$i]['id'])
                ];

                $res[$i]['billed_number'] = [
                    'paid' => $this->bills->get_bill_count('status = 1 AND product_id = ' . $result[$i]['id']),
                    'unpaid' => $this->bills->get_bill_count('status = 0 AND product_id = ' . $result[$i]['id']),
                    'confirmed' => $this->bills->get_bill_count('status = 2 AND product_id = ' . $result[$i]['id'])
                ];
            }
        }
        return $res;
    }
    /**
     * @return  Number  number of products
     * @param   String  filter string
     */
    public function get_product_count($filter = '')
    {
        $this->db->from($this->table);
        if ($filter != '') {
            $this->db->where('(' . $filter . ')');
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    /**
     * @return  Array   product information by id
     * @param   Number  product id
     */
    public function get_product_by_id($id = 0)
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
     * @return {Boolean} true for success, false for otherwise
     * @param {Array} new product data
     */
    public function create($new_data = [])
    {
        if (empty($new_data)) {
            return false;
        }

        $insert_data = [
            'product_name' => $new_data['product_name'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        return $this->db->insert($this->table, $insert_data);
    }
    /**
     * @return  {Boolean}   true for success, false for otherwise
     * @param   {Number}    product id
     *          {Array}     data to update
     */
    public function update($id = 0, $new_data = [])
    {
        if (empty($new_data) || $id == 0) {
            return false;
        }

        $update_data = [
            'product_name' => $new_data['product_name'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];

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
