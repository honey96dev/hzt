<?php

function generate_password($password = '') {
    return md5($password);
}

function verify_password($password = '', $current_password = '') {
    return (md5($password) == $current_password);
}

function show_date($date_str) {
    return date("j F, Y", (int)strtotime($date_str));
}

function show_datetime($datetime_str) {
    return date("j F, Y, g:i a", (int)strtotime($datetime_str));
}

function is_admin() {
    $CI =& get_instance();
    if (!$CI->session->has_userdata('user') || !$CI->session->user['role']) {
        return false;
    }
    return true;
}

function get_pendinng_customers() {
    $CI =& get_instance();
    $CI->load->model('customers_model', 'customers');
    return $CI->customers->get_customer_count('status = 0');
}
?>