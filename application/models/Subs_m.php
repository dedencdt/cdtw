<?php

class Subs_m extends CI_Model
{

    public function getid($id = null)
    {

        $this->db->select('*')->order_by('created_at', "desc")->limit(1);
        //add latest
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $this->db->from('tb_langganan');
        $query = $this->db->get();
        return $query;
    }

    public function getuser($id = null)
    {

        $this->db->like('user_id', $id, 'none');
        $this->db->from('tb_langganan');

        $query = $this->db->get();
        return $query;
    }
}
