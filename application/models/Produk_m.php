<?php

class Produk_m extends CI_Model
{


    var $tableName = 'tb_produk';

    // Seting Configurasi
    // Query Like
    private function _setQueryLike($keyword = null)
    {
        // edit OR Like disini
        $arr = [
            'nama_produk' => $keyword,
            'level' => $keyword
        ];
        return $this->db->or_like($arr);
    }

    // Setting Query
    private function _setQuery($limit, $start, $keyword = null)
    {
        $this->db->from($this->tableName);
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
        $this->db->from($this->tableName);
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
        $this->db->from('tb_produk');
        if ($id != null) {
            $this->db->where('produk_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'produk_id' => $post['produk_id'],
            'nama_produk' => $post['nama_produk'],
            'harga' => $post['harga'],
            'komisi' => $post['komisi'],
            'harga_vendor' => $post['hrg_vendor'],
            'stock' => $post['stock'],
            'level' => $post['level'],
            'desk' => $post['desk'] != null ? $post['desk'] : null,
            'gambar' => $post['gambar'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tb_produk', $params);
    }

    public function edit($post)
    {
        $params = [
            'produk_id' => $post['produk_id'],
            'nama_produk' => $post['nama_produk'],
            'harga' => $post['harga'],
            'komisi' => $post['komisi'],
            'harga_vendor' => $post['hrg_vendor'],
            'stock' => $post['stock'],
            'level' => $post['level'],
            'desk' => $post['desk'] != null ? $post['desk'] : null,
            'gambar' => $post['gambar'],
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('produk_id', $post['produk_id']);
        $this->db->update('tb_produk', $params);
    }

    public function del($id)
    {
        $this->db->where('produk_id', $id);
        $this->db->delete('tb_produk');
    }
}
