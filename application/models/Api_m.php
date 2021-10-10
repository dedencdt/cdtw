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
        // $label = $data['label'];
        // $frame = $data['frame_id'];
        // $tgl = $data['created_at'];
        // $queryVisitor = $this->db->query("SELECT * FROM m_tracking WHERE label='$label' AND frame_id ='$frame' AND created_at ='$tgl'")->num_rows();
        // $cekQuery = isset($queryVisitor) ? ($queryVisitor) : 0;

        // if ($cekQuery == 0) {
        $this->db->insert('m_tracking', $data);


        //     // jika sudah ada
        // } else {
        //     return  $this->db->query("UPDATE m_tracking SET visit=visit+1 WHERE  label='$label ' AND frame_id ='$frame' AND created_at ='$tgl'");
        // }
    }

    public function getdata($id = null)
    {
        $this->db->from('m_frame');
        if ($id != null) {
            $this->db->where('frame_id', $id);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
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
