<?php

class Dashboard_m extends CI_Model
{
    private $tableuser = 'tb_user';

    public function getVisitor($userid, $tgl = null, $page = null)
    {
        $this->db->join('m_frame', 'm_frame.frame_id = m_tracking.frame_id');
        $this->db->from('m_tracking');
        $this->db->like('m_tracking.created_at', $tgl, 'none');
        $this->db->like('m_tracking.label', $page, 'none');
        $this->db->where('m_frame.user_id', $userid);
        $query = $this->db->get();
        return $query;
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
        // $params['email'] = $post['email'];
        $params['rekening'] = $post['rekening'];
        $params['alamat'] = $post['alamat']  != '' ? $post['alamat'] : null;
        // $params['role'] = $post['role'];
        $params['updated'] = date('Y-m-d H:i:s');

        $this->db->where('user_id', $post['user_id']);
        $this->db->update($this->tableuser, $params);
    }
}
