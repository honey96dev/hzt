<?php

function generate_password($password = '')
{
    return md5($password);
}

function verify_password($password = '', $current_password = '')
{
    return (md5($password) == $current_password);
}

function show_date($date_str)
{
    return date("j F, Y", (int) strtotime($date_str));
}

function show_datetime($datetime_str)
{
    return date("j F, Y, g:i a", (int) strtotime($datetime_str));
}

function is_admin()
{
    $CI = &get_instance();
    if (!$CI->session->has_userdata('user') || !$CI->session->user['role']) {
        return false;
    }
    return true;
}

function get_pendinng_customers()
{
    $CI = &get_instance();
    $CI->load->model('customers_model', 'customers');
    return $CI->customers->get_customer_count('status = 0');
}

function show_number($number)
{
    return number_format($number, 2, '.', ',');
}

function current_customer_id()
{
    $CI = &get_instance();
    if (!$CI->session->has_userdata('user')) {
        return 0;
    }
    return $CI->session->user['id'];
}

function get_new_notify_count()
{
    $CI = &get_instance();
    $CI->load->model('notifications_model', 'notifications');
    return $CI->notifications->get_unread_notifications_count($CI->session->user['id']);
}

function get_notify()
{
    $CI = &get_instance();
    $CI->load->model('notifications_model', 'notifications');
    return $CI->notifications->get_notification_list($CI->session->user['id']);
}

function get_diff_between_two_dates($start, $end)
{
    $ts1 = strtotime($start);
    $ts2 = strtotime($end);

    return round(($ts2 - $ts1) / (60 * 60 * 24));
}
