<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class code_mod extends CI_Model {

    function code_mod()
    {
        parent::__construct();
    }
    
    function get_bycode($code = 0)
    {
        $this->db->select('*');
        $this->db->where('LOWER(code)', mysql_real_escape_string(strtolower($code)));
        
        $i = $this->db->get('codes', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function get($id = 0)
    {
        $this->db->select("codes.*,"
                . "user_accounts.name as user_name,"
                . "user_accounts.email as user_email,"
                . "user_accounts.last_points"
                . "");
        $this->db->where('codes.id', mysql_real_escape_string($id));
        $this->db->join('user_accounts', 'codes.created_by = user_accounts.id','left');
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

    function update_active()
    {
        $data = array(
            'is_active' => 0
        );
        $this->db->update('codes', $data);
    }

    function get_codes($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        $this->db->select("codes.*,"
                . "user_accounts.name as user_name,"
                . "en_admins.full_name as admin_name"
                . "");
        $this->db->order_by('codes.created','desc');

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

        $this->db->join('user_accounts', 'codes.created_by = user_accounts.id','left');
        $this->db->join('en_admins', 'codes.approved_by = en_admins.id','left');
        $i = $this->db->get('codes');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}