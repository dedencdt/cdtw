<?php

class Linkproduk_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('p_linkproduk.*,tb_produk.nama_produk');
        $this->db->join('tb_produk', 'tb_produk.produk_id = p_linkproduk.produk_id');
        $this->db->from('p_linkproduk');
        if ($id != null) {
            $this->db->where('linkproduk_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'linkproduk_id' => $post['linkproduk_id'],
            'label' => $post['label'],
            'vc' => $post['vc'],
            'atc' => $post['atc'],
            'prelander' => $post['prelander'] != null ? $post['prelander'] : null,
            'produk_id' => $post['produk_id'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('p_linkproduk', $params);
    }

    public function edit($post)
    {
        $params = [
            'linkproduk_id' => $post['linkproduk_id'],
            'label' => $post['label'],
            'vc' => $post['vc'],
            'atc' => $post['atc'],
            'prelander' => $post['prelander'] != null ? $post['prelander'] : null,
            'produk_id' => $post['produk_id'],
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('linkproduk_id', $post['linkproduk_id']);
        $this->db->update('p_linkproduk', $params);
    }

    public function del($id)
    {
        $this->db->where('linkproduk_id', $id);
        $this->db->delete('p_linkproduk');
    }
}
