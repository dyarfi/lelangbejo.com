<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class code_mod extends CI_Model {

    function code_mod()
    {
        parent::__construct();
    }

    function get($code=NULL)
    {
        $this->db->select('*');
        $this->db->where('LOWER(code)', mysql_real_escape_string(strtolower($code)));
        
        $i = $this->db->get('codes', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }
    
    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('codes',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }
    
    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('codes', $data);
    }
}