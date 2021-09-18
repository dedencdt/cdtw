<?php

class Orders_m extends CI_Model
{
    // endpoint ajax Model
    // data cek orderan
    var $tableInOrder = 'tb_in_order';
    var $tableOrder = 'tb_orders';
    var $tblQVInorder = 'qv_in_order_jn';
    var $tblQVOrderan = 'qv_orderan_jn';
    var $tblQVCekOrderan = 'qv_cek_orderan';


    // PACKING

    private function _setQueryLikePK($keyword = null, $status = null)
    {
        // edit OR Like disini
        $arr = [
            'penerima' => $keyword,
            'order_id' => $keyword,
            'nowa' => $keyword,
            'username' => $keyword
        ];
        return $this->db->or_like($arr);
    }

    // Setting Query
    private function _setQueryPK(
        $limit,
        $start,
        $keyword = null,
        $status = null
    ) {
        $this->db->from($this->tblQVOrderan);
        if ($keyword) {
            $this->_setQueryLikePK($keyword);
        }
        $this->db->like('status', $status, 'none');
        $this->db->order_by('created_at', 'ASC');
        $this->db->limit($limit, $start);
    }


    private function _getQueryLikePK($keyword = null)
    {
        return $this->_setQueryLikePK($keyword);
    }


    //pencarian
    public function countAllPK($keyword = null, $status = null)
    {

        $this->_getQueryLikePK($keyword, $status);
        $this->db->from($this->tblQVOrderan);

        return $this->db->count_all_results();
    }

    // gate utama
    public function getDataPK(
        $limit,
        $start,
        $keyword = null,
        $status = null
    ) {
        $this->_setQueryPK($limit, $start, $keyword, $status);
        return $this->db->get();
    }
    // Batas PAgination


}
