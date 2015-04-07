<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class point_mod extends CI_Model {

    function point_mod()
    {
        parent::__construct();
    }

     /*
     * Categori untuk type
     */
    var $register = 'register';
    var $code = 'code';
    var $facebook = 'facebook';
    var $twitter = 'twitter';
    var $invitation = 'invitation';
    var $bidding = 'bidding';

    function add($data=null)
    {
        $return = 0;
        if($data != null){
            $this->db->insert('points',$data);

            $return = $this->db->insert_id();
        }

        return $return;
    }

    function get_total_share_byday($user_id = 0,$type='facebook')
    {
        $this->db->select('*');
        $this->db->where('user_id', mysql_real_escape_string($user_id));
        $this->db->where('type', mysql_real_escape_string($type));
        $this->db->where('DATE(created)', date_now_id());
        
        $i = $this->db->get('points');

        return $i->num_rows();
    }

    function get_total_share_byperiod($user_id = 0,$type='facebook', $start_date=NULL, $end_date=NULL)
    {
        $this->db->select('*');
        $this->db->where('user_id', mysql_real_escape_string($user_id));
        $this->db->where('type', mysql_real_escape_string($type));
        
        if(!empty ($start_date) && !empty ($end_date)){
            $this->db->where("created >= '".$start_date."'", null, FALSE);
            $this->db->where("created <= '".$end_date."'", null, FALSE);
        }

        $i = $this->db->get('points', 1, 0);

        return $var = $i->num_rows();
    }
    
    function get_rows($rows=false,$where=null,$limit=false,$skip=0,$take=10,$sort=FALSE)
    {
        $this->db->select("*");
        if($sort){
            $this->db->order_by($sort['filed'],$sort['sort']);
        }else{
            $this->db->order_by('created','desc');
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

        $i = $this->db->get('points');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }
}