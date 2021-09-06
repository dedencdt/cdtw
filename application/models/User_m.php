<?php

class User_m extends CI_Model
{

    var $tableName = 'tb_user';

    // Seting Configurasi
    // Query Like
    private function _setQueryLike($keyword = null)
    {
        // edit OR Like disini
        $arr = [
            'nama' => $keyword,
            'username' => $keyword,
            'role' => $keyword
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


    public function login($post)
    {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from($this->tableName);
        if ($id != null) {
            $this->db->where('user_id', $id);
        } else {
            $this->db->order_by('created_at', 'DESC');
        }
        $query = $this->db->get();
        return $query;
    }

    public function getmember()
    {

        $this->db->like('role', '2', 'none');
        $this->db->from($this->tableName);
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {

        $params['user_id'] = $post['user_id'];
        $params['username'] = $post['username'];
        $params['nama'] = $post['nama'];
        $params['password'] = sha1($post['password']);
        $params['nohp'] = $post['nohp'];
        $params['email'] = $post['email'];
        $params['rekening'] = $post['rekening'];
        $params['alamat'] = $post['alamat']  != '' ? $post['alamat'] : null;
        $params['role'] = $post['role'];
        $params['created_at'] = date('Y-m-d H:i:s');


        $this->db->insert($this->tableName, $params);
    }

    public function edit($post)
    {

        $params['user_id'] = $post['user_id'];
        $params['username'] = $post['username'];
        $params['nama'] = $post['nama'];
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
        }
        $params['nohp'] = $post['nohp'];
        $params['email'] = $post['email'];
        $params['rekening'] = $post['rekening'];
        $params['alamat'] = $post['alamat']  != '' ? $post['alamat'] : null;
        $params['role'] = $post['role'];
        $params['updated'] = date('Y-m-d H:i:s');

        $this->db->where('user_id', $post['user_id']);
        $this->db->update($this->tableName, $params);
    }

    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete($this->tableName);
    }
}
