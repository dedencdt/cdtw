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
            $this->langganan_m->add($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        redirect('subs');
    }
}
