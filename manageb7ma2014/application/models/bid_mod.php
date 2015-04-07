<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bid_mod extends CI_Model {

    function bid_mod()
    {
        parent::__construct();
    }
    
    function get($id = 0)
    {
        $this->db->select('*');
        $this->db->where('id', mysql_real_escape_string($id));
        
        $i = $this->db->get('bidding', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }
    
    function get_rows($rows=false,$where=null,$limit=false,$skip=0,$take=10,$sort=FALSE)
    {
        $this->db->select(""
                . "bidding.*,"
                . "user_accounts.name as user_name");
        if($sort){
            $this->db->order_by($sort['filed'],$sort['sort']);
        }else{
            $this->db->order_by('bidding.price','asc');
            $this->db->order_by('bidding.created','asc');
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

        $this->db->join('user_accounts', 'bidding.user_id = user_accounts.id','left');
        $i = $this->db->get('bidding');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}