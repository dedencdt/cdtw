<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Automattic\WooCommerce\Client;

class Orders extends CI_Controller
{

    protected $url,
        $consumer_key, // Dari web Lokal
        $consumer_secret;

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_cs();
        $this->load->model(['orders_m', 'komisi_m']);
        $this->url = $this->setter->get_apiwc_url();
        $this->consumer_key = $this->setter->get_apiwc_ck();
        $this->consumer_secret = $this->setter->get_apiwc_sk();
    }

    public function index()
    {

        // $woocommerce = new Client($this->url, $this->consumer_key, $this->consumer_secret, ['version' => 'wc/v3']);
        // $param = [
        //     'status' => 'processing'
        // ];

        // $data = [
        //     'row' => $woocommerce->get('orders', $param)
        // ];
        $this->getdatawoo();
        $data['row'] = $this->orders_m->getleadProcess();

        $this->template->load('template', 'orders/cs/order_data', $data);
    }

    function getdatawoo()
    {
        $woocommerce = new Client($this->url, $this->consumer_key, $this->consumer_secret, ['version' => 'wc/v3']);
        $param = [
            'status' => 'processing'
        ];

        $row = $woocommerce->get('orders', $param);

        // Looping data WC
        foreach ($row as $data) :
            // cek data order id 
            if ($this->check_axist_orderid($data->id) == false) :
                // data tanpa cs id
                $inorderid = 'cdt' . date('ymd') . random_string('alnum', 21);
                $orderanid = 'cdt' . date('ymd') . random_string('alnum', 21);

                $orderan = [
                    'orderan_id' => $orderanid,
                    'in_order_id' => $inorderid,
                    'status' => 'processing',
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $in_order = [
                    'in_order_id' => $inorderid,
                    'order_id' => $data->id,
                    'nama_produk' => $data->line_items[0]->name,
                    'status' => 'processing',
                    'penerima' => $data->billing->first_name,
                    'alamat' => $data->billing->address_1 . '~' . $data->billing->address_2 . '~' . $data->billing->city . '~' . $data->billing->state . '~' . $data->billing->postcode,
                    'nowa' => $data->billing->phone,
                    'frame_id' => $data->billing->company,
                    'harga' => $data->line_items[0]->price,
                    'ongkir' => $data->shipping_total,
                    'total' => $data->total,
                    'order_created' => $data->date_created,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->orders_m->grabwctoorderan($orderan);
                $this->orders_m->grabwctoinorder($in_order);

            endif;
        endforeach;
    }


    public function followup()
    {

        $basepage = 'orders/followup/'; // url sampai segment (2)
        $per_page = 15; // masukan baris limit data
        $status = 'on-hold';
        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $user = $this->fungsi->user_login()->user_id;

        $config['total_rows'] = $this->orders_m->countAllFD($data['keyword'], $user, $status); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];


        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->orders_m->getDataFD($config['per_page'], $data['start'], $data['keyword'], $user, $status)->result();
        $this->template->load('template', 'orders/cs/order_followup_data', $data);
    }

    public function cekorders()
    {

        $basepage = 'orders/cekorders/'; // url
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] = $this->orders_m->countAllCEK($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];


        //initialize
        $this->pagination->initialize($config);
        $data['row'] = $this->orders_m->getDataCEK($config['per_page'], $data['start'], $data['keyword']);
        $this->template->load('template', 'orders/cs/order_check', $data);
    }

    public function packing()
    {

        $basepage = 'orders/packing/'; // url sampai segment (2)
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

    public function cod()
    {
        $basepage = 'orders/cod/'; // url sampai segment (2)
        $per_page = 15; // masukan baris limit data 

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $status = 'delivery';
        $config['total_rows'] = $this->orders_m->countAllCOD($data['keyword'], $status); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];


        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->orders_m->getDataCOD($config['per_page'], $data['start'], $data['keyword'],  $status)->result();
        $this->template->load('template', 'orders/cs/order_cod', $data);
    }

    public function returnsale()
    {

        $basepage = 'orders/returnsale/'; // url sampai segment (2)
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $status = 'refunded';
        $config['total_rows'] = $this->orders_m->countAllRTS($data['keyword'], $status); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];


        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->orders_m->getDataRTS($config['per_page'], $data['start'], $data['keyword'],  $status)->result();
        $this->template->load('template', 'orders/cs/order_rts', $data);
    }

    public function delivered()
    {
        $basepage = 'orders/delivered/'; // url sampai segment (2)
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $status = 'completed';
        $config['total_rows'] = $this->orders_m->countAllOK($data['keyword'], $status); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];


        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->orders_m->getDataOK($config['per_page'], $data['start'], $data['keyword'],  $status)->result();
        $this->template->load('template', 'orders/cs/order_completed', $data);
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

    function check_axist_orderid($id)
    {
        $query = $this->db->query("SELECT * FROM tb_in_order WHERE order_id = '$id'");
        if ($query->num_rows() > 0) {
            // jika data order id sudah ada nilai TRUE
            return true;
        } else {
            // jika belum ada nilai False
            return false;
        }
    }

    function check_followupcs($id)
    {
        $query = $this->db->query("SELECT * FROM tb_in_order WHERE order_id = '$id' AND status='on-hold'");
        if ($query->num_rows() > 0) {
            // jika data order id sudah ada nilai TRUE
            return true;
        } else {
            // jika belum ada nilai False
            // data ok 
            // return pake FALSE 
            return false;
        }
    }

    public function process()
    {
        $woocommerce = new Client($this->url, $this->consumer_key, $this->consumer_secret);
        $post = $this->input->post(null, TRUE);
        $endpoint = 'orders/' . $this->input->post('order_id');

        if (isset($_POST['followup'])) {
            $data = [
                'status' => 'on-hold'
            ];
            if ($this->check_followupcs($post['order_id']) == false) {

                $this->orders_m->addcstoinorder($post);
                $this->orders_m->addToOrderanFromFP($post);
                $woocommerce->put($endpoint, $data);
            } else {
                echo "<script>
                   confirm('Follow Up data Gagal, orderan sudah di follow up cs lain');
                    </script>";
            }
        } elseif (isset($_POST['edit'])) {
            $this->orders_m->edit($post);
        } elseif (isset($_POST['ubahstatus'])) {
            if ($post['status'] == 'packing') {
                $this->orders_m->updatestockproduk($post);
            }
            $this->orders_m->editFromOrderan($post);
            $this->orders_m->editToOrderan($post);
        } elseif (isset($_POST['editResi'])) {
            $this->orders_m->editOrderan($post);
            $this->orders_m->editInOrderStatus($post);
        } elseif (isset($_POST['lastedit'])) {
            $data = [
                'status' => $this->input->post('status')
            ];
            if ($post['status'] == 'completed') {
                $this->orders_m->oktosiapcair($post);
            } else {
                $this->orders_m->updatestockminus($post);
                $this->orders_m->rtstosiapcair($post);
            }
            $this->orders_m->editClosingOrderan($post);
            $this->orders_m->editInOrderStatus($post);
            $woocommerce->put($endpoint, $data);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        echo "<script>
        window.location = document.referrer;
        </script>";
        // redirect('orders');
    }
    // ajax endpoint
}
