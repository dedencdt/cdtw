<?php

class Api_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('tb_apikey');
        if ($id != null) {
            $this->db->where('apikey_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function add($post)
    {
        $params = [
            'apikey_id' => $post['apikey_id'],
            'nama' => $post['nama'],
            'key' => $post['key'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tb_apikey', $params);
    }

    public function edit($post)
    {
        $params = [
            'apikey_id' => $post['apikey_id'],
            'nama' => $post['nama'],
            'key' => $post['key']
        ];

        $this->db->where('apikey_id', $post['apikey_id']);
        $this->db->update('tb_apikey', $params);
    }

    public function del($id)
    {
        $this->db->where('apikey_id', $id);
        $this->db->delete('tb_apikey');
    }


    //untuk public api

    // cek api key
    public function key($apikey)
    {
        $this->db->select('*');
        $this->db->from('tb_apikey');
        $this->db->where('key', $apikey);
        $query = $this->db->get();
        return $query;
    }

    public function senddata($data)
    {
        $add = $this->db->insert('m_tracking', $data);

        if ($add) {
            return true;
        } else {
            return false;
        }
    }

    public function getdata($id = null)
    {
        // $this->db->select('m_tracking.fbpx1,fbpx2,hidden_key,user_id,produk_id');
        $this->db->from('m_frame');
        $this->db->order_by('created_at', 'ASC', 1);
        if ($id != null) {
            // mengambil parameter id = frame id
            $this->db->where('frame_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }




    public function addlink($post)
    {


        $add = $this->db->insert('tb_linkreff', $post);

        if ($add) {
            return true;
        } else {
            return false;
        }
    }
}
