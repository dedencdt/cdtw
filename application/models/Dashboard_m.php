<?php

class Dashboard_m extends CI_Model
{
    private $tableuser = 'tb_user';
    private $tblQVOrderan = 'qv_orderan_jn';
    private $tblMKomisi = 'tb_mkomisi';

    public function getVisitor($userid, $tgl = null, $page = null)
    {
        $this->db->join('m_frame', 'm_frame.frame_id = m_tracking.frame_id');
        $this->db->from('m_tracking');
        $this->db->like('m_tracking.created_at', $tgl, 'none');
        $this->db->like('m_tracking.label', $page, 'none');
        $this->db->where('m_frame.user_id', $userid);
        $query = $this->db->get();
        return $query;
    }

    public function edit($post)
    {

        $params['user_id'] = $post['user_id'];
        // $params['username'] = $post['username'];
        $params['nama'] = $post['nama'];
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
        }
        $params['nohp'] = $post['nohp'];
        // $params['email'] = $post['email'];
        $params['rekening'] = $post['rekening'];
        $params['alamat'] = $post['alamat']  != '' ? $post['alamat'] : null;
        // $params['role'] = $post['role'];
        $params['updated'] = date('Y-m-d H:i:s');

        $this->db->where('user_id', $post['user_id']);
        $this->db->update($this->tableuser, $params);
    }

    // ============= data komisi MEMBER 
    // Seting Configurasi
    // Query Like
    private function _setQueryLikeDM($keyword = null)
    {
        // edit OR Like disini
        $arr = [
            'tgl_gajian' => $keyword,
            'invoice' => $keyword,
            'status' => $keyword

        ];
        return $this->db->or_like($arr, 'none');
    }

    // Setting Query
    private function _setQueryDM($limit, $start, $keyword = null, $user = null )
    {
        $this->db->select('*');
        $this->db->from($this->tblMKomisi);
        $this->db->where('user_id', $user);
        // $this->db->join('tb_user', 'tb_user.user_id = user_id'); //inner
        $this->db->order_by('created_at', 'DESC');
        if ($keyword) {
            $this->_setQueryLikeDM($keyword);
        }
        $this->db->limit($limit, $start);
    }


    private function _getQueryLikeDM($keyword = null)
    {
        return $this->_setQueryLikeDM($keyword);
    }



    public function countAllDM($keyword = null)
    {
        $this->_getQueryLikeDM($keyword);
        $this->db->from($this->tblMKomisi);
        return $this->db->count_all_results();
    }

    public function getDataDM($limit, $start, $keyword = null, $user = null )
    {
        $this->_setQueryDM($limit, $start, $keyword, $user);
        return $this->db->get();
    }


    // ============ RTS
    // RTS START
    private function _setQueryLikeRTS($keyword = null, $status = null)
    {
        // edit OR Like disini
        $arr = [
            'penerima' => $keyword,
            'order_id' => $keyword,
            'nowa' => $keyword,
            'resi' => $keyword,
            'created_at' => $keyword
        ];
        $this->db->like('status', $status, 'none');
        return $this->db->or_like($arr,);
    }

    // Setting Query
    private function _setQueryRTS(
        $limit,
        $start,
        $keyword = null,
        $status = null,
        $userid = null
    ) {
        $this->db->from($this->tblQVOrderan);
        if ($keyword) {
            $this->_setQueryLikeRTS($keyword);
        }
        $this->db->where('user_id', $userid);
        $this->db->like('status', $status, 'none');
        $this->db->order_by('created_at', 'DESC');

        $this->db->limit($limit, $start);
    }


    private function _getQueryLikeRTS($keyword = null, $status = null)
    {
        return $this->_setQueryLikeRTS($keyword, $status);
    }


    //pencarian
    public function countAllRTS($keyword = null,  $status = null)
    {

        $this->_getQueryLikeRTS($keyword,  $status);
        $this->db->from($this->tblQVOrderan);

        return $this->db->count_all_results();
    }

    // gate utama
    public function getDataRTS(
        $limit,
        $start,
        $keyword = null,
        $status = null,
        $userid = null
    ) {
        $this->_setQueryRTS($limit, $start, $keyword,  $status, $userid);
        return $this->db->get();
    }
    //  RTS END


    // JUNK START
    private function _setQueryLikeJUNK($keyword = null, $status = null)
    {
        // edit OR Like disini
        $arr = [
            'penerima' => $keyword,
            'order_id' => $keyword,
            'nowa' => $keyword,
            'resi' => $keyword,
            'created_at' => $keyword
        ];
        $this->db->like('status', $status, 'none');
        return $this->db->or_like($arr,);
    }

    // Setting Query
    private function _setQueryJUNK(
        $limit,
        $start,
        $keyword = null,
        $status = null,
        $userid = null
    ) {
        $this->db->from($this->tblQVOrderan);
        if ($keyword) {
            $this->_setQueryLikeJUNK($keyword);
        }
        $this->db->where('user_id', $userid);
        $this->db->like('status', $status, 'none');
        $this->db->order_by('created_at', 'DESC');

        $this->db->limit($limit, $start);
    }


    private function _getQueryLikeJUNK($keyword = null, $status = null)
    {
        return $this->_setQueryLikeJUNK($keyword, $status);
    }


    //pencarian
    public function countAllJUNK($keyword = null,  $status = null)
    {

        $this->_getQueryLikeJUNK($keyword,  $status);
        $this->db->from($this->tblQVOrderan);

        return $this->db->count_all_results();
    }

    // gate utama
    public function getDataJUNK(
        $limit,
        $start,
        $keyword = null,
        $status = null,
        $userid = null
    ) {
        $this->_setQueryJUNK($limit, $start, $keyword,  $status, $userid);
        return $this->db->get();
    }
    //  RTS junk
}
