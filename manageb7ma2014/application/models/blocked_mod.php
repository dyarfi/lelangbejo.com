<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class blocked_mod extends CI_Model {

    function blocked_mod()
    {
        parent::__construct();
    }

    function get_byip($ip = 0)
    {
        $this->db->select('*');
        $this->db->where('ip_address', mysql_real_escape_string($ip));
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id','desc');
        
        $i = $this->db->get('en_blocked', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('en_blocked',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }


    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('en_blocked', $data);
    }

    function get_blocked($rows=false,$limit=false,$skip=0,$take=10)
    {
        $this->db->select("*");
        $this->db->order_by('id','desc');

        if($limit) {
            $this->db->limit($take,$skip);
        }

        $this->db->where('is_deleted', 0);
        $i = $this->db->get('en_blocked');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}