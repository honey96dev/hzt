<?php

function generate_password($password = '') {
    return md5($password);
}

function verify_password($password = '', $current_password = '') {
    return (md5($password) == $current_password);
}

?>