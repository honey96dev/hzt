<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('notifications_model', 'notifications');
    }

    public function mark_all_as_read() {
        if ($this->input->post()) {
            $user_id = $this->input->post('user_id');
            $result = $this->notifications->mark_as_all($user_id);
            echo json_encode($result);
        } else {
            echo json_encode(['result' => 'error']);
        }
        return;
    }
}
