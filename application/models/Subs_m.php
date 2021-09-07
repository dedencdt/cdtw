<?php

class Subs_m extends CI_Model
{

    private $tblLangganan = 'tb_langganan';


    public function getid($id = null)
    {

        $this->db->select('*')->order_by('created_at', "desc")->limit(1);
        //add latest
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $this->db->from('tb_langganan');
        $query = $this->db->get();
        return $query;
    }

    public function getuser($id = null)
    {

        $this->db->like('user_id', $id, 'none');
        $this->db->from('tb_langganan');

        $query = $this->db->get();
        return $query;
    }

    // JUNK SUBS
    private function _setQueryLikeSUBS($keyword = null)
    {
        // edit OR Like disini
        $arr = [
            'created_at' => $keyword
        ];
        return $this->db->or_like($arr,);
    }

    // Setting Query
    private function _setQuerySUBS(
        $limit,
        $start,
        $keyword = null,

        $userid = null
    ) {
        $this->db->from($this->tblLangganan);
        if ($keyword) {
            $this->_setQueryLikeSUBS($keyword);
        }
        $this->db->like('user_id', $userid, 'none');
        $this->db->order_by('created_at', 'DESC');

        $this->db->limit($limit, $start);
    }


    private function _getQueryLikeSUBS($keyword = null)
    {
        return $this->_setQueryLikeSUBS($keyword);
    }


    //pencarian
    public function countAllSUBS($keyword = null)
    {

        $this->_getQueryLikeSUBS($keyword);
        $this->db->from($this->tblLangganan);

        return $this->db->count_all_results();
    }

    // gate utama
    public function getDataSUBS(
        $limit,
        $start,
        $keyword = null,
        $userid = null
    ) {
        $this->_setQuerySUBS($limit, $start, $keyword, $userid);
        return $this->db->get();
    }
    //  RTS SUBUS
}
