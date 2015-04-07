<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inbox_mod extends CI_Model {

    function inbox_mod()
    {
        parent::__construct();
    }
    
    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('inbox',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }
    
    function get_rows($rows=false,$where=null,$limit=false,$skip=0,$take=10,$sort=FALSE)
    {
        $this->db->select("*");
        if($sort){
            $this->db->order_by($sort['filed'],$sort['sort']);
        }else{
            $this->db->order_by('created','desc');
        }

        if($limit) {
            $this->db->limit($take,$skip);
        }

        if(!empty ($where)){
            if(count($where)){
                foreach ($where as $key=>$val){
                    if(!empty ($val)){
                        $this->db->where($key, mysql_real_escape_string($val));
                    }else{
                        $this->db->where($key, NULL, FALSE);
                    }
                }
            }
        }

        $i = $this->db->get('inbox');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}