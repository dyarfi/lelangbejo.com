<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_mod extends CI_Model {

    function user_mod()
    {
        parent::__construct();
    }

    function get_byemail($email = null)
    {
        $this->db->select('*');
        $this->db->where('email', mysql_real_escape_string($email));
        $i = $this->db->get('user_accounts', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function get_byuid($user_id = 0)
    {
        $this->db->select('*');
        $this->db->where('id', mysql_real_escape_string($user_id));
        
        $i = $this->db->get('user_accounts', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('user_accounts',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }

    function add_friend($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('user_friends',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }

    function update($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('user_accounts', $data);
    }

    function update_friend($data,$id=0)
    {
        $this->db->where('id', mysql_real_escape_string($id));
        $this->db->update('user_friends', $data);
    }

    function update_point($point=0,$user_id=0)
    {
        $data_update = array(
            'last_points' => $point
        );
        $this->update($data_update,$user_id);
    }
    
    function check_user_fb($fb_id)
    {
        $this->db->select('*');
        $this->db->where("facebook_id",mysql_real_escape_string($fb_id));
        $i = $this->db->get('user_accounts');

        $var = ($i->num_rows() > 0) ? $i->row() : FALSE;
        if($var){
            $data = array(
                'last_loggedin_date' => date_now_id(TRUE)
            );
            $this->db->where('id', $var->id);
            $this->db->update('user_accounts', $data);
        }
        return $var;
    }

    function get_user_fbid($fbId)
    {
        $this->db->select('*');
        $this->db->where("facebook_id",mysql_real_escape_string($fbId));
        $i = $this->db->get('user_accounts', 1, 0);

        $var = ($i->num_rows() > 0) ? true : false;
        return $var;
    }
    
    function get_user_twid($twId,$uid=0)
    {
        $this->db->select('*');
        $this->db->where("twitter_id",mysql_real_escape_string($twId));
        if($uid!=0) {
            $this->db->where("id !=",mysql_real_escape_string($uid));
        }
        $i = $this->db->get('user_accounts', 1, 0);

        return $var = ($i->num_rows() > 0) ? true : false;
    }

    function get_friends($user_id=0,$facebook_ids=FALSE)
    {
        $this->db->select('*');
        $this->db->order_by('facebook_name','asc');
        $this->db->where("user_id",mysql_real_escape_string($user_id));
        if($facebook_ids){
            $this->db->where_in("facebook_id",$facebook_ids);
            $this->db->where("invited=0",NULL,FALSE);
        }
        $i = $this->db->get('user_friends');

        return $var = ($i->num_rows() > 0) ?  $i->result_array() : FALSE;
    }

    function get_friend($facebook_id=0,$user_id=0)
    {
        $this->db->select('*');
        $this->db->where("facebook_id",mysql_real_escape_string($facebook_id));
        $this->db->where("user_id",mysql_real_escape_string($user_id));
        $i = $this->db->get('user_friends', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : FALSE;
    }

    function check_invite_byday($user_id = 0)
    {
        $this->db->select('*');
        $this->db->where('user_id', mysql_real_escape_string($user_id));
        $this->db->where('invited', 1);
        $this->db->where('DATE(invited_date)', date_now_id());


        $i = $this->db->get('user_friends', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }
    
    function total_invite_byday($user_id = 0)
    {
        $this->db->select('*');
        $this->db->where('user_id', mysql_real_escape_string($user_id));
        $this->db->where('invited', 1);
        $this->db->where('DATE(invited_date)', date_now_id());

        $i = $this->db->get('user_friends');

        return $i->num_rows();
    }
}