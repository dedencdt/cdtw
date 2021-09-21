<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		set_timezone();
		check_not_login();
		$this->load->model(['dashboard_m', 'user_m']);
	}

	public function index()
	{

		$this->template->load('template', 'dashboard');
	}

	public function profile($id)
	{
		/**
		 * Form Validation
		 */
		// $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_username_check');
		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]');
		}
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		// $this->form_validation->set_rules('role', 'Role', 'required');
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
				$this->template->load('template', 'dashboard/member_edit_profile', $data);
			} else {
				echo "<script>alert('Data tidak di temuka');
                    document.referrer()
                </script>";
			}
		} else {
			$post = $this->input->post(null, TRUE);
			$this->dashboard_m->edit($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Data berhasil di simpan');
			}
			redirect('dashboard/profile/' . $id);
		}
	}

	// start 

	public function rts()
	{
		check_memberaktif();
		$basepage = 'dashboard/rts/'; // url sampai segment (2)
		$per_page = 15; // masukan baris limit data

		//ambil data search
		if ($this->input->post('search')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = null;
		}

		//configurasi pagination
		$status = 'refunded';
		$config['total_rows'] = $this->dashboard_m->countAllRTS($data['keyword'], $status); //ambil count ALl di Model


		$config['per_page'] = $per_page;
		$config['base_url'] = base_url() . $basepage;
		$data['start'] = $this->uri->segment(3);
		$data['total_rows'] = $config['total_rows'];

		$user = $this->fungsi->user_login()->user_id;
		//initialize
		$this->pagination->initialize($config);

		$data['row'] = $this->dashboard_m->getDataRTS($config['per_page'], $data['start'], $data['keyword'],  $status, $user)->result();
		$this->template->load('template', 'dashboard/member_rts', $data);
	}


	public function junk()
	{
		check_memberaktif();
		$basepage = 'dashboard/junk/'; // url sampai segment (2)
		$per_page = 15; // masukan baris limit data

		//ambil data search
		if ($this->input->post('search')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = null;
		}

		//configurasi pagination
		$status = 'junk';
		$config['total_rows'] = $this->dashboard_m->countAllJUNK($data['keyword'], $status); //ambil count ALl di Model


		$config['per_page'] = $per_page;
		$config['base_url'] = base_url() . $basepage;
		$data['start'] = $this->uri->segment(3);
		$data['total_rows'] = $config['total_rows'];

		$user = $this->fungsi->user_login()->user_id;
		//initialize
		$this->pagination->initialize($config);

		$data['row'] = $this->dashboard_m->getDataJUNK($config['per_page'], $data['start'], $data['keyword'],  $status, $user)->result();
		$this->template->load('template', 'dashboard/member_junk', $data);
	}


	public function komisi()
	{
		$basepage = 'komisi/komisi/'; // url
		$per_page = 15; // masukan baris limit data

		//ambil data search
		if ($this->input->post('search')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = null;
		}

		//configurasi pagination
		$config['total_rows'] = $this->dashboard_m->countAllDM($data['keyword']); //ambil count ALl di Model


		$config['per_page'] = $per_page;
		$config['base_url'] = base_url() . $basepage;
		$data['start'] = $this->uri->segment(3);
		$userid = $this->fungsi->user_login()->user_id;


		//initialize
		$this->pagination->initialize($config);

		$data['row'] = $this->dashboard_m->getDataDM($config['per_page'], $data['start'], $data['keyword'], $userid);
		$this->template->load('template', 'dashboard/member_komisi', $data);
	}



	public function support()
	{
		$this->template->load('template', 'dashboard/member_support');
	}
}
