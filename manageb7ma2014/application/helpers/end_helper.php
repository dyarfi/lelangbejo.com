<?php
/*
 * @untuk form login (variable post)
 */
if(!function_exists("en_username"))
{
    function en_username()
    {
        $CI =& get_instance();
        $CI->load->library('session');

        $ip = $CI->input->ip_address();
        $en_username = $CI->session->userdata('form_username');

        if(empty($en_username))
        {
            $en_username = md5($ip . time() . '_username');
            $newdata = array('form_username'  => $en_username);
            $CI->session->set_userdata($newdata);
        }

        return $en_username;
    }
}

if(!function_exists("en_password"))
{
    function en_password()
    {
        $CI =& get_instance();
        $CI->load->library('session');

        $ip = $CI->input->ip_address();
        $en_password = $CI->session->userdata('form_password');

        if(empty($en_password))
        {
            $en_password = md5($ip . time() . '_password');
            $newdata = array('form_password'  => $en_password);
            $CI->session->set_userdata($newdata);
        }

        return $en_password;
    }
}

/*
 * @Age
 */
if(!function_exists("age"))
{
    function age($birthDate)
    {
        //explode the date to get month, day and year
        $birthDate = explode("-", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));

        return $age;
    }
}


/*
 * @Url Youtube
 */
if(!function_exists("parse_url_youtube"))
{
    function parse_url_youtube($url,$key)
    {
        //$url = 'http://www.youtube.com/watch?v=Z29MkJdMKqs&feature=grec_index';

        // break the URL into its components
        $parts = parse_url($url);

        // $parts['query'] contains the query string: 'v=Z29MkJdMKqs&feature=grec_index'

        // parse variables into key=>value array
        $query = array();
        parse_str($parts['query'], $query);

        //echo $query['v']; // Z29MkJdMKqs
        //echo $query['feature'] ;// grec_index

        return $query[$key];
    }
}

/*
 * Date format
 */
if(!function_exists("date_now"))
{
    function date_now($time=false)
    {
        date_default_timezone_set('UTC');
        if($time){
            return date('Y-m-d H:i:s');
        }else {
           return date('Y-m-d');
        }
    }
}

if(!function_exists("date_now_id"))
{
    function date_now_id($time=FALSE)
    {
        $now = date_now(TRUE);
        $date = strtotime('+7 hours', strtotime($now));

        if($time){
            return date('Y-m-d H:i:s',$date);
        }else {
           return date('Y-m-d',$date);
        }
    }
}

if(!function_exists("format_date"))
{
    function format_date($date,$format = 'F d, Y')
    {
        $return = '';
        if(!empty($date)){
            $date = new DateTime($date);
            $return .=$date->format($format);
        }
        return $return;
    }
}

/*
 * Config Setting
 */
if(!function_exists("_xml"))
{
    function _xml($id = '')
    {
    	$CI =& get_instance();

        return $CI->config->item($id);
    }
}

/*
 * Membership login
 */
if(!function_exists("is_membership"))
{
    function is_membership()
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('en_is_logged_in');
        
        return $v = isset($is_logged_in) ? $is_logged_in : false;
    }
}

if(!function_exists("user_id"))
{
    function user_id()
    {
        $CI =& get_instance();
        $user_id = $CI->session->userdata('en_user_id');

        return $v = isset($user_id) ? $user_id : 0;
    }
}

if(!function_exists("username"))
{
    function username()
    {
        $CI =& get_instance();
        $username = $CI->session->userdata('en_username');

        return $v = isset($username) ? $username : "";
    }
}

if(!function_exists("lastlogin"))
{
    function lastlogin()
    {
        $CI =& get_instance();
        $lastlogin = $CI->session->userdata('en_lastlogin');

        return $v = isset($lastlogin) ? format_date($lastlogin,'F d, Y H:i:s') : "";
    }
}

if(!function_exists("full_name"))
{
    function full_name()
    {
        $CI =& get_instance();
        $full = $CI->session->userdata('en_full_name');

        return $v = isset($full) ? $full : "";
    }
}

if(!function_exists('user_role'))
{
    function user_role()
    {
        $CI =& get_instance();
        $role = $CI->session->userdata('en_role');
        
        return $v = isset($role) ? $role : 0;
    }
}


if(!function_exists('check_page_access'))
{
    function check_page_access($page_access=NULL,$page=FALSE)
    {
        $access = FALSE;
        if(!empty ($page_access) && $page)
        {
            $rows = explode(',', $page_access);
            foreach ($rows as $value)
            {
                if($value == $page){
                    $access = TRUE;
                }
            }
        }

        return $access;
    }
}

if(!function_exists("page_access"))
{
    function page_access()
    {
        $CI =& get_instance();
        $CI->load->model('admin_mod');

        $page_access = NULL;
        $row = $CI->admin_mod->get_byuid(user_id());
        if($row) {
            $page_access = $row->page_access;
        }

        return $page_access;
    }
}