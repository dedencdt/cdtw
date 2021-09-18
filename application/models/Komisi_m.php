<?php

class Komisi_m extends CI_Model
{
    private $tblsetTanggal = 'tb_tglgajian',
        $tblsiapcair = 'tb_siapcair',
        $tblMKomisi = 'tb_mkomisi';


    public function addtoKomisimember($post)
    {
        $total = $post['komisi_member'] - $post['rts'] - $post['lainlain'];
        $params = [
            'mkomisi_id' => $post['mkomisi_id'],
            'invoice' => $post['invoice'],
            'tgl_gajian' => $post['tgl_gajian'],
            'komisisales' => $post['komisi_member'],
            'rts' => $post['rts'],
            'lainlain' => $post['lainlain'],
            'diterima' => $total,
            'status' => $post['status'],
            'note' => $post['note'],
            'user_id' => $post['publisher'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert($this->tblMKomisi, $params);
    }


    public function getdataKomisi($page, $start, $end)
    {
        $this->db
            ->select('siapcair_id,SUM(member_in) as komisi_member,SUM(cs_in) as komisi_cs,SUM(vendor_in) as komisi_vendor,SUM(member_out) as rts,cs_id,vendor_id,user_id')
            ->where('created_at <=', $start)
            ->where('created_at >=', $end);
        if ($page == 'member') {
            $this->db->group_by('user_id');
            // ->order_by('komisi_member', 'asc');
        } elseif ($page == 'cs') {
            $this->db->group_by('cs_id');
            // ->order_by('komisi_cs', 'asc');
        } elseif ($page == 'vendor') {
            $this->db->group_by('vendor_id');
            // ->order_by('komisi_vendor', 'asc');
        }
        $query = $this->db->get($this->tblsiapcair);
        return $query;
    }

    public function getId($id)
    {
        $this->db->select('*')
            ->from($this->tblsetTanggal)
            ->where('tglgajian_id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function addTgl($post)
    {
        // mengmbil tanggal terpilih
        $date = new DateTime($post['tglgajian']);
        $date1 = new DateTime($post['tglgajian']);

        // set h-1 dari tanggal gajian
        $rekap = $date;
        $rekap->modify('-1 day');

        // set h-2 
        $closebook = $date1;
        $closebook->modify('-2 day');

        $params = [
            'tglgajian_id' => $post['tglgajian_id'],
            'tgl_gajian' => $post['tglgajian'],
            'tgl_rekap' => $rekap->format('Y-m-d'),
            'tutup_buku' => $closebook->format('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert($this->tblsetTanggal, $params);
    }

    public function editTgl($post)
    {

        $params = [
            'tglgajian_id' => $post['tglgajian_id'],
            'tgl_gajian' => $post['tglgajian'],
            'tgl_rekap' => $post['tglrekap'],
            'tutup_buku' => $post['tutupbuku'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('tglgajian_id', $post['tglgajian_id']);
        $this->db->update($this->tblsetTanggal, $params);
    }

    public function delTgl($id)
    {
        $this->db->where('tglgajian_id', $id);
        $this->db->delete($this->tblsetTanggal);
    }



    // =============================
    // PAGINATION
    // ==============================

    // Seting Configurasi
    // Query Like
    private function _setQueryLike($keyword = null)
    {
        // edit OR Like disini
        $arr = [
            'tgl_gajian' => $keyword

        ];
        return $this->db->or_like($arr, 'none');
    }

    // Setting Query
    private function _setQuery($limit, $start, $keyword = null)
    {
        // $this->db->select('*,tb_user.username,created_at as langganan_created ');
        $this->db->from($this->tblsetTanggal);
        // $this->db->join('tb_user', 'tb_user.user_id = user_id'); //inner
        $this->db->order_by('created_at', 'DESC');
        if ($keyword) {
            $this->_setQueryLike($keyword);
        }
        $this->db->limit($limit, $start);
    }


    private function _getQueryLike($keyword = null)
    {
        return $this->_setQueryLike($keyword);
    }



    public function countAll($keyword = null)
    {
        $this->_getQueryLike($keyword);
        $this->db->from($this->tblsetTanggal);
        return $this->db->count_all_results();
    }

    public function getData($limit, $start, $keyword = null)
    {
        $this->_setQuery($limit, $start, $keyword);
        return $this->db->get();
    }
    // Batas PAgination


}
