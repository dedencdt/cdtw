<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {
        check_already_login();
        $this->load->view('auth/login');
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('user_m');
            $query =  $this->user_m->login($post);
            if ($query->num_rows() > 0) {

                //ambil bari data
                $row = $query->row();

                // buat data arrat session
                $params = array(
                    'user_id' => $row->user_id,
                    'role' => $row->role,
                    'status' => $row->status

                );

                //buat sesison
                $this->session->set_userdata($params);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('success', 'Login gagal!! Username / Password Salah');
                echo "<script>
                   
                    window.location = '" . site_url('auth/login') . "';
                </script>";
                exit;
            }
        } else {
            echo " tidak ada post ";
        }
    }

    public function logout()
    {
        $params = array(
            'user_id',
            'role',
            'status'
        );
        $this->session->unset_userdata($params);
        redirect('auth/login');
    }
}
