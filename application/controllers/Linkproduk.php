<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Linkproduk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->model(['linkproduk_m', 'produk_m']);
        check_not_login();
        check_admin();
    }
    public function index()
    {
        $data['row'] = $this->linkproduk_m->get();
        $this->template->load('template', 'market/link/linkproduk_data', $data);
    }

    public function add()
    {
        $linkproduk = new stdClass;
        $linkproduk->linkproduk_id = null;
        $linkproduk->label = null;
        $linkproduk->vc = null;
        $linkproduk->atc = null;
        $linkproduk->prelander = null;
        $linkproduk->produk_id = null;
        $produk = $this->produk_m->get()->result();
        $data = [
            'page' => 'add',
            'row' => $linkproduk,
            'produk' => $produk
        ];

        $this->template->load('template', 'market/link/linkproduk_form', $data);
    }

    public function edit($id)
    {

        $query = $this->linkproduk_m->get($id);
        $produk = $this->produk_m->get()->result();

        if ($query->num_rows() > 0) {
            $data = [
                'page' => 'edit',
                'produk' => $produk,
                'row' => $query
            ];
            $data['row'] = $query->row();
            $this->template->load('template', 'market/link/linkproduk_form', $data);
        } else {
            echo "<script>alert('Data tidak di temuka');
                    window.location = '" . site_url('linkproduk') . "'
                </script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->linkproduk_m->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->linkproduk_m->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        redirect('linkproduk');
    }

    public function del($id)
    {
        $this->linkproduk_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di di hapus');
        }
        redirect('linkproduk');
    }
}
