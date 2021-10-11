<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Langganan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['langganan_m', 'expdate_m', 'user_m']);
        set_timezone();
        check_not_login();
        check_admin();
    }

    public function index()
    {
        $basepage = 'langganan/index/'; // url
        $per_page = 10; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] = $this->langganan_m->countAll($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);


        //initialize
        $this->pagination->initialize($config);

        $data['total_rows'] = $this->langganan_m->countAll($data['keyword']);
        $data['row'] = $this->langganan_m->getData($config['per_page'], $data['start'], $data['keyword']);
        $this->template->load('template', 'langganan/langganan_data', $data);
    }


    public function add()
    {
        $langganan = new stdClass;
        $langganan->user_id = null;
        $langganan->durasi = null;
        $langganan->langganan_id = null;
        $langganan->status = null;
        $langganan->paymethod = null;
        $langganan->invoice = null;
        $expdate = $this->expdate_m->get();
        $user = $this->user_m->getmember();
        $data = [
            'page' => 'add',
            'row' => $langganan,
            'expdate' => $expdate,
            'user' => $user
        ];

        $this->template->load('template', 'langganan/langganan_form', $data);
    }

    public function edit($id = null)
    {

        $query = $this->langganan_m->get($id);
        $expdate = $this->expdate_m->get();
        $user = $this->user_m->getmember();

        if ($query->num_rows() > 0) {
            $data = [
                'page' => 'edit',
                'row' => $query,
                'user' => $user,
                'expdate' => $expdate
            ];
            $data['row'] = $query->row();
            $this->template->load('template', 'langganan/langganan_form', $data);
        } else {
            echo "<script>alert('Data tidak di temuka');
                    window.location = '" . site_url('langganan') . "'
                </script>";
        }

        $this->template->load('template', 'langganan/langganan_form', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->langganan_m->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->langganan_m->edit($post);
        } elseif (isset($_POST['konfirmasi'])) {
            $this->langganan_m->setConfStatus($post);

            // text to email
            $email = $post['email'];
            $username = $post['user_id'];
            $subject = "Pembayaran terkonfirmasi ";
            $msg = "
            <h2>Selamat Akun anda Telah Aktif</h2>
            akun dengan username : $username , telah aktif dan bisa mengakses semua fitur yang ada di website member.
            <br>Salam profit,, Gas Terus.
            ";


            if ($this->fungsi->sendEmail($subject, $email, $msg)) {
                return true;
            }
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        redirect('langganan');
    }

    public function del($id)
    {
        $this->langganan_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di hapus');
        }
        redirect('langganan');
    }

    /**
     * controller for user
     */

    public function view()
    {
        echo "langganan user";
    }
}
