<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expdate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('expdate_m');
        set_timezone();
        check_not_login();
        check_admin();
    }

    public function index()
    {
        $data['row'] = $this->expdate_m->get();
        $this->template->load('template', 'langganan/expdate/expdate_data', $data);
    }

    public function add()
    {
        $expdate = new stdClass;
        $expdate->expdate_id = null;
        $expdate->exp_date = null;
        $expdate->harga = null;
        $data = [
            'page' => 'add',
            'row' => $expdate
        ];

        $this->template->load('template', 'langganan/expdate/expdate_form', $data);
    }

    public function edit($id)
    {

        $query = $this->expdate_m->get($id);

        if ($query->num_rows() > 0) {
            $data = [
                'page' => 'edit',
                'row' => $query
            ];
            $data['row'] = $query->row();
            $this->template->load('template', 'langganan/expdate/expdate_form', $data);
        } else {
            echo "<script>alert('Data tidak di temuka');
                    window.location = '" . site_url('expdate') . "'
                </script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->expdate_m->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->expdate_m->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        redirect('expdate');
    }

    public function del($id)
    {
        $this->expdate_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di di hapus');
        }
        redirect('expdate');
    }
}
