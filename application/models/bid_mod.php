<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bid_mod extends CI_Model {

    function bid_mod()
    {
        parent::__construct();
    }

    function get_user_group($item_id=0,$price=0,$bidding_id=0)
    {
        $this->db->select(""
                . "bidding.*,"
                . "user_accounts.name  as user_name,"
                . "user_accounts.email as user_email");
        $this->db->where('bidding.item_id', mysql_real_escape_string($item_id));
        $this->db->where('bidding.price', mysql_real_escape_string($price));
        $this->db->where('bidding.id not in('.$bidding_id.')', NULL,FALSE);
        $this->db->group_by('bidding.user_id');
        
        $this->db->join('user_accounts', 'bidding.user_id = user_accounts.id','left');
        $i = $this->db->get('bidding');

        return $var = ($i->num_rows() > 0) ? $i->result_array() : false;
    }
    
    function get_users($item_id=0)
    {
        $this->db->select(""
                . "bidding.*,"
                . "user_accounts.name  as user_name,"
                . "user_accounts.email as user_email");
        
        $this->db->order_by('bidding.price','asc');
        $this->db->order_by('bidding.created','asc');
        $this->db->where('bidding.item_id', mysql_real_escape_string($item_id));
        
        $this->db->join('user_accounts', 'bidding.user_id = user_accounts.id','left');
        $i = $this->db->get('bidding');

        return $var = ($i->num_rows() > 0) ? $i->result_array() : false;
    }
    
    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('bidding',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }
    
    function get_rows($rows=false,$where=null,$limit=false,$skip=0,$take=10,$sort=FALSE)
    {
        $this->db->select(""
                . "bidding.*,"
                . "items.name as item_name");
        if($sort){
            $this->db->order_by($sort['filed'],$sort['sort']);
        }else{
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

        $this->db->join('items', 'bidding.item_id = items.id','left');
        $i = $this->db->get('bidding');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}