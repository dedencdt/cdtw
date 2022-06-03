<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
        check_not_login();
        check_role(2);
        $this->load->model(['langganan_m', 'expdate_m', 'user_m', 'subs_m']);
    }

    public function index()
    {
        $basepage = 'subs/index/'; // url sampai segment (2)
        $per_page = 15; // masukan baris limit data

        $id = $this->fungsi->user_login()->user_id;
        // $langganan = $this->subs_m->getuser($id);
        $expdate = $this->expdate_m->get();
        $data = [
            // 'row' => $langganan,
            'expdate' => $expdate

        ];

        $data['keyword'] = null;
        //configurasi pagination
        $config['total_rows'] = $this->subs_m->countAllSUBS($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];

        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->subs_m->getDataSUBS($config['per_page'], $data['start'], $data['keyword'],  $id)->result();

        $this->template->load('template', 'member/subs/subs_data', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            // input data ke databse
            $this->langganan_m->add($post);
        }
        // Keterangan
        $exharga = explode('|', $post['exp_date']);
        $nameuser = $this->getdatauser($post['user_id'])->nama;
        $tgldibuat = date('Y-m-d H:i:s');
        $paymentmethod = $post['paymethod'];
        $tagihan = number_format($exharga[1]);
        $urlwa = 'https://wa.me/6282210348224?text=' . urlencode("Saya ingin perpanjang langganan dengan potong komisi , dengan no: invoice " . $post['invoice'] . "");

        // text email
        $msg = "
        YTH $nameuser , <br>
        Ini adalah pemberitahuan bahwa faktur langganan member telah dibuat $tgldibuat.<br>
        Metode Pembayaran Anda adalah : $paymentmethod ( Manual ), <br><br>
        Invoice : " . $post['invoice'] . " <br>
        Jumlah Tagihan : Rp. $tagihan <br>

        <h2>Cara Pembayaran  Via Transfer </h2>
        Transfer Tagihan sesuai dengan jumlah yang tetera , Kirim ke Rekening : <br>
        <strong>
        BANK JAGO : 1011 2158 1208 A.n MUJAHID HIJBULLAH 
        </strong> 

        <h2>Cara Pembayaran via Potong Komisi </h2>
        Langsung ke konfirmasi pembayaran dengan, ikuti petunjuk <strong>Cara Konfirmasi pembayaran</strong>

        <h2>Cara Konfirmasi Pembayaran</h2>
        Setelah melakukan Pembayaran, Silahkan konfirmasi melalui :
        <ul>
        <li>
        <strong>Live chat</strong> yang ada di pojok kanan bawah
        </li>
        <li>
        Atau Chat Bagian Keuangan : <a href='$urlwa'>Klik disini</a>
        </li>
        </ul>
        ";
        $subject = "Perpanjangan langganan - invoice #" . $post['invoice'];
        $emailto = $this->getdatauser($post['user_id'])->email;

        if ($this->db->affected_rows() > 0) {
            // if ($this->fungsi->sendEmail($subject, $emailto, $msg) != true) {
            //     redirect('subs');
            // }

            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        redirect('subs');
    }


    function getdatauser($id)
    {
        $query = $this->db->query("SELECT * FROM tb_user WHERE user_id = '$id'");

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}
