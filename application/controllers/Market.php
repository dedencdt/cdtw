<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Market extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
        check_role(2);
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
        } elseif (isset($_POST['deletelink'])) {
            $this->market_m->updatelinktodel($post);
        }

        if ($this->db->affected_rows() > 0) {
            // $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        echo "<script>window.location = document.referrer</script>";
        // redirect('market/link');
    }

    // Page untuk membuat file txt prelander
    public function exporthtml($id = null)
    {
        $data['row'] = $this->db->query("SELECT f.frame_id, p.nama_produk, p.desk, p.harga,l.vc, l.atc FROM m_frame AS f JOIN tb_produk AS p ON p.produk_id = f.produk_id JOIN p_linkproduk AS l ON l.produk_id = f.produk_id WHERE frame_id = '$id' ")->row();
        $namaFile = "cdt-prelander-html-{$id}.txt";
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=" . $namaFile);
        $this->load->view('member/market/market_prelanders', $data);
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
