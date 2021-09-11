<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komisi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['komisi_m', 'expdate_m', 'user_m']);
        set_timezone();
        check_not_login();
        check_admin();
    }

    public function settanggal()
    {
        $basepage = 'komisi/settanggal/'; // url
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] = $this->komisi_m->countAll($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);


        //initialize
        $this->pagination->initialize($config);

        $data['total_rows'] = $this->komisi_m->countAll($data['keyword']);
        $data['row'] = $this->komisi_m->getData($config['per_page'], $data['start'], $data['keyword']);

        $this->template->load('template', 'komisi/settanggal_data', $data);
    }


    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->komisi_m->addTgl($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di simpan');
            }
            redirect('komisi/settanggal');
        } elseif (isset($_POST['editTgl'])) {
            $this->komisi_m->editTgl($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di simpan');
            }
            redirect('komisi/settanggal');
        } elseif (isset($_POST['konfirmasi'])) {
            $this->komisi_m->setConfStatus($post);
        }

        // if ($this->db->affected_rows() > 0) {
        //     $this->session->set_flashdata('success', 'Data berhasil di simpan');
        // }
        // redirect('komisi');
    }

    public function delTgl($id)
    {
        $this->komisi_m->delTgl($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di hapus');
        }
        redirect('komisi/settanggal');
    }
}
