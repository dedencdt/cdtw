<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Market extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
        check_not_login();
        $this->load->model(['produk_m', 'linkproduk_m', 'market_m']);
    }

    public function index()
    {
        check_memberaktif();
        $data['row'] = $this->market_m->getproduk();
        $this->template->load('template', 'member/market/market_data', $data);
    }

    public function link($id = null)
    {
        $user_id = $this->fungsi->user_login()->user_id;
        $produk = $this->market_m->getformarket('tb_produk', $id)->row();
        $linkproduk = $this->market_m->getformarket('p_linkproduk', $id)->row();
        $marketlink = $this->market_m->getmarketlink(null, $id, $user_id);
        $data = [
            'row' => $marketlink,
            'produk' => $produk,
            'linkproduk' => $linkproduk
        ];
        $this->template->load('template', 'member/market/market_link', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->market_m->addframe($post);
            $this->market_m->addmarketlink($post);
        } elseif (isset($_POST['edit'])) {
            $this->market_m->editframe($post);
        }

        if ($this->db->affected_rows() > 0) {
            // $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        echo "<script>window.location = document.referrer</script>";
        // redirect('market/link');
    }

    // Page untuk membuat file txt prelander
    public function export($id = null)
    {
        $namaFile = 'cdt-prelander.txt';
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=" . $namaFile);
        echo "ini data TXT";
    }

    public function del($id)
    {
        $this->market_m->del($id);
        if ($this->db->affected_rows() > 0) {
            // $this->session->set_flashdata('success', 'Data berhasil di di hapus');
        }
        echo "<script>window.location = document.referrer</script>";
    }

    // setting Frame pixel
    public function frame($id = null)
    {
        $data['row'] = $this->market_m->getframe($id)->row();
        $this->load->view('member/market/market_pxframe', $data);
    }
}
