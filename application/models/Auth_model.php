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

        $this->session->set_userdata('user', $user_info);
        return [
            'result' => 'success',
        ];
    }
    /**
     * @return  Array   Signup Result ['result' => success | error, 'msg' => 'Successful']
     * @param   Array   Signup customer data
     */
    public function signup($signup_data = [])
    {
        if (empty($signup_data)) {
            return [
                'result' => 'error',
                'msg' => 'Your information is not correct. Please check and try again.',
            ];
        }

        if ($this->customers->get_customer_by_email($signup_data['user_name']) !== false ||
            $this->customers->get_customer_by_username($signup_data['email']) !== false) {
            return [
                'result' => 'error',
                'msg' => 'Your username or email is existed already. Please try again.',
            ];
        }

        $new_customer_data = [
            'user_name' => $signup_data['user_name'],
            'first_name'    => $signup_data['first_name'],
            'surname'       => $signup_data['surname'],
            'email'         => $signup_data['email'],
            'password'      => generate_password($signup_data['password']),
            'role'          => 0,
            'status'        => 0,
            'goal'          => 0,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        if ($this->db->insert($this->table, $new_customer_data)) {
            return [
                'result' => 'success'
            ];
        } else {
            return [
                'result' => 'error',
                'msg' => 'You cannot signup currently. Please check and try again.',
            ];
        }
    }

    public function change($user_id = 0, $settings = []) {
        if ($user_id == 0) {
            return ['result' => 'error'];
        }

        $origin_user = $this->customers->get_customer_by_id($user_id);

        if ($settings['current_password'] != '' && !verify_password($settings['current_password'], $origin_user['password'])) {
            return ['result' => 'failed'];
        }

        $new_settings = [
            'user_name' => $settings['username'],
            'first_name' => $settings['first_name'],
            'surname' => $settings['last_name'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($settings['current_password'] != '') {
            $new_settings['password'] = generate_password($settings['password']);
        }

        if ($this->db->update($this->table, $new_settings, ['id' => $user_id])) {
            return ['result' => 'success'];
        } else {
            return ['result' => 'error'];
        }
    }
}
