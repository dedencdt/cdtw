<?php

class Packing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_role(5);
        $this->load->model(['orders_m', 'produk_m']);
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

        $this->template->load('template', 'orders/packing/order_packing', $data);
    }

    public function toexcel()
    {
        $status = 'packing';
        $filename = date('Y-m-d') . '-codtech-orderan' .  '.xls';
        $inorder = $this->orders_m->getOrderan($status, 10);
        $data = [
            'row' => $inorder->result()
        ];
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/vnd.ms-excel");
        $this->load->view('orders/cs/order_toexcel', $data);
    }

    public function process()
    {
        $post = $this->input->post(NULL, TRUE);
        if (isset($_POST['editResi'])) {

            $this->orders_m->editOrderan($post);
            $this->orders_m->editInOrderStatus($post);
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        echo "<script>
        window.location = document.referrer;
        </script>";
    }
}
