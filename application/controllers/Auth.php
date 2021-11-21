<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {
        check_already_login();
        $this->load->view('auth/login');
    }

    public function registration()
    {

        $this->load->view('auth/registrasi');
    }

    public function load()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['daftar'])) {
            $nama = $post['nama'];
            $email =  $post['email'];
            $username =  $post['username'];
            $wa =  $post['wa'];

            $msg = "Selamat $nama anda berhasil terdaftar sebagai member, berikut detail pendaftaran anda : <br>
            username : $username <br>
            Whatsapp : $wa
            ";

            $pesan = "Pendaftaran Member Baru \r\n \r\n
            =========================== \r\n
            Nama : $nama \r\n
            Username : $username \r\n
            Password : asldnjmoi2 \r\n
            Email : $email \r\n
            No. Whatsapp : $wa \r\n \r\n
            Pendaftara melalui link : - 
            Refferal dari : -
           
             
            ";

            $this->fungsi->apitele($this->setter->get_idteleadmin(), $pesan, $this->setter->get_tokenteleadmin());
            // $this->fungsi->sendEmail('Pendaftaran member baru', $email,  $msg);
        } else {
            echo "Gagal memasukan data";
        }
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
