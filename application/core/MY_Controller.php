<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  MY_Controller  extends  CI_Controller {

    var $_agent;
    var $_platform;
    var $_ip_address;
    var $_user_agent;

    function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
		
	$this->_set_agent();
    }

    function _set_agent()
    {
        if ($this->agent->is_browser())
        {
            $this->_agent = $this->agent->browser().' '.$this->agent->version();
        }
        elseif ($this->agent->is_robot())
        {
            $this->_agent = $this->agent->robot();
        }
        elseif ($this->agent->is_mobile())
        {
            $this->_agent = $this->agent->mobile();
        }
        else
        {
            $this->_agent = 'Unidentified';
        }

        $this->_platform = $this->agent->platform();
        $this->_ip_address =  $this->input->ip_address();
        $this->_user_agent =  $this->agent->agent_string();
    }

    function set_session($data)
    {
        $this->session->set_userdata($data);
    }

    function is_logged_in()
    {
        if(!is_membership())
        {
            $string = uri_string();
			
            $url_callback = NULL;
            if(strlen($string) > 0){
                $str_first = substr($string,0,1);
                if($str_first == "/"){
                    $url_callback = substr($string, 1);
                }else{
                    $url_callback = $string;
                }
            }
			
            //$url_callback = (strlen($string) > 0 ) ? substr($string, 1) : NULL;
            if(isset($_SERVER['QUERY_STRING'])){
               $url_callback .= !empty($_SERVER['QUERY_STRING']) ? '&' .$_SERVER['QUERY_STRING'] : ''; 
            }
            $url_callback = empty($url_callback) ? 'home' : $url_callback;
            
            //echo $url_callback; exit;
            
            redirect('facebook/auth?url='.$url_callback);
            die();
        }
    }

    function is_login()
    {
        if(is_membership())
        {
            $this->redirect_member();
        }
    }

    function redirect_member($url=FALSE)
    {
        if($url)
            redirect($url);
        else
            redirect('/');
    }

    function encode_password($string)
    {
        $string .= xml('encryption_key');
	// Return the SHA-1 encryption
        return sha1($string);
    }

    function facebook_post($param)
    {
        $this->load->library('fb');

        return $this->fb->post_wall($param);
    }
}