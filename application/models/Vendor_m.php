<?php

class Vendor_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->join('tb_user', 'tb_user.user_id = tb_vendor.user_id');
        $this->db->join('tb_produk', 'tb_produk.produk_id = tb_vendor.produk_id');
        $this->db->from('tb_vendor');
        if ($id != null) {
            $this->db->where('vendor_id', $id);
        } else {
            $this->db->order_by('tb_vendor.created_at', 'DESC');
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_vendor($id = null)
    {
        $this->db->like('role', 4, 'none');
        $this->db->from('tb_user');
        if ($id != null) {
            $this->db->where('tb_user', $id);
        } else {
            $this->db->order_by('created_at', 'DESC');
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'vendor_id' => $post['vendor_id'],
            'user_id' => $post['vendor_name'],
            'produk_id' => $post['produk_name'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tb_vendor', $params);
    }

    public function edit($post)
    {
        $params = [
            'vendor_id' => $post['vendor_id'],
            'user_id' => $post['vendor_name'],
            'produk_id' => $post['produk_name'],
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('vendor_id', $post['vendor_id']);
        $this->db->update('tb_vendor', $params);
    }

    public function del($id)
    {
        $this->db->where('vendor_id', $id);
        $this->db->delete('tb_vendor');
    }
}
