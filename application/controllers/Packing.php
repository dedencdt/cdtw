<?php

class Packing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['orders_m']);
        $this->url = $this->setter->get_apiwc_url();
        $this->consumer_key = $this->setter->get_apiwc_ck();
        $this->consumer_secret = $this->setter->get_apiwc_sk();
    }
    public function index()
    {
        $basepage = 'packing/index/'; // url sampai segment (2)
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $status = 'packing';
        $config['total_rows'] = $this->orders_m->countAllPK($data['keyword'], $status); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];


        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->orders_m->getDataPK($config['per_page'], $data['start'], $data['keyword'],  $status)->result();

        $this->template->load('template', 'orders/cs/order_packing', $data);
    }
}
