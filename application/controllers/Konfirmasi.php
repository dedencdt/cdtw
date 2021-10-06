<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['komisi_m', 'expdate_m', 'user_m']);
        set_timezone();
        check_not_login();
        check_admin();
    }

    public function index()
    {
        $this->template->load('template', 'konf/konf_data');
    }
}
