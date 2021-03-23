<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Goals_model extends CI_Model
{
    public $table = '';

    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }
}
