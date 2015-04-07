<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_mod extends CI_Model {

    function user_mod()
    {
        parent::__construct();
    }

    function get($id)
    {
        $this->db->select('
            user_accounts.*,
            c.name as city_name
            ');
        
        $this->db->join('cities c', 'user_accounts.city_id = c.id','left');
        $this->db->where('user_accounts.id', mysql_real_escape_string($id));
        $i = $this->db->get('user_accounts', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }


    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('user_accounts', $data);
    }

    function get_members($rows=false,$where=null,$limit=false,$skip=0,$take=10,$sort=FALSE)
    {
        $this->db->select('*');

        if($sort){
            $this->db->order_by($sort[0],$sort[1]);
        }else {
            $this->db->order_by('user_accounts.created','desc');
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

        if($limit) {
            $this->db->limit($take,$skip);
        }
        
        $i = $this->db->get('user_accounts');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
    
    function update_point($point=0,$user_id=0)
    {
        $data_update = array(
            'last_points' => $point
        );
        $this->update($data_update,$user_id);
    }
}