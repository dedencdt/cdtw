<?php

use AC\Column\User\Name;

class Fungsi
{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        /**
         * Nampilin data user saat login
         */
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('user_id');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
    }


    //GEt Expired dari tb langganan 
    // Terus tinggal di If sajah
    function member_active()
    {
        $this->ci->load->model('subs_m');
        $user_id = $this->ci->session->userdata('user_id');
        $member = $this->ci->subs_m->getid($user_id)->row();
        if ($member) {
            return $member;
        } else {
            return false;
        }
    }


    function durasi_langganan()
    {

        $this->ci->load->model(['subs_m', 'user_m']);
        $user_id = $this->ci->session->userdata('user_id');
        $member = $this->ci->subs_m->getid($user_id);

        if ($this->ci->db->affected_rows() > 0) {
            return $member->row()->durasi;
        } else {
            $yesterday = date('Y-m-d H:i:s', strtotime('-1 day'));
            return $yesterday;
        }
    }



    /**
     * hitug visit,letakan di halaman
     */
    function counter($userid, $page, $start, $end)
    {
        $this->ci->db->select_sum('visit')
            ->join('m_frame', 'm_frame.frame_id = m_tracking.frame_id')
            ->like('m_tracking.label', $page, 'none')
            ->where('m_frame.user_id', $userid)
            ->where('m_tracking.created_at >=', $start)
            ->where('m_tracking.created_at >=', $end);

        $result = $this->ci->db->get('m_tracking')->row();
        return $result->visit;
    }

    function count_visit($userid, $page, $start, $end)
    {
        // $this->ci->db->select('SUM(visit)');
        // $this->ci->db->select('visit');
        $this->ci->db->join('m_frame', 'm_frame.frame_id = m_tracking.frame_id');
        $this->ci->db->from('m_tracking');
        // $this->ci->db->like('m_tracking.created_at', $tgl, 'none');
        $this->ci->db->like('m_tracking.label', $page, 'none');
        $this->ci->db->where('m_frame.user_id', $userid);
        $this->ci->db->where('m_tracking.created_at >=', $start);
        $this->ci->db->where('m_tracking.created_at <=', $end);

        // $query = $this->ci->db->get()->num_rows();
        $query = $this->ci->db->get()->num_rows();
        return $query;
    }

    function count_static($userid, $status, $start, $end)
    {
        $this->ci->db->from('qv_orderan_jn');
        // $this->ci->db->like('m_tracking.created_at', $tgl, 'none');
        $this->ci->db->like('status', $status, 'none');
        $this->ci->db->where('user_id', $userid);
        $this->ci->db->where('created_at >=', $start);
        $this->ci->db->where('created_at <=', $end);

        $query = $this->ci->db->get()->num_rows();
        return $query;
    }

    function sendwa($to, $text = null)
    {
        $number = $to;
        $ceknum = substr($number, 0, 2);
        // echo $ceknum;
        //cek apakah valid 62
        $wanum = '';
        if ($ceknum != '62') {
            // cek apakah di awali angka 0
            if ($ceknum == '08') {
                // ubah menjadi 62
                $wanum = str_replace($ceknum, '628', $number);
            } else {
                //ubah menjadi
                $wanum = str_replace($ceknum, '6', $number);
            }
        } else {
            // nilai sesuai 6281
            $wanum =   $number;
        }
        $text = urlencode($text);

        $endpoint = 'https://wa.me/';
        $url = $endpoint . $wanum . '?text=' . $text;
        return $url;
    }

    function getVendorOrder($produkid = null)
    {
        $this->ci->db->from('tb_vendor');
        if ($produkid != null) {
            # code...
            $this->ci->db->where('produk_id', $produkid);
        }
        $qeury =  $this->ci->db->get();
        return $qeury->row();
    }

    // fungsi api telegram
    function sendMessage($telegram_id, $message_text, $secret_token)
    {
        $url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
        $url = $url . "&text=" . urlencode($message_text);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            echo 'Pesan gagal terkirim, error :' . $err;
        } else {
            echo 'Pesan terkirim';
        }
    }

    // get data produk dari produk id
    function getProduk($id = null)
    {
        $this->ci->load->model('produk_m');
        $query = $this->ci->produk_m->get($id);
        return $query->row();
    }

    function cek_data_komisi($tgl, $user)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_mkomisi WHERE tgl_gajian = '$tgl' AND user_id = '$user' AND status = 'menunggu'");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function cek_data_komisi_cs($tgl, $user)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_cskomisi WHERE tgl_gajian = '$tgl' AND cs_id = '$user' AND status = 'menunggu'");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function cek_data_komisi_vendor($tgl, $user)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_vkomisi WHERE tgl_gajian = '$tgl' AND vendor_id = '$user' AND status = 'menunggu'");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    // fungsi komisi
    function getdataKomisi($start, $end)
    {
        $query = $this->ci->db
            ->query("SELECT SUM(member_in) AS komisi_member, SUM(member_out) AS rts,tb_siapcair.user_id,tb_user.username FROM tb_siapcair JOIN tb_user ON tb_user.user_id = tb_siapcair.user_id WHERE tb_siapcair.created_at >= '$start' AND tb_siapcair.created_at <= '$end' GROUP BY tb_siapcair.user_id");


        return $query;
    }

    function getdataKomisiCS($start, $end)
    {
        $query = $this->ci->db
            ->query("SELECT SUM(cs_in) AS komisi_cs,cs_id ,tb_user.username FROM tb_siapcair JOIN tb_user ON tb_user.user_id = tb_siapcair.cs_id WHERE tb_siapcair.created_at >= '$start' AND tb_siapcair.created_at <= '$end' GROUP BY cs_id");


        return $query;
    }

    function getdataKomisiVendor($start, $end)
    {
        $query = $this->ci->db
            ->query("SELECT SUM(vendor_in) AS komisi_vendor, qv_usrvndrdetail.username , qv_usrvndrdetail.vendorid FROM tb_siapcair JOIN qv_usrvndrdetail ON qv_usrvndrdetail.vendor_id = tb_siapcair.vendor_id  WHERE tb_siapcair.created_at >= '$start' AND tb_siapcair.created_at <= '$end' GROUP BY tb_siapcair.vendor_id");

        return $query;
    }

    function getscmember($tglgajian)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_mkomisi JOIN tb_user ON tb_user.user_id = tb_mkomisi.user_id WHERE status = 'menunggu' AND tgl_gajian = '$tglgajian' ORDER BY tb_mkomisi.created_at ASC");
        return $query;
    }

    function getsccs($tglgajian)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_cskomisi JOIN tb_user ON tb_user.user_id = tb_cskomisi.cs_id WHERE status = 'menunggu' AND tgl_gajian = '$tglgajian' ORDER BY tb_cskomisi.created_at ASC");
        return $query;
    }

    function getscvendor($tglgajian)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_vkomisi JOIN tb_user ON tb_user.user_id = tb_vkomisi.vendor_id WHERE status = 'menunggu' AND tgl_gajian = '$tglgajian' ORDER BY tb_vkomisi.created_at ASC");
        return $query;
    }

    function printvendor($tglgajian)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_vkomisi JOIN tb_user ON tb_user.user_id = tb_vkomisi.vendor_id WHERE status = 'selsai' AND tgl_gajian = '$tglgajian' ORDER BY tb_vkomisi.created_at ASC");
        return $query;
    }

    function printcs($tglgajian)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_cskomisi JOIN tb_user ON tb_user.user_id = tb_cskomisi.cs_id WHERE status = 'selesai' AND tgl_gajian = '$tglgajian' ORDER BY tb_cskomisi.created_at ASC");
        return $query;
    }

    function printmember($tglgajian)
    {
        $query = $this->ci->db
            ->query("SELECT * FROM tb_mkomisi JOIN tb_user ON tb_user.user_id = tb_mkomisi.user_id WHERE status = 'selesai' AND tgl_gajian = '$tglgajian' ORDER BY tb_mkomisi.created_at ASC");
        return $query;
    }
}
