<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_mod extends CI_Model {

    function admin_mod()
    {
        parent::__construct();
    }

    /*
     * Categori untuk type page
     */
    var $item = 'item';
    var $item_add = 'item_add';
    var $item_edit = 'item_edit';
    var $item_set = 'item_set';
    var $item_delete = 'item_delete';

    var $code = 'code';
    //var $code_add = 'code_add';
    var $code_edit = 'code_edit';
    
    var $notification = 'notification';

    var $report = 'report';
    var $report_print = 'report_print';

    var $member = 'member';
    var $member_edit = 'member_edit';
    var $member_print = 'member_print';

    function get_page()
    {
        $array = array();
        foreach ($this->data_page() as $key=>$val)
        {
            $array[] = array('id' => $key,'name' => $val);
        }

        return $array;
    }

    function data_page($arr=true, $id=0)
    {

        $data = array();
        $data[$this->item] = 'Manage Item';
        $data[$this->item_add] = 'Manage Item (Add)';
        $data[$this->item_edit] = 'Manage Item (Edit)';
        $data[$this->item_set] = 'Manage Item (Set Winner)';
        $data[$this->item_delete] = 'Manage Item (Delete)';
        $data[$this->code] = 'Manage Transaction Code';
        //$data[$this->code_add] = 'Manage Transaction Code (Add)';
        $data[$this->code_edit] = 'Manage Transaction Code (Edit)';
        $data[$this->notification] = 'Manage Send Notification';
        $data[$this->report] = 'Manage Activity';
        $data[$this->report_print] = 'Manage Activity (Report)';
        $data[$this->member] = 'Manage Member';
        $data[$this->member_edit] = 'Manage Member (Edit)';
        $data[$this->member_print] = 'Manage Member (Report)';

        if(!$arr){
            return $val = isset($data[$id]) ? $data[$id] : '';
        }else{
           return $data;
        }
    }

    function get_byuid($user_id = 0)
    {
        $this->db->select('*');
        $this->db->where('id', mysql_real_escape_string($user_id));
        
        $i = $this->db->get('en_admins', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function get_byusername($username = 0)
    {
        $this->db->select('*');
        $this->db->where('username', mysql_real_escape_string($username));

        $i = $this->db->get('en_admins', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('en_admins',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }

    function get_bylogin($username = null,$pass = null)
    {
        $this->db->select('*');
        $this->db->where('username', mysql_real_escape_string($username));
        $this->db->where('password', mysql_real_escape_string($pass));
        $i = $this->db->get('en_admins', 1, 0);

        $var = ($i->num_rows() > 0) ? $i->row() : false;
        if($var){
            $data = array(
                'last_loggedin_date' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $var->id);
            $this->db->update('en_admins', $data);
        }

        return $var;
    }

    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('en_admins', $data);
    }

    function get_admins($rows=false,$limit=false,$skip=0,$take=10)
    {
        $this->db->select("*");
        $this->db->order_by('id','asc');

        if($limit) {
            $this->db->limit($take,$skip);
        }

        $i = $this->db->get('en_admins');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}