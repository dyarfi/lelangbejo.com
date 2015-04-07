<?php
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
if(!function_exists("xml"))
{
    function xml($id = '')
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
        $is_logged_in = $CI->session->userdata('is_logged_in');
        
        return $v = isset($is_logged_in) ? $is_logged_in : false;
    }
}

if(!function_exists("user_id"))
{
    function user_id()
    {
        $CI =& get_instance();
        $user_id = $CI->session->userdata('user_id');

        return $v = isset($user_id) ? $user_id : 0;
    }
}

if(!function_exists("user_name"))
{
    function user_name()
    {
        $CI =& get_instance();
        $f_name = $CI->session->userdata('name');

        return $v = isset($f_name) ? $f_name : '';
    }
}

if(!function_exists("last_login"))
{
    function last_login()
    {
        $CI =& get_instance();
        $val = $CI->session->userdata('lastlogin');

        return $v = isset($val) ? $val : '';
    }
}



/*
 * Format tanggal indonesia
 */
if(!function_exists("format_date_ID"))
{
    function format_date_ID($date = null,$time=false)
    {
        $curentdate = date('Y',time()) ."-". date('m',time())."-". date('d',time());
        $date = empty($date) ? $curentdate : $date;

        $date = new DateTime($date);

        $day = $date->format("j");
        $month = $date->format("n");
        $year = $date->format("Y");

        $days = date("w",mktime(0,0,0,$month,$day,$year));

        $out = DayID($days).', ';
        $out .= $day.' ';
        $out .= MonthID($month).' ';
        $out .= $year;
        if($time){
            $out .= ' / '.$date->format('g:i A');
        }

        return $out;
    }

    function DayID($day = 0)
    {
        $strDay = "";
        switch($day){
            case 0:$strDay = "Minggu";break;
            case 1:$strDay = "Senin";break;
            case 2:$strDay = "Selasa";break;
            case 3:$strDay = "Rabu";break;
            case 4:$strDay = "Kamis";break;
            case 5:$strDay = "Jumat";break;
            case 6:$strDay = "Sabtu";break;
        };

        return $strDay;
    }

    function MonthID($m = 0)
    {
        $strMonth = "";
        switch($m){
            case 1:$strMonth = "Januari";break;
            case 2:$strMonth = "Februari";break;
            case 3:$strMonth = "Maret";break;
            case 4:$strMonth = "April";break;
            case 5:$strMonth = "Mei";break;
            case 6:$strMonth = "Juni";break;
            case 7:$strMonth = "Juli";break;
            case 8:$strMonth = "Agustus";break;
            case 9:$strMonth = "September";break;
            case 10:$strMonth = "Oktober";break;
            case 11:$strMonth = "November";break;
            case 12:$strMonth = "Desember";break;
        };

        return $strMonth;
    }
}

/*
 * Penghitungan waktu berdasarkan UTC / GMT
 */
if(!function_exists("date_utc"))
{
    function date_utc($date)
    {
        $date = date("Y-m-d H:i:s", strtotime('+'.xml('utc_id').' hours', strtotime($date)));

        return $date;
    }
}


if(!function_exists("date_now_id"))
{
    function date_now_id($time=FALSE)
    {
        $now = date_now(TRUE);
        $date = strtotime('+'.xml('utc_id').' hours', strtotime($now));

        if($time){
            return date('Y-m-d H:i:s',$date);
        }else {
           return date('Y-m-d',$date);
        }
    }
}

/*
 * Avatar User
 */
if(!function_exists("avatar"))
{
    function avatar($avatar_file=NULL)
    {
        $pic_path = xml('dir_media').'no_avatar.jpg';
        if(!empty($avatar_file))
        {
            $path = xml('dir_media').$avatar_file;
            if(file_exists($path)){
                $pic_path = $path;
            }
        }
        
        return base_url().$pic_path;
    }
}

/*
 * Untuk membersihkan parameter get dan post
 */
if(!function_exists("clean"))
{
    function clean($string,$size=1000000){
        return xss_clean(substr($string,0,$size));
    }
}

if(!function_exists("difference"))
{
    function difference($datetime=FALSE,$f='d')
    {
        if($datetime)
        {
            $date_now_id = date_now_id(TRUE);
            $datetime1 = new DateTime($date_now_id);
            $datetime2 = new DateTime($datetime);

            $difference = $datetime1->diff($datetime2);

            /*
             * Format Data
            [y] => 0
            [m] => 0
            [d] => 17
            [h] => 11
            [i] => 55
            [s] => 1
            [weekday] => 0
            [weekday_behavior] => 0
            [first_last_day_of] => 0
            [invert] => 0
            [days] => 17
            [special_type] => 0
            [special_amount] => 0
            [have_weekday_relative] => 0
            [have_special_relative] => 0
             */

            return $difference->$f;
        }
    }
}