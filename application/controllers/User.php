<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->model('user_m');
        check_not_login();
        check_admin();
    }



    public function index()
    {
        // Configurasi Settingan
        $basepage = 'user/index/'; // url 
        $per_page = 10; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] =  $this->user_m->countAll($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;

        //initialize
        $this->pagination->initialize($config);

        // Send data
        $data['total_rows'] = $this->user_m->countAll($data['keyword']);
        $data['start'] = $this->uri->segment(3);
        $data['row'] = $this->user_m->getData($config['per_page'], $data['start'], $data['keyword']);
        $this->template->load('template', 'user/user_data', $data);
    }

    public function add()
    {

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_user.email]|valid_email');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('nohp', 'Nomer HP / Whatsapp', 'required');

        $this->form_validation->set_message('required', 'kolom <strong>%s</strong> tidak boleh kosong!!');
        $this->form_validation->set_message('is_unique', 'kolom <strong>%s</strong> sudah digunakan, silahkan ganti!!');
        $this->form_validation->set_message('matches', 'kolom <strong>%s</strong> harus sama dengan password');
        $this->form_validation->set_message('valid_email', '<strong>%s</strong> tidak valid, silahkan ganti!!');
        $this->form_validation->set_message('min_length', 'kolom <strong>%s</strong> minimal 5 karakter');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/user_form_add');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->user_m->add($post);

            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Data berhasil di tambah') </script>";
            }
            echo "<script> window.location = '" . site_url('user') . "' </script>";
        }
    }

    public function edit($id)
    {

        /**
         * Form Validation
         */
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_username_check');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');
        }
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('nohp', 'Nomer HP / Whatsapp', 'required');

        /**
         * Seting pesan eror
         */
        $this->form_validation->set_message('required', 'kolom <strong>%s</strong> tidak boleh kosong!!');
        $this->form_validation->set_message('is_unique', '<strong>%s</strong> sudah digunakan, silahkan ganti!!');
        $this->form_validation->set_message('matches', 'kolom <strong>%s</strong> harus sama dengan password');
        $this->form_validation->set_message('valid_email', '<strong>%s</strong> tidak valid, silahkan ganti!!');
        $this->form_validation->set_message('min_length', 'kolom <strong>%s</strong> minimal 5 karakter');


        if ($this->form_validation->run() == FALSE) {
            $query = $this->user_m->get($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->template->load('template', 'user/user_form_edit', $data);
            } else {
                echo "<script>alert('Data tidak di temuka');
                    window.location = '" . site_url('user') . "'
                </script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->user_m->edit($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil di simpan');
            }
            redirect('user');
        }
    }

    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tb_user WHERE username = '$post[username]' AND user_id != '$post[user_id]' ");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '<strong>%s</strong> sudah digunakan, silahkan ganti!!');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function del()
    {
        $id = $this->input->post('user_id', TRUE);
        $this->user_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di hapus');
        }
        redirect('user');
    }
}
