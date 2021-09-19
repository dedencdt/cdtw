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


    // Seting Configurasi
    // Query Like
    // ==================
    // DATA FOLLOWUP BY CS
    // ===============
    function role_exists($table, $field, $value)
    {
        $this->db->where($field, $value);
        $query = $this->db->get($table);
        if (!empty($query->result())) {
            return 1;
        } else {
            return 0;
        }
    }

    private function _setQueryLikeFD($keyword = null)
    {
        // edit OR Like disini

        $arr = [
            'order_id' => $keyword,
            'nowa' => $keyword
        ];
        return $this->db->or_like($arr, 'none');
    }

    // Setting Query
    private function _setQueryFD(
        $limit,
        $start,
        $keyword = null,
        $user = null,
        $status
    ) {
        // $this->db->from($this->tblQVInorder);
        $this->db->from($this->tblQVOrderan);
        $this->db->group_start();
        if ($keyword) {

            $this->_setQueryLikeFD($keyword);
        }

        $this->db->like('cs_id', $user, 'none');
        $this->db->like('status', $status, 'none');
        $this->db->group_end();
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $start);
    }


    private function _getQueryLikeFD($keyword = null, $user = null, $status = null)
    {

        return $this->_setQueryLikeFD($keyword, $user, $status);
    }


    //pencarian
    public function countAllFD($keyword = null, $user = null, $status = null)
    {

        $this->_getQueryLikeFD($keyword, $user, $status);
        // $this->db->from($this->tblQVInorder);
        $this->db->from($this->tblQVOrderan);

        return $this->db->count_all_results();
        // return $this->db->num_row()->results();
    }

    // gate utama
    public function getDataFD($limit, $start, $keyword = null, $user = null, $status = null)
    {
        $this->_setQueryFD($limit, $start, $keyword, $user, $status);
        // $this->db->where('status', $status)
        //     ->where('cs_id', $user);
        return $this->db->get();
    }
    // Batas PAgination
    // ==================
    // BATAS FOLLOWUP BY CS
    // ===============
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
    public function countAllPK($keyword = null,  $status = null)
    {

        $this->_getQueryLikePK($keyword,  $status);
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
        $this->_setQueryPK($limit, $start, $keyword,  $status);
        return $this->db->get();
    }
    // Batas PAgination
    // ==================
    // BATAS PACKING
    // ===============


    // ===============
    // COD

    private function _setQueryLikeCOD($keyword = null, $status = null)
    {
        // edit OR Like disini
        $arr = [
            'order_id' => $keyword,
            'nowa' => $keyword,
            'resi' => $keyword,
            'created_at' => $keyword
        ];
        return $this->db->or_like($arr, 'none');
    }

    // Setting Query
    private function _setQueryCOD(
        $limit,
        $start,
        $keyword = null,
        $status = null
    ) {
        $this->db->from($this->tblQVOrderan);
        if ($keyword) {
            $this->_setQueryLikeCOD($keyword);
        }
        $this->db->like('status', $status, 'none');
        $this->db->order_by('created_at', 'DESC');

        $this->db->limit($limit, $start);
    }


    private function _getQueryLikeCOD($keyword = null)
    {
        return $this->_setQueryLikeCOD($keyword);
    }


    //pencarian
    public function countAllCOD($keyword = null,  $status = null)
    {

        $this->_getQueryLikeCOD($keyword,  $status);
        $this->db->from($this->tblQVOrderan);

        // return $this->db->affected_rows();
        return $this->db->count_all_results();
    }

    // gate utama
    public function getDataCOD(
        $limit,
        $start,
        $keyword = null,
        $status = null
    ) {
        $this->_setQueryCOD($limit, $start, $keyword,  $status);
        return $this->db->get();
    }
    // Batas PAgination
    // ==================
    // BATAS cod
    // ===============


    // ===============
    // RTS

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
        $status = null
    ) {
        $this->db->from($this->tblQVOrderan);
        if ($keyword) {
            $this->_setQueryLikeRTS($keyword);
        }
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
        $status = null
    ) {
        $this->_setQueryRTS($limit, $start, $keyword,  $status);
        return $this->db->get();
    }
    // Batas PAgination
    // ==================
    // BATAS RTS
    // ===============

    // ===============
    // DELIVERED

    private function _setQueryLikeOK($keyword = null, $status = null)
    {
        // edit OR Like disini
        $arr = [
            'penerima' => $keyword,
            'order_id' => $keyword,
            'nowa' => $keyword,
            'resi' => $keyword,
            'created_at' => $keyword
        ];
        return $this->db->or_like($arr);
    }

    // Setting Query
    private function _setQueryOK(
        $limit,
        $start,
        $keyword = null,
        $status = null
    ) {
        $this->db->from($this->tblQVOrderan);
        if ($keyword) {
            $this->_setQueryLikeOK($keyword);
        }
        $this->db->like('status', $status, 'none');
        $this->db->order_by('created_at', 'DESC');

        $this->db->limit($limit, $start);
    }


    private function _getQueryLikeOK($keyword = null)
    {
        return $this->_setQueryLikeOK($keyword);
    }


    //pencarian
    public function countAllOK($keyword = null,  $status = null)
    {

        $this->_getQueryLikeOK($keyword,  $status);
        $this->db->from($this->tblQVOrderan);

        return $this->db->count_all_results();
    }

    // gate utama
    public function getDataOK(
        $limit,
        $start,
        $keyword = null,
        $status = null
    ) {
        $this->_setQueryOK($limit, $start, $keyword,  $status);
        return $this->db->get();
    }
    // Batas PAgination
    // ==================
    // BATAS OK
    // ===============

    //=============
    //CEK ORDER
    //==============

    private function _setQueryLikeCEK($keyword = null)
    {
        // edit OR Like disini
        $arr = [
            'nama_cs' => $keyword, // CS
            'order_id' => $keyword, // Order ID 
            'nama_publisher' => $keyword // Publisher
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


    // common ci code

    public function getByCS($csid = null, $status = null)
    {

        $this->db->join('m_frame', 'm_frame.frame_id = tb_in_order.frame_id');
        $this->db->from('tb_in_order');
        if ($csid != null) {
            $this->db->like('cs_id', $csid, 'none');
        }
        $this->db->like('status', $status, 'none');
        $this->db->order_by('tb_in_order.created_at', 'DESC');
        $query = $this->db->get();
        return  $query;
    }

    public function getOrderan($status = null, $limit = null)
    {

        $this->db->join('tb_in_order', 'tb_in_order.in_order_id = tb_orderan.in_order_id');
        $this->db->from('tb_orderan');
        if ($status) {
            $this->db->like('tb_orderan.status', $status, 'none', $limit);
        }
        $query = $this->db->get();
        return  $query;
    }

    public function cekOrderan($status = null, $limit = null)
    {

        $this->db->join('tb_in_order', 'tb_in_order.in_order_id = tb_orderan.in_order_id');
        $this->db->from('tb_orderan');
        if ($status) {
            $this->db->like('tb_orderan.status', $status, 'none', $limit);
        }
        $query = $this->db->get();
        return  $query;
    }

    public function getFrameid($id)
    {

        $this->db->from('m_frame');
        $this->db->where('frame_id', $id);
        $query = $this->db->get();
        return $query;
    }


    public function add($post)
    {
        $params = [
            'in_order_id' => $post['in_order_id'],
            'order_id' => $post['order_id'],
            'nama_produk' => $post['namaproduk'],
            'status' => $post['status'],
            'penerima' => $post['penerima'],
            'alamat' => $post['alamat'],
            'nowa' => $post['nowa'],
            'frame_id' => $post['frame_id'],
            'cs_id' => $post['cs_id'],
            'harga' => $post['harga'],
            'ongkir' => $post['ongkir'],
            'total' => $post['total'],
            'order_created' => $post['order_created'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tb_in_order', $params);
    }

    public function addToOrderanFromFP($post)
    {
        $params = [
            'orderan_id' => $post['orderan_id'],
            'in_order_id' => $post['in_order_id'],
            'status' => $post['status'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tb_orderan', $params);
    }

    public function editToOrderan($post)
    {
        $params = [
            'orderan_id' => $post['orderan_id'],
            'in_order_id' => $post['in_order_id'],
            'vendor_id' => $post['vendor_id'],
            'status' => $post['status'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('orderan_id', $post['orderan_id']);
        $this->db->update('tb_orderan', $params);
    }


    public function edit($post)
    {
        $params = [
            'in_order_id' => $post['in_order_id'],
            'penerima' => $post['penerima'],
            'alamat' => $post['alamat1'] . '~' . $post['alamat2'] . ',' . $post['kec'] . '~' . $post['kota'] . '~' . $post['prov'] . '~' . $post['kodepos'],
            'nowa' => $post['nowa'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('in_order_id', $post['in_order_id']);
        $this->db->update('tb_in_order', $params);
    }

    public function editInOrderStatus($post)
    {
        $params = [
            'in_order_id' => $post['in_order_id'],
            'status' => $post['status'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('in_order_id', $post['in_order_id']);
        $this->db->update('tb_in_order', $params);
    }

    public function editOrderan($post)
    {
        $params = [
            'orderan_id' => $post['orderan_id'],
            'in_order_id' => $post['in_order_id'],
            'vendor_id' => $post['vendor_id'],
            'resi' => $post['resi'],
            'status' => $post['status'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('orderan_id', $post['orderan_id']);
        $this->db->update('tb_orderan', $params);
    }

    public function editClosingOrderan($post)
    {
        $params = [
            'orderan_id' => $post['orderan_id'],
            'in_order_id' => $post['in_order_id'],
            'status' => $post['status'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('orderan_id', $post['orderan_id']);
        $this->db->update('tb_orderan', $params);
    }

    public function editFromOrderan($post)
    {
        $params = [
            'in_order_id' => $post['in_order_id'],
            'status'    => $post['status'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('in_order_id', $post['in_order_id']);
        $this->db->update('tb_in_order', $params);
    }

    public function getLastOrder($id = null)
    {
        $this->db->from('tb_in_order');
        if ($id != null) {
            $this->db->where('order_id', $id);
        }
        // $this->db->order_by('created_at', 'DESC', 1);
        $query = $this->db->get();
        return  $query;
    }

    public function oktosiapcair($post)
    {
        $random = 'cdt' . date('ymd') . random_string('alnum', 21);
        $params = [
            'siapcair_id' => $random,
            'member_in' => $post['member_in'],
            'vendor_in' => $post['vendor_in'],
            'cs_in' => 4000,
            'user_id' => $post['user_id'],
            'cs_id' => $post['cs_id'],
            'vendor_id' => $post['vendor_id'],
            'created_at' => date('Y-m-d')

        ];
        $this->db->insert('tb_siapcair', $params);
    }

    public function rtstosiapcair($post)
    {
        $random = 'cdt' . date('ymd') . random_string('alnum', 21);
        $params = [
            'siapcair_id' => $random,
            'member_out' => $post['ongkir'],
            'user_id' => $post['user_id'],
            'cs_id' => $post['cs_id'],
            'vendor_id' => $post['vendor_id'],
            'created_at' => date('Y-m-d')

        ];
        $this->db->insert('tb_siapcair', $params);
    }
}
