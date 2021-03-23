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
?>