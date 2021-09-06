<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['vendor_m', 'user_m', 'produk_m']);
        check_not_login();
        check_admin();
    }


    public function data()
    {
        $data['row'] = $this->vendor_m->get();
        $this->template->load('template', 'vendor/vendor_data', $data);
    }

    public function add()
    {
        $vendor = new stdClass;
        $vendor->vendor_id = null;
        $vendor->user_id = null;
        $vendor->produk_id = null;
        $roleVendor = $this->vendor_m->get_vendor()->result();
        $produk = $this->produk_m->get()->result();
        $data = [
            'page' => 'add',
            'vendor' => $roleVendor,
            'produk' => $produk,
            'row' => $vendor
        ];

        $this->template->load('template', 'vendor/vendor_form', $data);
    }

    public function edit($id)
    {
        $query = $this->vendor_m->get($id);

        $roleVendor = $this->vendor_m->get_vendor();
        $produk = $this->produk_m->get();
        if ($query->num_rows() > 0) {
            $data = [
                'page' => 'edit',
                'vendor' => $roleVendor->result(),
                'produk' => $produk->result(),
                'row' => $query
            ];
            $data['row'] = $query->row();
            $this->template->load('template', 'vendor/vendor_form', $data);
        } else {
            echo "<script>alert('Data tidak di temuka');
                    window.location = '" . site_url('vendor/data') . "'
                </script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->vendor_m->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->vendor_m->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        redirect('vendor/data');
    }

    public function del($id)
    {
        $this->vendor_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di di hapus');
        }
        redirect('vendor/data');
    }
}
