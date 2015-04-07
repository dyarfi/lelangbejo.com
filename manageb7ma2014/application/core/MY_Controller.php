<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  MY_Controller  extends  CI_Controller {

    var $_agent;
    var $_platform;
    var $_ip_address;
    var $_user_agent;
    var $_page_access;

    function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
		
	$this->_set_agent();
        $this->_is_blocked();
        $this->_page_access = page_access();
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
            $this->_agent = 'Unidentified User Agent';
        }

        $this->_platform = $this->agent->platform();
        $this->_ip_address =  $this->input->ip_address();
        $this->_user_agent =  $this->agent->agent_string();
    }

    function set_session($data)
    {
        $this->session->set_userdata($data);
    }

    function v_role()
    {
        $role = $this->session->userdata('en_role');
        return $v = isset($role) ? $role : 0;
    }

    function v_is_logged_in()
    {
        $is_logged_in = $this->session->userdata('en_is_logged_in');
        return $v = isset($is_logged_in) ? $is_logged_in : false;
    }

    function v_username()
    {
        $username = $this->session->userdata('en_username');
        return $v = isset($username) ? $username : NULL;
    }

    function v_user_id()
    {
        $user_id = $this->session->userdata('en_user_id');
        return $v = isset($user_id) ? $user_id : 0;
    }

    function v_full_name()
    {
        $val = $this->session->userdata('en_full_name');
        return $v = isset($val) ? $val : '';
    }

    function _is_logged_in()
    {
        if(!$this->v_is_logged_in())
        {
            redirect('login?url='.uri_string());
            die();
        }
    }

    function _is_login()
    {
        if($this->v_is_logged_in())
        {
            $this->_redirect_home();
        }
    }

    function _is_blocked()
    {
        if(!$this->v_is_logged_in())
        {
            $this->load->model('blocked_mod');
            $row = $this->blocked_mod->get_byip($this->_ip_address);
            if($row){
                if($row->unlock_date >= date_now(true)){
                    $this->_redirect_blocked();
                }
            }
        }
    }

    function _redirect_home()
    {
        redirect('/');
    }

    function _redirect_blocked()
    {
        redirect('blocked');
    }

    function _is_developer()
    {
        if($this->v_role() != _xml('role_dev')){
            $this->_redirect_home();
        }
    }

    function _is_page_access($page=FALSE)
    {
        if($page){
            if(!check_page_access($this->_page_access,$page)){
                redirect('home/page_not_access');
            }
        }
    }

    function _outputjson($data)
    {
        $data = json_encode($data);
        $length = strlen($data);
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Length: ' . $length);
        header('Access-Control-Allow-Origin: *');
        echo $data;
        exit();
    }

    function _outputjsonpost($data)
    {
        $data = json_encode($data);
        $length = strlen($data);
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Length: ' . $length);
        echo $data;
        exit();
    }

    function _outputcurl($data)
    {
        $length = strlen($data);
        header('Content-Type: application/json');
        header('Content-Length: ' . $length);
        echo $data;
        exit();
    }

    function _set_pagination()
    {
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a class="active">';
        $config['cur_tag_close'] = '</a></li>';

        return $config;
    }

    function img_upload($name,$file='file_upload')
    {
        $config['file_name']        = $name;
        $config['upload_path']      = _xml('dir_item');
        $config['allowed_types']    = 'jpg|png|gif|jpeg';
        $config['max_size']         = '5000';

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload($file))
        {
            $err = str_replace('<p>','',$this->upload->display_errors());
            $err = str_replace('</p>','',$err);

            return array('status' => false ,'msg' => $err);
        }
        else
        {
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            $file_type = $data['file_type'];
            $file_size = $data['file_size'];

            $array = array(
                'status'	=> true,
                'msg'		=> '',
                'file_name'	=> $file_name,
                'file_type'	=> $file_type,
                'file_size'	=> $file_size
            );
            return $array;
        }
    }
}