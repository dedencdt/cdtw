<?php

class Langganan_m extends CI_Model
{


    var $tableName = 'tb_langganan';
    var $qvtable = 'qv_langganan';

    // Seting Configurasi
    // Query Like
    private function _setQueryLike($keyword = null)
    {
        // edit OR Like disini
        $arr = [
            'status' => $keyword,
            'username' => $keyword,
            'invoice' => $keyword,
            'created_at' => $keyword
        ];
        return $this->db->or_like($arr);
    }

    // Setting Query
    private function _setQuery($limit, $start, $keyword = null)
    {
        // $this->db->select('*,tb_user.username,created_at as langganan_created ');
        $this->db->from($this->qvtable);
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
        $this->db->from($this->qvtable);
        return $this->db->count_all_results();
    }

    public function getData($limit, $start, $keyword = null)
    {
        $this->_setQuery($limit, $start, $keyword);
        return $this->db->get();
    }
    // Batas PAgination



    public function get($id = null)
    {
        $this->db->select('tb_langganan.*,tb_user.username,tb_langganan.created_at as langganan_created ');
        $this->db->from('tb_langganan');
        $this->db->join('tb_user', 'tb_user.user_id = tb_langganan.user_id', 'inner');
        $this->db->order_by('tb_langganan.created_at', 'DESC');

        if ($id != null) {
            $this->db->where('langganan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }



    public function add($post)
    {
        $exharga = explode('|', $post['exp_date']);

        $params = [
            'langganan_id' => $post['langganan_id'],
            'user_id' => $post['user_id'],
            'durasi' => date('Y-m-d H:i:s', strtotime($exharga[0])),
            'invoice' => $post['invoice'],
            'harga' => (int)$exharga[1],
            'paymethod' => $post['paymethod'],
            'status' => $post['status'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tb_langganan', $params);
    }

    public function edit($post)
    {
        $exharga = explode('|', $post['exp_date']);

        $params = [
            'langganan_id' => $post['langganan_id'],
            'user_id' => $post['user_id'],
            'durasi' => date('Y-m-d H:i:s', strtotime($exharga[0])),
            'invoice' => $post['invoice'],
            'harga' => (int)$exharga[1],
            'paymethod' => $post['paymethod'],
            'status' => $post['status'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('langganan_id', $post['langganan_id']);
        $this->db->update('tb_langganan', $params);
    }

    public function setConfStatus($post)
    {
        $params = [
            'langganan_id' => $post['langganan_id'],
            'status' => $post['status'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('langganan_id', $post['langganan_id']);
        $this->db->update('tb_langganan', $params);
    }

    public function del($id)
    {
        $this->db->where('langganan_id', $id);
        $this->db->delete('tb_langganan');
    }

    /**
     * For user
     */
}
