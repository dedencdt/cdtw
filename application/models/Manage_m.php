<?php

class Manage_m extends CI_Model
{
    // endpoint ajax Model
    // data cek orderan
    var $tableInOrder = 'tb_in_order';
    var $tableOrder = 'tb_orders';
    var $tblQVInorder = 'qv_in_order_jn';
    var $tblQVOrderan = 'qv_orderan_jn';
    var $tblQVCekOrderan = 'qv_cek_orderan';



    //=============
    //CEK ORDER
    //==============

    private function _setQueryLikeCEK($keyword = null)
    {
        // edit OR Like disini
        $arr = [
            'nama_cs' => $keyword, // CS
            'nama_publisher' => $keyword, // Publihser
            'order_id' => $keyword, // Order ID 
            'nama_publisher' => $keyword, // Publisher
            'status' => $keyword // Publisher
        ];
        return $this->db->or_like($arr, 'none');
    }

    // Setting Query
    private function _setQueryCEK(
        $limit,
        $start,
        $keyword = null
    ) {


        $this->db->from($this->tblQVCekOrderan);
        if ($keyword) {
            $this->_setQueryLikeCEK($keyword);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('created_at', 'DESC');
    }



    private function _getQueryLikeCEK($keyword = null)
    {
        return $this->_setQueryLikeCEK($keyword);
    }



    public function countAllCEK($keyword = null)
    {
        $this->_getQueryLikeCEK($keyword);
        $this->db->from($this->tblQVCekOrderan);
        return $this->db->count_all_results();
    }

    public function getDataCEK($limit, $start, $keyword = null)
    {
        $this->_setQueryCEK($limit, $start, $keyword);
        return $this->db->get();
    }
    // Batas PAgination

}
