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
        $query = $this->ci->db
            ->query("SELECT SUM(visit) AS total_visit, m_frame.user_id , m_tracking.label, m_tracking.created_at FROM m_tracking JOIN m_frame ON m_frame.frame_id = m_tracking.frame_id  LIKE m_frame.label = '$page' WHERE m_frame.user_id ='$userid'  AND m_tracking.created_at >= '$start' AND m_tracking.created_at <= '$end' GROUP BY m_frame.user_id,m_tracking.label,m_tracking.created_at ");
        if ($query->num_rows() > 0) {
            return $query->row()->total_visit;
        } else {
            return 0;
        }
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
        $this->ci->db->where('updated >=', $start);
        $this->ci->db->where('updated <=', $end);

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


    // dashboard member 
    // hitung proses cod member
    function count_prosescodm($userid)
    {
        $query = $this->ci->db->query("SELECT SUM(p.komisi) AS total_cod, q.user_id , q.status FROM qv_orderan_jn AS q JOIN tb_produk AS p ON p.produk_id = q.produk_id WHERE (status LIKE 'packing' OR status LIKE 'delivery' ) AND user_id='$userid' GROUP BY user_id");

        if ($query->num_rows() > 0) {
            return $query->row()->total_cod;
        } else {
            return 0;
        }
    }

    // hitung proses siapcair member
    function count_siapcairm($userid)
    {
        // mengambil tanggal tutup buku
        $qtglgajian = $this->ci->db->query("SELECT * FROM tb_tglgajian ORDER BY tgl_gajian DESC limit 1");

        $today = date('Y-m-d');

        $tutupbuku = null;
        $bukabuku = null;
        foreach ($qtglgajian->result() as $tgl) :
            // cek apakag tutup buka lebih dari hari ini
            if ($today <= $tgl->tutup_buku) {
                $tutupbuku = $tgl->tutup_buku;
                $bukabuku =  $tgl->buka_buku;
            } else {
                $tutupbuku = $today;
                $bukabuku =  $today;
            }
        endforeach;


        // write code this here
        $query  = $this->ci->db->query("SELECT SUM(member_in) AS total_siapcair,user_id,created_at FROM tb_siapcair WHERE user_id = '$userid' AND created_at >='$bukabuku' AND created_at <= '$tutupbuku' GROUP BY user_id,created_at");
        if ($query->num_rows() > 0) {
            return $query->row()->total_siapcair;
        } else {
            return 0;
        }
    }

    // hitung proses siapcair cs
    function count_siapcaircs($userid)
    {
        // mengambil tanggal tutup buku
        // mengambil tanggal tutup buku
        $qtglgajian = $this->ci->db->query("SELECT * FROM tb_tglgajian ORDER BY tgl_gajian DESC limit 1");

        $today = date('Y-m-d');

        $tutupbuku = null;
        $bukabuku = null;
        foreach ($qtglgajian->result() as $tgl) :
            // cek apakag tutup buka lebih dari hari ini
            if ($today <= $tgl->tutup_buku) {
                $tutupbuku = $tgl->tutup_buku;
                $bukabuku =  $tgl->buka_buku;
            } else {
                $tutupbuku = $today;
                $bukabuku =  $today;
            }
        endforeach;

        // write code this here
        $query  = $this->ci->db->query("SELECT SUM(cs_in) AS total_siapcair, cs_id, created_at FROM tb_siapcair WHERE cs_id = '$userid' AND created_at >='$bukabuku' AND created_at <= '$tutupbuku' GROUP BY cs_id,created_at");
        if ($query->num_rows() > 0) {
            return $query->row()->total_siapcair;
        } else {
            return 0;
        }
    }

    // hitung proses siapcair vendor
    function count_siapcairvendor($userid)
    {
        // mengambil tanggal tutup buku
        // mengambil tanggal tutup buku
        $qtglgajian = $this->ci->db->query("SELECT * FROM tb_tglgajian ORDER BY tgl_gajian DESC limit 1");

        $today = date('Y-m-d');

        $tutupbuku = null;
        $bukabuku = null;
        foreach ($qtglgajian->result() as $tgl) :
            // cek apakag tutup buka lebih dari hari ini
            if ($today <= $tgl->tutup_buku) {
                $tutupbuku = $tgl->tutup_buku;
                $bukabuku =  $tgl->buka_buku;
            } else {
                $tutupbuku = $today;
                $bukabuku =  $today;
            }
        endforeach;

        // write code this here
        $query  = $this->ci->db->query("SELECT SUM(vendor_in) AS total_siapcair, v.user_id, s.created_at FROM tb_siapcair AS s JOIN tb_vendor AS v ON v.vendor_id = s.vendor_id WHERE v.user_id = '$userid' AND s.created_at >='$bukabuku' AND s.created_at <= '$tutupbuku' GROUP BY v.user_id,s.created_at");
        if ($query->num_rows() > 0) {
            return $query->row()->total_siapcair;
        } else {
            return 0;
        }
    }

    // hitung proses rts member
    function count_rtsm($userid)
    {
        // mengambil tanggal tutup buku
        $qtglgajian = $this->ci->db->query("SELECT * FROM tb_tglgajian ORDER BY tgl_gajian DESC limit 1");

        $today = date('Y-m-d');

        $tutupbuku = null;
        $bukabuku = null;
        foreach ($qtglgajian->result() as $tgl) :
            // cek apakag tutup buka lebih dari hari ini
            if ($today <= $tgl->tutup_buku) {
                $tutupbuku = $tgl->tutup_buku;
                $bukabuku =  $tgl->buka_buku;
            } else {
                $tutupbuku = $today;
                $bukabuku =  $today;
            }
        endforeach;

        // write code this here
        $query  = $this->ci->db->query("SELECT SUM(member_out) AS total_rts, user_id, created_at FROM tb_siapcair WHERE user_id = '$userid' AND created_at >='$bukabuku' AND created_at <= '$tutupbuku' GROUP BY user_id,created_at");
        if ($query->num_rows() > 0) {
            return $query->row()->total_rts;
        } else {
            return 0;
        }
    }

    // Hhitung menunggu transfer
    // /member
    function count_menungguttfm($userid)
    {
        $query = $this->ci->db->query("SELECT diterima,user_id,status,created_at FROM tb_mkomisi WHERE user_id = '$userid' AND status='menunggu' GROUP BY user_id ORDER BY created_at DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->row()->diterima;
        } else {
            return 0;
        }
    }

    // Hhitung menunggu transfer
    // /cs
    function count_menungguttfcs($userid)
    {
        $query = $this->ci->db->query("SELECT diterima,cs_id,status,created_at FROM tb_cskomisi WHERE cs_id = '$userid' AND status='menunggu' GROUP BY cs_id ORDER BY created_at DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->row()->diterima;
        } else {
            return 0;
        }
    }


    // Hhitung menunggu transfer
    // /vendor
    function count_menungguttfvendor($userid)
    {
        $query = $this->ci->db->query("SELECT diterima,vendor_id,status,created_at FROM tb_vkomisi WHERE vendor_id = '$userid' AND status='menunggu' GROUP BY vendor_id ORDER BY created_at DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->row()->diterima;
        } else {
            return 0;
        }
    }


    // HITUNG TOTAL KOMISI SUDAH CAIR
    function count_totalkomisi($userid)
    {
        $query = $this->ci->db->query("SELECT user_id,total FROM tb_totalkomisi WHERE user_id='$userid' GROUP BY user_id");
        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }

    //HITUNGH SALES DI tabel sales member
    function count_tblsalesm($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT q.updated ,COUNT(p.komisi) AS qty, SUM(p.komisi) AS total_komisi, q.user_id FROM qv_orderan_jn AS q JOIN tb_produk AS p ON p.produk_id = q.produk_id WHERE status='completed' AND  q.updated >= '$start' AND q.updated <= '$end' AND user_id='$userid' GROUP BY q.updated,user_id ORDER BY q.updated DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //HITUNGH SALES DI tabel sales cs
    function count_tblsalescs($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT q.updated ,COUNT(p.komisi) AS qty, SUM(4000) AS total_komisi, q.cs_id FROM qv_orderan_jn AS q JOIN tb_produk AS p ON p.produk_id = q.produk_id WHERE status='completed' AND  q.updated >= '$start' AND q.updated <= '$end' AND cs_id='$userid' GROUP BY q.updated,cs_id ORDER BY q.updated DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //HITUNGH SALES DI tabel sales Vendor
    function count_tblsalesvendor($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT q.updated ,COUNT(p.harga_vendor) AS qty, SUM(p.harga_vendor) AS total_komisi, v.user_id FROM qv_orderan_jn AS q JOIN tb_produk AS p ON p.produk_id = q.produk_id JOIN tb_vendor AS v ON v.vendor_id = q.vendor_id WHERE status='completed' AND  q.updated >= '$start' AND q.updated <= '$end' AND v.user_id='$userid' GROUP BY q.updated,v.user_id ORDER BY q.updated DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //HITUNGH cod DI tabel sales Vendor
    function count_tblcodvendor($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT q.updated ,COUNT(p.harga_vendor) AS qty, SUM(p.harga_vendor) AS total_komisi, v.user_id FROM qv_orderan_jn AS q JOIN tb_produk AS p ON p.produk_id = q.produk_id JOIN tb_vendor AS v ON v.vendor_id = q.vendor_id WHERE (status LIKE 'packing' OR status LIKE 'delivery') AND  q.updated >= '$start' AND q.updated <= '$end' AND v.user_id='$userid' GROUP BY q.updated,v.user_id ORDER BY q.updated DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //HITUNGH COD DI tabel COD member
    function count_tblcodm($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT q.updated ,COUNT(p.komisi) AS qty, SUM(p.komisi) AS total_komisi, q.user_id FROM qv_orderan_jn AS q JOIN tb_produk AS p ON p.produk_id = q.produk_id WHERE (status LIKE 'packing' OR status LIKE 'delivery') AND q.updated >= '$start' AND q.updated <= '$end' AND user_id='$userid' GROUP BY q.updated,user_id ORDER BY q.updated DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //HITUNGH COD DI tabel COD cs
    function count_tblcodcs($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT q.updated ,COUNT(p.komisi) AS qty, SUM(4000) AS total_komisi, q.cs_id FROM qv_orderan_jn AS q JOIN tb_produk AS p ON p.produk_id = q.produk_id WHERE (status LIKE 'packing' OR status LIKE 'delivery') AND q.updated >= '$start' AND q.updated <= '$end' AND cs_id='$userid' GROUP BY q.updated,cs_id ORDER BY q.updated DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // FITUR DSAHBOARD CS
    function count_leadcs()
    {
        $query = $this->ci->db->query("SELECT COUNT(order_id) AS total_lead, status FROM qv_orderan_jn WHERE status = 'processing' GROUP BY status");
        if ($query->num_rows() > 0) {
            return $query->row()->total_lead;
        } else {
            return 0;
        }
    }

    // cs
    function count_closingpercs($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT COUNT(order_id) AS total_sales, cs_id, status FROM qv_orderan_jn WHERE status = 'completed' AND cs_id = '$userid' AND updated >= '$start' AND updated <= '$end' GROUP BY cs_id");
        if ($query->num_rows() > 0) {
            return $query->row()->total_sales;
        } else {
            return 0;
        }
    }

    // vendor closing
    function count_closingpervendor($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT COUNT(order_id) AS total_sales, v.user_id, status FROM qv_orderan_jn AS q JOIN tb_vendor AS v ON v.vendor_id = q.vendor_id WHERE status = 'completed' AND v.user_id = '$userid' AND q.updated >= '$start' AND q.updated <= '$end' GROUP BY v.user_id");
        if ($query->num_rows() > 0) {
            return $query->row()->total_sales;
        } else {
            return 0;
        }
    }

    // vendor rts
    function count_rtspervendor($userid, $start, $end)
    {
        $query = $this->ci->db->query("SELECT COUNT(order_id) AS total_rts, v.user_id, status FROM qv_orderan_jn AS q JOIN tb_vendor AS v ON v.vendor_id = q.vendor_id WHERE status = 'refunded' AND v.user_id = '$userid' AND q.updated >= '$start' AND q.updated <= '$end' GROUP BY v.user_id");
        if ($query->num_rows() > 0) {
            return $query->row()->total_rts;
        } else {
            return 0;
        }
    }

    // cs
    function count_codpercs($userid)
    {
        $query = $this->ci->db->query("SELECT COUNT(order_id) AS total_cod, cs_id, status FROM qv_orderan_jn WHERE (status LIKE 'packing' OR status LIKE 'delivery' ) AND cs_id = '$userid'  GROUP BY cs_id");
        if ($query->num_rows() > 0) {
            return $query->row()->total_cod;
        } else {
            return 0;
        }
    }

    // fitur cod vendor
    function count_codpervendor($userid)
    {
        $query = $this->ci->db->query("SELECT COUNT(order_id) AS total_cod, v.user_id, status FROM qv_orderan_jn  AS q JOIN tb_vendor  AS v ON v.vendor_id = q.vendor_id WHERE (status LIKE 'packing' OR status LIKE 'delivery' ) AND v.user_id = '$userid'  GROUP BY v.user_id");
        if ($query->num_rows() > 0) {
            return $query->row()->total_cod;
        } else {
            return 0;
        }
    }

    // ============
    // helper

    // ======
    // ambil tanggal di dalam array  secara dinasi sesuai hari ini
    function gettanggalgajian($today, $array)
    {
        $durasigajian = 7;
        $hasiltanggal = null;

        foreach ($array as $tgl) {
            $d1 = new DateTime($tgl);
            $d2 = new DateTime($today);
            $diff = $d2->diff($d1);
            if (($diff->d - 1) < $durasigajian) {
                $hasiltanggal = $tgl;
            }
        }
        // return format Y-m-d
        return $hasiltanggal;
    }

    // ==============
    // FUNGIS DASHBOAR ADMIN
    // ================
    function count_alluser()
    {
        $query = $this->ci->db->query("SELECT * FROM tb_user WHERE role = '2' ");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    // hitung user aktif
    function count_userAktif()
    {
        $query = $this->ci->db->query("SELECT user_id,durasi,status FROM tb_langganan WHERE status = 'Paid' AND durasi >= CURDATE() ");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    // hitung hitung semua produk
    function count_allProduk()
    {
        $query = $this->ci->db->query("SELECT * FROM tb_produk ");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    // hitung semua pesanan masuk
    function count_allOrderan()
    {
        $query = $this->ci->db->query("SELECT * FROM qv_orderan_jn ");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    // hitung semua cod Rp
    function count_allOrderanCod()
    {
        $query = $this->ci->db->query("SELECT * FROM qv_orderan_jn WHERE (status LIKE 'delivery' OR status LIKE 'packing')");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    // hitung semua cod Rp
    function count_allOrderanCodRp()
    {
        $query = $this->ci->db->query("SELECT SUM(total) AS total_cod,status FROM qv_orderan_jn WHERE (status LIKE 'delivery' OR status LIKE 'packing') GROUP BY total");
        if ($query->num_rows() > 0) {
            return $query->row()->total_cod;
        } else {
            return 0;
        }
    }

    // hitung semua pesanan selesai
    function count_alldone()
    {
        $query = $this->ci->db->query("SELECT * FROM qv_orderan_jn WHERE status='completed'");
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    // hitung semua pesanan selesai
    function count_alldoneRp()
    {
        $query = $this->ci->db->query("SELECT SUM(total) AS total_sales,status FROM qv_orderan_jn WHERE status='completed' GROUP BY total");
        if ($query->num_rows() > 0) {
            return $query->row()->total_sales;
        } else {
            return 0;
        }
    }


    // hitung semua pesanan selesai
    function count_allkomisipaid()
    {
        $query = $this->ci->db->query("SELECT SUM(total) AS total_komisi FROM tb_totalkomisi ");
        if ($query->num_rows() > 0) {
            return $query->row()->total_komisi;
        } else {
            return 0;
        }
    }

    //HITUNGH COD DI tabel COD sadmin
    function count_tblcodadmin($start, $end)
    {
        $query = $this->ci->db->query("SELECT updated ,COUNT(harga) AS qty, SUM(harga) AS total_komisi FROM qv_orderan_jn  WHERE (status LIKE 'packing' OR status LIKE 'delivery') AND updated >= '$start' AND updated <= '$end'  GROUP BY updated  ORDER BY updated DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    //HITUNGH COD DI tabelsales admin
    function count_tblsalesadmin($start, $end)
    {
        $query = $this->ci->db->query("SELECT updated ,COUNT(harga) AS qty, SUM(harga) AS total_komisi FROM qv_orderan_jn  WHERE status='completed' AND updated >= '$start' AND updated <= '$end'  GROUP BY updated  ORDER BY updated DESC");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
