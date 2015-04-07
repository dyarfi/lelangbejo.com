<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class log_mod extends CI_Model {

    function log_mod()
    {
        parent::__construct();
    }

    /*
     * Categori untuk type User
     */
    var $register = 'register';
    var $login = 'login';
    var $code = 'code';
    var $facebook = 'facebook';
    var $twitter = 'twitter';
    var $invitation = 'invitation';
    var $bidding = 'bidding';

    function get_category()
    {
        $array = array();
        foreach ($this->data_category() as $key=>$val)
        {
            $array[] = array('id' => $key,'name' => $val);
        }

        return $array;
    }

    function data_category($arr=true, $id=0)
    {
        $data = array();
        $data[$this->register] = 'Register';
        $data[$this->login] = 'Login';
        $data[$this->code] = 'Transaction Code';
        $data[$this->facebook] = 'Share Facebook';
        $data[$this->twitter] = 'Share Twitter';
        $data[$this->invitation] = 'Invitation';
        $data[$this->bidding] = 'Bidding';

        if(!$arr){
            return $val = isset($data[$id]) ? $data[$id] : '';
        }else{
           return $data;
        }
    }

    function get_log_group_date()
    {
        $query = "
                SELECT * FROM (
                    SELECT count(c.total) as total,c.publish FROM(
                        SELECT
                            count(*) as total,STR_TO_DATE(created, '%Y-%m-%d') as publish
                        FROM
                            `log_activity`
                        GROUP BY id
                    ) as c GROUP BY c.publish ORDER BY c.publish DESC LIMIT 0,30
                ) as a ORDER BY a.publish ASC
            ";
        $i = $this->db->query($query);

        return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
    }

    function get_log_group_category()
    {
        $query = "
                SELECT
                    count(*) as total,category
                FROM
                    `log_activity`
                GROUP BY category
                ";
        $i = $this->db->query($query);

        return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
    }

    function get_logs($rows=false,$where=null,$limit=false,$skip=0,$take=10)
    {
        $this->db->select("
            log_activity.*,
            user_accounts.name as user_name
        ");
        $this->db->order_by('log_activity.created','desc');

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

        $this->db->join('user_accounts', 'log_activity.user_id = user_accounts.id','left');
        $i = $this->db->get('log_activity');

        if($rows){
            return $i->num_rows();
        }else{
            return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
        }
    }

    function get_report_perday($detail=FALSE,$start_date=NULL,$end_date=NULL,$category=FALSE)
    {
        $where_cat = ($category) ? " AND log_activity.category='".$category."'" : '';

        if($detail)
        {
            $query = "
                    SELECT
                        log_activity.*,
                        DATE(log_activity.created) as date,
                        user_accounts.name as user_name
                    FROM
                        `log_activity`
                            LEFT JOIN user_accounts on log_activity.user_id=user_accounts.id
                    WHERE
                        log_activity.created >= '". $start_date ."' AND log_activity.created <= '". $end_date ."' ".$where_cat."
                    ORDER BY log_activity.created DESC
                ";
        }
        else{
            $query = "
                    SELECT
                        count(*) as total,
                        DATE(created) as date
                    FROM
                        `log_activity`
                    WHERE
                        created >= '". $start_date ."' AND created <= '". $end_date ."' ".$where_cat."
                    GROUP BY DATE(created) ORDER BY log_activity.created DESC
                ";
        }
        $i = $this->db->query($query);

        return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
    }

    function get_report_peruser($detail=FALSE,$start_date=NULL,$end_date=NULL,$category=FALSE)
    {
        $where_cat = ($category) ? " AND log_activity.category='".$category."'" : '';

        if($detail)
        {
            $query = "
                    SELECT
                        log_activity.*,
                        user_accounts.name as user_name
                    FROM
                        `log_activity`
                            LEFT JOIN user_accounts on log_activity.user_id=user_accounts.id
                    WHERE
                        log_activity.created >= '". $start_date ."' AND log_activity.created <= '". $end_date ."' ".$where_cat."
                    ORDER BY user_accounts.name ASC,log_activity.created DESC
                ";
        }
        else{
            $query = "
                    SELECT
                        count(log_activity.id) as total,
                        user_accounts.name as user_name
                    FROM
                        `log_activity`
                            LEFT JOIN user_accounts on log_activity.user_id=user_accounts.id
                    WHERE
                        log_activity.created >= '". $start_date ."' AND log_activity.created <= '". $end_date ."' ".$where_cat."
                    GROUP BY DATE(log_activity.user_id) ORDER BY user_accounts.name ASC, log_activity.created DESC
                ";
        }
        $i = $this->db->query($query);

        return $var = ($i->num_rows() > 0) ? $i->result_array() : FALSE;
    }
}