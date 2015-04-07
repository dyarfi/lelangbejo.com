<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class item_mod extends CI_Model {

    function item_mod()
    {
        parent::__construct();
    }
    
    function get($item_id=0)
    {
        $this->db->select("
            items.*,
            user_accounts.name as user_name,
            user_accounts.avatar_file,
            bidding.price as bidding_price
        ");
        $this->db->where('items.is_finish',1);
        $this->db->where('items.id', mysql_real_escape_string($item_id));
        
        $this->db->join('user_accounts', 'items.user_id = user_accounts.id','left');
        $this->db->join('bidding', 'items.bidding_id = bidding.id','left');
        $i = $this->db->get('items', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function get_item_active()
    {
        $this->db->select("
            items.*,
            user_accounts.name as user_name,
            user_accounts.avatar_file,
            bidding.price as bidding_price
        ");
        $this->db->where('items.is_active', 1);
        
        $this->db->join('user_accounts', 'items.user_id = user_accounts.id','left');
        $this->db->join('bidding', 'items.bidding_id = bidding.id','left');
        $i = $this->db->get('items', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }
    
    function get_rows($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        $this->db->select("
            items.*,
            user_accounts.name as user_name,
            bidding.price as bidding_price
        ");
        $this->db->order_by('items.modified','desc');

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

        $this->db->where('items.is_finish',1);
        $this->db->join('user_accounts', 'items.user_id = user_accounts.id','left');
        $this->db->join('bidding', 'items.bidding_id = bidding.id','left');
        $i = $this->db->get('items');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}