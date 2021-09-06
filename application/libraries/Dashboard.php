<?php

use AC\Column\User\Name;

class Dashboard
{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function count_visit($userid, $tgl, $page, $produkid)
    {
        $this->ci->db->join('m_frame', 'm_frame.frame_id = m_tracking.frame_id');
        $this->ci->db->from('m_tracking');
        $this->ci->db->like('m_tracking.created_at', $tgl, 'none');
        $this->ci->db->like('m_tracking.label', $page, 'none');
        if ($produkid != null) {
            $this->ci->db->like('m_frame.produk_id', $produkid, 'none');
        }
        $this->ci->db->where('m_frame.user_id', $userid);
        $query = $this->ci->db->get()->num_rows();
        return $query;
    }
}
