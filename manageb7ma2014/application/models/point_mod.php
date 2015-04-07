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
}