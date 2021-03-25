<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('customers_model', 'customers');
		$this->load->model('bills_model', 'bills');
	}

	public function index()
	{
		$header_data = [
			'menu' => 'dashboard',
			'title' => 'Dashboard'
		];
		
		$data = [
			'total_customers' 	=> $this->customers->get_customer_count(),
			'total_bills'		=> $this->bills->get_bill_count(),
			'paid_bills'		=> $this->bills->get_bill_count('status = 1'),
			'unpaid_bills'		=> $this->bills->get_bill_count('status = 0'),
			'total_amount'		=> $this->bills->get_total_billing_amount_by_status(),
			'total_paid_amount'	=> $this->bills->get_total_billing_amount_by_status(1),
			'total_unpaid_amount'	=> $this->bills->get_total_billing_amount_by_status(0),
			'customer_list'			=> $this->customers->get_customer_list()
		];

		$billing_summary_axis = [];
		for ($i = 29; $i >= 0; $i--) {
			if ($i % 5 == 0) {
				$time = '"'. date('M j', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y'))) . '"';
			} else {
				$time = '""';
			}
			$billing_summary_axis[] = $time;
		}

		$data['billing_summary_axis'] = $billing_summary_axis;

		$billing_paid_value = [];
		$billing_unpaid_value = [];
		for($i = 29; $i >= 0; $i--) {
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
				$time = '"'. date('M j', mktime(0, 0, 0, date('m'), date('d') - $i, date('y'))) . '"';
			} else {
				$time = '""';
			}
			$bill_axis[] = $time;
		}

		$data['bill_axis'] = $bill_axis;

		$paid_bill = [];
		$unpaid_bill = [];
		for($i = 29; $i >= 0; $i--) {
			$time = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y')));
			$paid = $this->bills->get_bill_count('status = 1 AND bill_date = "' . $time . '"');
			$paid_bill[] = $paid;
			$unpaid = $this->bills->get_bill_count('status = 0 AND bill_date = "' . $time . '"');
			$unpaid_bill[] = $unpaid;
		}
		$data['paid_bill'] = $paid_bill;
		$data['unpaid_bill'] = $unpaid_bill;

		$this->load->view('includes/header', $header_data);
		$this->load->view('dashboard/admin_dashboard', $data);
		$this->load->view('includes/footer');
	}
}
