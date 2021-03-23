<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public $table = '';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
        $this->load->model('customers_model', 'customers');
    }

    /**
     * @return  {Array} ['result' => error | success, 'msg' => status message]
     * @param   {Array} Login user information
     */
    public function verify_user($login_data = [])
    {
        if (empty($login_data)) {
            return [
                'result' => 'error',
                'msg' => 'Your information is not correct. Please check and try again.',
            ];
        }

        if ($this->customers->get_customer_by_email($login_data['identity']) === false &&
            $this->customers->get_customer_by_username($login_data['identity']) === false) {
            return [
                'result' => 'error',
                'msg' => 'Your username or email is not existed. Please signup and try again.',
            ];
        }

        $user_info = ($this->customers->get_customer_by_email($login_data['identity']) === false) ? 
            $this->customers->get_customer_by_username($login_data['identity']) : 
            $this->customers->get_customer_by_email($login_data['identity']);
        
        // Verify password
        if (!verify_password($login_data['password'], $user_info['password'])) {
            return [
                'result' => 'error',
                'msg' => 'Your information is not correct. Please check and try again.',
            ];
        }

        if (!$user_info['status']) {
            return [
                'result' => 'error',
                'msg' => 'Administrator is reviewing your information. Please try again later.',
            ];
        }

        $this->session->set_userdata(['user' => $user_info]);
        return [
            'result'    => 'success'
        ];
    }
}
