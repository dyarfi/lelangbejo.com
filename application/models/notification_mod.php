<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class notification_mod extends CI_Model {

    function notification_mod()
    {
        parent::__construct();
    }
    
    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('notification',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }
}