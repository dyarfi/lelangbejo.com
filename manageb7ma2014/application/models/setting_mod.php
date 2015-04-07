<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting_mod extends CI_Model {

    function setting_mod()
    {
        parent::__construct();
    }

    function update($data,$id=0)
    {
        $this->db->where('key', mysql_real_escape_string($id));
        $this->db->update('en_settings', $data);
    }

    function get($id=0)
    {
        $this->db->select('value');
        $this->db->where('key', mysql_real_escape_string($id));
        $i = $this->db->get('en_settings', 1, 0);

        return $var = ($i->num_rows() > 0) ? $i->row() : false;
    }
}