<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
        check_not_login();
        $this->load->model(['langganan_m', 'expdate_m', 'user_m', 'subs_m']);
    }

    public function index()
    {


        $id = $this->fungsi->user_login()->user_id;
        $langganan = $this->subs_m->getuser($id);
        $expdate = $this->expdate_m->get();
        $data = [
            'row' => $langganan,
            'expdate' => $expdate

        ];
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
