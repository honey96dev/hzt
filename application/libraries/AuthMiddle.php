<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthMiddle {
    /**
     * Check logged in user
     */
    public function auth_status() {
        $CI =& get_instance();
        $class_name = $CI->router->class;
        
        if ($class_name != "auth") {
            $CI->load->library('session');
            if (!$CI->session->has_userdata('user')) {
                redirect(base_url('auth'));
            }
        }
    }
}