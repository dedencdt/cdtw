<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
        check_not_login();
        $this->load->model(['langganan_m', 'expdate_m', 'user_m', 'subs_m', 'manage_m']);
    }

    public function checkorder()
    {
        $basepage = 'manage/cekorders/'; // url
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] = $this->manage_m->countAllCEK($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];


        //initialize
        $this->pagination->initialize($config);
        $data['row'] = $this->manage_m->getDataCEK($config['per_page'], $data['start'], $data['keyword']);
        $this->template->load('template', 'manage/order_check', $data);
    }
}
