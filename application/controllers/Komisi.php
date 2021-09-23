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

    public function datamember()
    {
        $basepage = 'komisi/datamember/'; // url
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] = $this->komisi_m->countAllDM($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);


        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->komisi_m->getDataDM($config['per_page'], $data['start'], $data['keyword']);
        $this->template->load('template', 'komisi/datakomisi_member', $data);
    }

    public function datacs()
    {
        $basepage = 'komisi/datacs/'; // url
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] = $this->komisi_m->countAllCS($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);


        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->komisi_m->getDataCS($config['per_page'], $data['start'], $data['keyword']);
        $this->template->load('template', 'komisi/datakomisi_cs', $data);
    }

    public function datavendor()
    {
        $basepage = 'komisi/datavendor/'; // url
        $per_page = 15; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] = $this->komisi_m->countAllVNDR($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);


        //initialize
        $this->pagination->initialize($config);

        $data['row'] = $this->komisi_m->getDataVNDR($config['per_page'], $data['start'], $data['keyword']);
        $this->template->load('template', 'komisi/datakomisi_vendor', $data);
    }

    public function printmember($id)
    {
        $filename = "komisi-member-cdt-" . date('Y-m-d') . '.xls';
        $data['row'] = $this->komisi_m->getId($id)->row();
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/vnd.ms-excel");
        $this->load->view('komisi/toxl_member', $data);
    }

    public function printcs($id)
    {
        $filename = "komisi-cs-cdt-" . date('Y-m-d') . '.xls';
        $data['row'] = $this->komisi_m->getId($id)->row();
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/vnd.ms-excel");
        $this->load->view('komisi/toxl_cs', $data);
    }

    public function printvendor($id)
    {
        $filename = "komisi-vendor-cdt-" . date('Y-m-d') . '.xls';
        $data['row'] = $this->komisi_m->getId($id)->row();
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/vnd.ms-excel");
        $this->load->view('komisi/toxl_vendor', $data);
    }

    public function salesmember($id)
    {
        $data['row'] = $this->komisi_m->getId($id)->row();

        $this->template->load('template', 'komisi/rekap_data_member', $data);
    }

    public function salescs($id)
    {
        $data['row'] = $this->komisi_m->getId($id)->row();

        $this->template->load('template', 'komisi/rekap_data_cs', $data);
    }

    public function salesvendor($id)
    {
        $data['row'] = $this->komisi_m->getId($id)->row();

        $this->template->load('template', 'komisi/rekap_data_vendor', $data);
    }


    public function wtfmember($id)
    {
        $data['row'] = $this->komisi_m->getId($id)->row();

        $this->template->load('template', 'komisi/wtfkomisi_data_member', $data);
    }


    public function wtfcs($id)
    {
        $data['row'] = $this->komisi_m->getId($id)->row();

        $this->template->load('template', 'komisi/wtfkomisi_data_cs', $data);
    }


    public function wtfvendor($id)
    {
        $data['row'] = $this->komisi_m->getId($id)->row();

        $this->template->load('template', 'komisi/wtfkomisi_data_vendor', $data);
    }

    public function waitingtotf()
    {
        $basepage = 'komisi/waitingtotf/'; // url
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

        $this->template->load('template', 'komisi/wtfkomisi_data', $data);
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
        } elseif (isset($_POST['savetokomisi'])) {
            // dari rekap member kirim data ke tb komisi member

            $this->komisi_m->addtoKomisimember($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di hapus');
            }
            echo "<script>
            window.location = document.referrer;
            </script>";
        } elseif (isset($_POST['savetokomisics'])) {
            // dari rekap cs kirim data ke tb komisi member

            $this->komisi_m->addtoKomisics($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di hapus');
            }
            echo "<script>
            window.location = document.referrer;
            </script>";
        } elseif (isset($_POST['savetokomisivendor'])) {
            // dari rekap cs kirim data ke tb komisi member

            $this->komisi_m->addtoKomisivendor($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di hapus');
            }
            echo "<script>
            window.location = document.referrer;
            </script>";
        } elseif (isset($_POST['memberwtf'])) {

            //    jika komisi tidak minus kirim ke
            if ($post['diterima'] > 0) {
                // cek data di total komisi
                $cekdata = $this->cek_data_totalkomisi($post['user_id']);
                if ($cekdata == false) {
                    // jika belum ada data ,mka bikin data baru
                    $this->komisi_m->sendkomisitotal($post);
                } else {
                    // jika sudah ada data
                    $this->komisi_m->updatekomisitotal($post);
                }

                // jika komisi minus
            } else {
                // kirim balik ke RTS
                $this->komisi_m->sendtorts($post);
            }
            // ubah status selesai
            $this->komisi_m->ubahstomember($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di hapus');
            }
            echo "<script>
            window.location = document.referrer;
            </script>";
        } elseif (isset($_POST['cswtf'])) {


            $cekdata = $this->cek_data_totalkomisi($post['user_id']);
            if ($cekdata == false) {
                // jika belum ada data ,mka bikin data baru
                $this->komisi_m->sendkomisitotal($post);
            } else {
                // jika data sudah ada 
                // update data komisitotal
                $this->komisi_m->updatekomisitotal($post);
            }
            // ubah status
            $this->komisi_m->ubahstocs($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di hapus');
            }
            echo "<script>
            window.location = document.referrer;
            </script>";
        } elseif (isset($_POST['vendorwtf'])) {


            $cekdata = $this->cek_data_totalkomisi($post['user_id']);
            if ($cekdata == false) {
                // jika belum ada data ,mka bikin data baru
                $this->komisi_m->sendkomisitotal($post);
            } else {
                // jika data sudah ada 
                // update data komisitotal
                $this->komisi_m->updatekomisitotal($post);
            }
            // ubah status
            $this->komisi_m->ubahstovendor($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di hapus');
            }
            echo "<script>
            window.location = document.referrer;
            </script>";
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

    // HELLP[ER]
    function cek_data_totalkomisi($userid)
    {
        $query = $this->db
            ->query("SELECT * FROM tb_totalkomisi WHERE user_id = '$userid'");
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
