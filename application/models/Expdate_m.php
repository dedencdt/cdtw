<?php

class Expdate_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('l_expdate');
        if ($id != null) {
            $this->db->where('expdate_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'expdate_id' => $post['expdate_id'],
            'exp_date' => implode(' ', [$post['masa_exp'], $post['format_exp']]),
            'harga' => $post['harga']
        ];
        $this->db->insert('l_expdate', $params);
    }

    public function edit($post)
    {
        $params = [
            'exp_date' => implode(' ', [$post['masa_exp'], $post['format_exp']]),
            'harga' => $post['harga']
        ];

        $this->db->where('expdate_id', $post['expdate_id']);
        $this->db->update('l_expdate', $params);
    }

    public function del($id)
    {
        $this->db->where('expdate_id', $id);
        $this->db->delete('l_expdate');
    }
}
