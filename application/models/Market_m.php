<?php

class Market_m extends CI_Model
{
    public function getproduk($id = null)
    {
        $this->db->from('tb_produk');
        if ($id != null) {
            $this->db->where('produk_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getformarket($table, $id = null)
    {
        $this->db->like('produk_id', $id, 'none');
        $this->db->from($table);
        if ($id != null) {
            $this->db->where('produk_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getframe($id = null)
    {
        $this->db->from('m_frame');
        if ($id != null) {
            $this->db->where('frame_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function getmarketlink($id = null, $produk = null, $user = null)
    {
        $this->db->select('p_linkproduk.atc,vc,prelander', 'p_linkproduk.produk_id ');
        $this->db->select('m_frame.label,fbpx1,fbpx2,hidden_key', 'm_frame.produk_id ');
        $this->db->select('tb_marketlink.*', 'user_id as market_user_id');
        $this->db->like('tb_marketlink.user_id', $user, 'none');
        $this->db->like('tb_marketlink.produk_id', $produk, 'none');
        $this->db->where('tb_marketlink.visible', '1');
        // $this->db->like('tb_marketlink.produk_id', $produk, 'none');
        $this->db->join('p_linkproduk', 'p_linkproduk.linkproduk_id = tb_marketlink.linkproduk_id');
        $this->db->join('m_frame', 'm_frame.frame_id = tb_marketlink.frame_id');
        $this->db->from('tb_marketlink');
        $this->db->order_by('tb_marketlink.created_at', 'asc');
        if ($id != null) {
            $this->db->where('marketlink_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function updatelinktodel($post)
    {
        $params = [
            'marketlink_id' => $post['marketlink_id'],
            'visible' => $post['visible'],
        ];
        $this->db
            ->where('marketlink_id', $post['marketlink_id'])
            ->update('tb_marketlink', $params);
    }

    public function addframe($post)
    {
        $params = [
            'frame_id' => $post['frame_id'],
            'user_id' => $post['user_id'],
            'produk_id' => $post['produk_id']
        ];
        $this->db->insert('m_frame', $params);
    }

    public function addmarketlink($post)
    {
        $params = [
            'marketlink_id' => $post['marketlink_id'],
            'frame_id' => $post['frame_id'],
            'linkproduk_id' => $post['linkproduk_id'],
            'user_id' => $post['user_id'],
            'produk_id' => $post['produk_id']
        ];
        $this->db->insert('tb_marketlink', $params);
    }

    public function editframe($post)
    {
        $params = [
            'frame_id' => $post['frame_id'],
            'label' => $post['labelset'],
            'fbpx1' => $post['fbpixel1'],
            'fbpx2' => $post['fbpixel2'],
            'hidden_key' => $post['hidden_key'] != '' ?  $post['hidden_key'] : null
        ];
        $this->db->where('frame_id', $post['frame_id']);
        $this->db->update('m_frame', $params);
    }
    public function del($id)
    {
        $this->db->delete('m_frame', ['frame_id' => $id]);
        $this->db->delete('tb_marketlink', ['frame_id' => $id]);
    }
}
