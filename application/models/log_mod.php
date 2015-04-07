<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class log_mod extends CI_Model {

    function log_mod()
    {
        parent::__construct();
    }
    
     /*
     * Categori untuk type
     */
    var $register = 'register';
    var $login = 'login';
    var $code = 'code';
    var $facebook = 'facebook';
    var $twitter = 'twitter';
    var $invitation = 'invitation';
    var $bidding = 'bidding';

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('log_activity',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }
    
    function get_total_share_byday($user_id = 0,$type='facebook')
    {
        $this->db->select('*');
        $this->db->where('user_id', mysql_real_escape_string($user_id));
        $this->db->where('category', mysql_real_escape_string($type));
        $this->db->where('DATE(created)', date_now_id());
        
        $i = $this->db->get('log_activity');

        return $i->num_rows();
    }
}