<?php

/**
 * cek Apakah user sudah login??
 *  pasang skript ini di halaman login
 */
function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('user_id');
    if ($user_session) {
        redirect('dashboard');
    }
}

/**
 * Cek user , jika user sudah login
 * PAsang fungsi ini di halaman dashboard
 */
function check_not_login()
{

    $ci = &get_instance();
    $user_session = $ci->session->userdata('user_id');
    if (!$user_session) {
        redirect('auth/login');
    }
}

/**
 * batasa page jika bukan admin 
 * cek menggunakan role user
 */
function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->role != 1) {
        redirect('dashboard');
    }
}

function check_cs()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->role != 3) {
        redirect('dashboard');
    }
}

function check_vendor()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->role != 4) {
        redirect('dashboard');
    }
}


function set_timezone()
{
    $timzone = date_default_timezone_set("Asia/Jakarta");
    return $timzone;
}

function check_memberaktif()
{
    $today = date('Y-m-d H:i:s');
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->role == 2 && $ci->fungsi->durasi_langganan() <= $today) {
        redirect('dashboard');
    }
}


function check_role($role)
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->role != $role) {
        redirect('dashboard');
    }
}

// fungsi untuk mengambil data by userid
function getuserbyId($id)
{
    $ci = &get_instance();
    $query = $ci->db->query("SELECT * FROM tb_user WHERE user_id = '$id'");
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return false;
    }
}
