<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class item_mod extends CI_Model {

    function item_mod()
    {
        parent::__construct();
    }

    function get($id = 0)
    {
        $this->db->select('
            items.*,
            user_accounts.name as user_name,
            bidding.price as bidding_price
        ');
        $this->db->where('items.id', mysql_real_escape_string($id));
        
        $this->db->join('user_accounts', 'items.user_id = user_accounts.id','left');
        $this->db->join('bidding', 'items.bidding_id = bidding.id','left');
        $i = $this->db->get('items', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('items',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }


    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('items', $data);
    }
    
    function delete($item_id=0)
    {
        //Delete items
        $this->db->delete('items',array('id' => mysql_real_escape_string($item_id)));
        //Delete bidding
        $this->db->delete('bidding',array('item_id' => mysql_real_escape_string($item_id)));
    }
    
    function update_active()
    {
        $data = array(
            'is_active' => 0
        );
        $this->db->update('items', $data);
    }

    function get_items($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        $this->db->select("items.*,en_admins.full_name as created_by_name,m.full_name as modified_by_name");
        $this->db->order_by('items.is_active','desc');
        $this->db->order_by('items.created','desc');

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

        if($limit) {
            $this->db->limit($take,$skip);
        }

        $this->db->join('en_admins', 'items.created_by = en_admins.id','left');
        $this->db->join('en_admins m', 'items.modified_by = m.id','left');
        $i = $this->db->get('items');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}