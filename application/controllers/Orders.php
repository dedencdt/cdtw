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
        $this->load->model(['orders_m']);
        $this->url = $this->setter->get_apiwc_url();
        $this->consumer_key = $this->setter->get_apiwc_ck();
        $this->consumer_secret = $this->setter->get_apiwc_sk();
    }

    public function index()
    {

        $woocommerce = new Client($this->url, $this->consumer_key, $this->consumer_secret, ['version' => 'wc/v3']);
        $param = [
            'status' => 'processing'
        ];

        $data = [
            'row' => $woocommerce->get('orders', $param)
        ];
        $this->template->load('template', 'orders/cs/order_data', $data);
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


    public function process()
    {
        $woocommerce = new Client($this->url, $this->consumer_key, $this->consumer_secret);
        $post = $this->input->post(null, TRUE);
        $endpoint = 'orders/' . $this->input->post('order_id');

        if (isset($_POST['followup'])) {
            $data = [
                'status' => 'on-hold'
            ];
            $this->orders_m->add($post);
            $this->orders_m->addToOrderanFromFP($post);
            $woocommerce->put($endpoint, $data);
        } elseif (isset($_POST['edit'])) {
            $this->orders_m->edit($post);
        } elseif (isset($_POST['ubahstatus'])) {
            $this->orders_m->editFromOrderan($post);
            $this->orders_m->editToOrderan($post);
        } elseif (isset($_POST['editResi'])) {
            $this->orders_m->editOrderan($post);
            $this->orders_m->editInOrderStatus($post);
        } elseif (isset($_POST['lastedit'])) {
            $data = [
                'status' => $this->input->post('status')
            ];
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


/**
 * 
  <?php
                        $no = 1;
                        foreach ($row as $data) : ?>
                            <tr>
                                <td> <?= $no++ ?></td>
                                <td> <?= $data->order_id ?></td>
                                <td> <?= $data->nama_produk ?></td>
                                <td> <?= $data->status ?></td>
                                <td> <?= $data->penerima ?></td>
                                <td> <?= $data->alamat ?></td>
                                <td> <?= $data->nowa ?></td>
                                <td> <?= $data->total ?></td>
                                <td> <?= $data->created_at ?></td>
                                <td>
                                    <?php
                                    // TEKS WHATSAPP
                                    $text = "Hai ka {$data->penerima} , pesanannya sudah kami terima,\r \n \r \n*Details Order* \r \n *InvoiceID* : #{$data->order_id}\r \n *Pesanan* : {$data->nama_produk}\r \n *Harga* : {$data->ongkir}  \r \n *Ongkir* : {$data->ongkir}  \r \n *Total* : {$data->total} \r \n \r \n*Detail Alamat* \r \n *Penerima* : {$data->penerima} \r \n*No. Whatsapp* : {$data->nowa} \r \n *Alamat* : {$data->alamat} \r \n \r \n Jika data sudah benar silahkan *konfirmasi* agar segera kami proses untuk pengiriman.\r \n\r \n _note*_ : _jika ada data yang salah mohon kirimkan data validnya ke nomer ini, Terimakasih_ 
                                        ";

                                    ?>

                                    <div class="row">
                                        <a href="<?= $this->fungsi->sendwa($data->nowa, $text) ?>" target="_blank">
                                            <button class="btn btn-success"><i class="fab fa-whatsapp"></i> Follow up</button>
                                        </a>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#detailorder<?= $data->in_order_id ?>"><i class=" fa fa-info"></i> Edit</button>
                                        <!-- UBAH STATUS -->
                                        <form action="<?= site_url('orders/process') ?>" method="post">
                                            <!-- data optional -->

                                            <!-- data hidden for orderan -->
                                            <input type="hidden" name="orderan_id" value="<?= random_string('alnum', 10) ?>">
                                            <input type="hidden" name="in_order_id" value="<?= $data->in_order_id ?>">
                                            <input type="hidden" name="vendor_id" value="<?= $this->fungsi->getVendorOrder($data->produk_id)->vendor_id ?>">
                                            <div class="input-group">
                                                <select class="custom-select" id="status" name="status" required>
                                                    <option value="">- status -</option>
                                                    <option value="packing">Packing</option>
                                                    <option value="junk">Junk Order</option>
                                                    <option value="cencelled">Cencelled</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn text-gray-100 bg-warning" type="submit" name="ubahstatus">Ubah</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- modal mulai -->
                            <div class="row">
                                <div class="col">
                                    <div class="modal fade" id="detailorder<?= $data->in_order_id ?>" tabindex="-1" aria-labelledby="detailorder<?= $data->in_order_id ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailorder<?= $data->in_order_id ?>Label"><strong>Perbarui Informasi</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= site_url('orders/process') ?>" method="post">
                                                    <div class="modal-body">
                                                        <!-- hidden ID -->
                                                        <div class="form-group">
                                                            <label for="in_order_id" class="col-form-label">Invoice ID</label>
                                                            <span>#<?= $data->order_id ?></span>
                                                            <input type="hidden" class="form-control" id="in_order_id" name="in_order_id" value="<?= $data->in_order_id ?>" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="penerima" class="col-form-label">Nama penerima</label>
                                                            <input type="text" class="form-control" id="penerima" name="penerima" value="<?= $data->penerima ?>" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nowa" class="col-form-label">No. Hp</label>
                                                            <input type="text" class="form-control" id="nowa" name="nowa" value="<?= $data->nowa ?>" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat" class="col-form-label">Alamat penerima</label>
                                                            <textarea class="form-control" id="alamat" name="alamat"><?= $data->alamat ?></textarea>
                                                            <span class="text-sm"><strong>note* :</strong><em>Perhatikan penulis alamat saat mengedit, pastikan sesuai format <br>
                                                                    Format : <strong><em>Desa/dusun/jalan</em>-</strong><strong><em>Kecamatan,Kota</em>-</strong><strong><em>Kota</em>-</strong>
                                                                </em></span><strong><em>Provinsi</em>-</strong><strong><em>Kodepost</em></strong>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal end -->
                        <?php endforeach; ?>
 */
