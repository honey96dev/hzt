<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customers_model', 'customers');
        $this->load->model('bills_model', 'bills');
    }

    public function index()
    {
        $header_data = [
            'menu' => 'dashboard',
            'title' => 'Tablero de mandos',
        ];

        $data = [
            'total_customers' => $this->customers->get_customer_count(),
            'total_bills' => $this->bills->get_bill_count(),
            'paid_bills' => $this->bills->get_bill_count('status = 1'),
            'unpaid_bills' => $this->bills->get_bill_count('status = 0'),
            'total_amount' => $this->bills->get_total_billing_amount_by_status(),
            'total_paid_amount' => $this->bills->get_total_billing_amount_by_status(1),
            'total_unpaid_amount' => $this->bills->get_total_billing_amount_by_status(0),
            'customer_list' => $this->customers->get_customer_list(),
            'get_summary_chart_data' => base_url('dashboard/get_summary_chart_data'),
        ];

        $billing_summary_axis = [];
        for ($i = 29; $i >= 0; $i--) {
            if ($i % 5 == 0) {
                $time = '"' . date('M j', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y'))) . '"';
            } else {
                $time = '""';
            }
            $billing_summary_axis[] = $time;
        }

        $data['billing_summary_axis'] = $billing_summary_axis;

        $billing_paid_value = [];
        $billing_unpaid_value = [];
        for ($i = 29; $i >= 0; $i--) {
            $time = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y')));
            $paid_amount = $this->bills->get_total_billing_amount_by_status(1, $time);
            $billing_paid_value[] = $paid_amount;
            $unpaid_amount = $this->bills->get_total_billing_amount_by_status(0, $time);
            $billing_unpaid_value[] = $unpaid_amount;
        }

        $data['billing_summary_paid'] = $billing_paid_value;
        $data['billing_summary_unpaid'] = $billing_unpaid_value;

        $bill_axis = [];
        for ($i = 29; $i >= 0; $i--) {
            if ($i % 7 == 0) {
                $time = '"' . date('M j', mktime(0, 0, 0, date('m'), date('d') - $i, date('y'))) . '"';
            } else {
                $time = '""';
            }
            $bill_axis[] = $time;
        }

        $data['bill_axis'] = $bill_axis;

        $paid_bill = [];
        $unpaid_bill = [];
        for ($i = 29; $i >= 0; $i--) {
            $time = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y')));
            $paid = $this->bills->get_bill_count('status = 1 AND bill_date = "' . $time . '"');
            $paid_bill[] = $paid;
            $unpaid = $this->bills->get_bill_count('status = 0 AND bill_date = "' . $time . '"');
            $unpaid_bill[] = $unpaid;
        }
        $data['paid_bill'] = $paid_bill;
        $data['unpaid_bill'] = $unpaid_bill;
        
        $products_axis = $this->bills->get_products_list_for_chart();
        $data['products_axis'] = $products_axis;

        $products_paid = [];
        $products_unpaid = [];
        $products_confirmed = [];
        for ($i = 0, $l = count($products_axis); $i < $l; $i++) {
            $item_paid = $this->bills->get_amount_per_product(1, substr($products_axis[$i], 1, -1));
            $products_paid[] = $item_paid;
            $item_unpaid = $this->bills->get_amount_per_product(0, substr($products_axis[$i], 1, -1));
            $products_unpaid[] = $item_unpaid;
            $item_confirmed = $this->bills->get_amount_per_product(2, substr($products_axis[$i], 1, -1));
            $products_confirmed[] = $item_confirmed;
        }

        $data['products_paid'] = $products_paid;
        $data['products_unpaid'] = $products_unpaid;
        $data['products_confirmed'] = $products_confirmed;

        $this->load->view('includes/header', $header_data);
        $this->load->view('dashboard/admin_dashboard', $data);
        $this->load->view('includes/footer');
    }

    public function get_summary_chart_data()
    {
        if ($this->input->post()) {
            $req = $this->input->post();
            $start = $req['start'];
            $end = $req['end'];

            $count = get_diff_between_two_dates($start, $end);

            $billing_summary_axis = [];
            for ($i = $count; $i >= 0; $i--) {
                if ($i % 5 == 0) {
                    $time = date('M j', strtotime($end) - $i * 60 * 60 * 24);
                } else {
                    $time = '';
                }
                $billing_summary_axis[] = $time;
            }

            $data['axis'] = $billing_summary_axis;

            $billing_paid_value = [];
            $billing_unpaid_value = [];
            for ($i = $count; $i >= 0; $i--) {
                $time = date('Y-m-d', strtotime($end) - $i * 60 * 60 * 24);
                $paid_amount = $this->bills->get_total_billing_amount_by_status(1, $time);
                $billing_paid_value[] = $paid_amount;
                $unpaid_amount = $this->bills->get_total_billing_amount_by_status(0, $time);
                $billing_unpaid_value[] = $unpaid_amount;
            }

            $data['paid'] = $billing_paid_value;
            $data['unpaid'] = $billing_unpaid_value;
            $data['result'] = 'success';
            echo json_encode($data);
            return;
        }
    }

    public function customer()
    {
        $header_data = [
            'menu' => 'dashboard',
            'title' => 'Tablero de mandos',
        ];

        $customer_id = current_customer_id();
        $customer_info = $this->customers->get_customer_by_id($customer_id);
        $percent = $customer_info['goal_status'] / $customer_info['goal'] * 100.0;
        $percent = $percent > 100 ? 100 : ceil($percent);

        $data = [
            'my_goal' => $this->customers->get_customer_goal($customer_id),
            'total_bills' => $this->bills->get_bill_count('user_id = ' . $customer_id),
            'total_paid_amount' => $this->bills->get_total_billing_amount_by_status(1, '', $customer_id),
            'total_unpaid_amount' => $this->bills->get_total_billing_amount_by_status(0, '', $customer_id),
            'goal_status_percent' => $percent,
            'bill_list' => $this->bills->get_bill_list('user_id = ' . $customer_id, 3, 0, 'bill_date', 'desc'),
            'get_history_chart_data' => base_url('dashboard/get_history_chart_data'),
        ];

        $bill_history_axis = [];
        for ($i = 14; $i >= 0; $i--) {
            if ($i % 2 == 1) {
                $time = '"' . date('M j', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y'))) . '"';
            } else {
                $time = '""';
            }
            $bill_history_axis[] = $time;
        }

        $data['bill_history_axis'] = $bill_history_axis;

        $billing_paid_value = [];
        $billing_unpaid_value = [];
        $billing_confirmed_value = [];
        for ($i = 14; $i >= 0; $i--) {
            $time = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y')));
            $paid_amount = $this->bills->get_total_billing_amount_by_status(1, $time, $customer_id);
            $billing_paid_value[] = $paid_amount;
            $unpaid_amount = $this->bills->get_total_billing_amount_by_status(0, $time, $customer_id);
            $billing_unpaid_value[] = $unpaid_amount;
            $confirmed_amount = $this->bills->get_total_billing_amount_by_status(2, $time, $customer_id);
            $billing_confirmed_value[] = $confirmed_amount;
        }

        $data['billing_history_paid'] = $billing_paid_value;
        $data['billing_history_unpaid'] = $billing_unpaid_value;
        $data['billing_history_confirmed'] = $billing_confirmed_value;

        $products_axis = $this->bills->get_products_list_for_chart();
        $data['products_axis'] = $products_axis;
        
        $products_paid = [];
        $products_unpaid = [];
        $products_confirmed = [];
        for ($i = 0, $l = count($products_axis); $i < $l; $i++) {
            $item_paid = $this->bills->get_amount_per_product(1, substr($products_axis[$i], 1, -1), $customer_id);
            $products_paid[] = $item_paid;
            $item_unpaid = $this->bills->get_amount_per_product(0, substr($products_axis[$i], 1, -1), $customer_id);
            $products_unpaid[] = $item_unpaid;
            $item_confirmed = $this->bills->get_amount_per_product(2, substr($products_axis[$i], 1, -1), $customer_id);
            $products_confirmed[] = $item_confirmed;
        }

        $data['products_paid'] = $products_paid;
        $data['products_unpaid'] = $products_unpaid;
        $data['products_confirmed'] = $products_confirmed;

        $this->load->view('includes/header', $header_data);
        $this->load->view('dashboard/customer_dashboard', $data);
        $this->load->view('includes/footer');
    }

    public function get_history_chart_data()
    {
        if ($this->input->post()) {
            $req = $this->input->post();
            $start = $req['start'];
            $end = $req['end'];

            $count = get_diff_between_two_dates($start, $end);
            $customer_id = current_customer_id();
            $bill_history_axis = [];
            for ($i = $count; $i >= 0; $i--) {
                if ($i % 2 == 1) {
                    $time = date('M j', strtotime($end) - $i * 60 * 60 * 24);
                } else {
                    $time = '';
                }
                $bill_history_axis[] = $time;
            }

            $data['axis'] = $bill_history_axis;

            $billing_paid_value = [];
            $billing_unpaid_value = [];
            $billing_confirmed_value = [];
            for ($i = $count; $i >= 0; $i--) {
                $time = date('Y-m-d', strtotime($end) - $i * 60 * 60 * 24);
                $paid_amount = $this->bills->get_total_billing_amount_by_status(1, $time, $customer_id);
                $billing_paid_value[] = $paid_amount;
                $unpaid_amount = $this->bills->get_total_billing_amount_by_status(0, $time, $customer_id);
                $billing_unpaid_value[] = $unpaid_amount;
                $confirmed_amount = $this->bills->get_total_billing_amount_by_status(2, $time, $customer_id);
                $billing_confirmed_value[] = $confirmed_amount;
            }

            $data['paid'] = $billing_paid_value;
            $data['unpaid'] = $billing_unpaid_value;
            $data['confirmed'] = $billing_confirmed_value;
            $data['result'] = 'success';
            echo json_encode($data);
            return;
        }
    }
}
