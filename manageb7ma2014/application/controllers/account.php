<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

    function Account()
    {
        parent::__construct();
        $this->load->model('admin_mod');
    }

    public function  index()
    {
        redirect('account/lists');
    }

    function lists($id = 0)
    {
        $this->_is_logged_in();
        $this->_is_developer();

        $this->load->library('pagination');

        $config['base_url'] = base_url().'account/lists/';
        $config['total_rows'] = $this->admin_mod->get_admins(true);
        $config['per_page'] = 10;
        $config['cur_page'] = empty($id) ? 0 : $id;
        foreach ($this->_set_pagination() as $key=>$val){
            $config[$key] = $val;
        }
        $this->pagination->initialize($config);

        $skip = $config['cur_page'];
        $take = $config['per_page'];

        $data['pagination'] = $this->pagination->create_links();
        $data['rows'] = $this->admin_mod->get_admins(false,true,$skip,$take);
        $data['page'] = 'admin';
        $this->load->view('account_lists',$data);
    }

    function add()
    {
        $this->_is_logged_in();
        $this->_is_developer();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error input-xlarge error">', '</div>');
        
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[4]');
        $this->form_validation->set_rules('full_name', 'full name', 'required');

        $data["status"] = "";
        if ($this->form_validation->run() == TRUE)
        {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $full_name = $this->input->post("full_name");
            $role = $this->input->post("role");
            $page_access = $this->input->post('page_access');

            $data_page = NULL;
            if($page_access){
                $data_page = implode(",", $page_access);
            }

            $is_user  = $this->admin_mod->get_byusername($username);

            //Jika email belum ada di database
            if(!$is_user)
            {
                $data_post = array (
                    'username' => $username,
                    'password' => $this->_encode_password($password),
                    'full_name' => $full_name,
                    'role' => $role,
                    'created' => date_now(true),
                    'last_loggedin_date' => date_now(true),
                    'is_lock' => 0,
                    'page_access' => $data_page
                );

                $user_id = $this->admin_mod->add($data_post);

                redirect('account/lists');
            }
            else
            {
                $data["status"] = "username";
            }
        }
        $data['page'] = 'admin';
        $data['page'] = $this->admin_mod->get_page();
        $this->load->view('account_add',$data);
    }

    function edit($id=0)
    {
        $this->_is_logged_in();
        $this->_is_developer();

        $row = $this->admin_mod->get_byuid($id);
        if(!$row){
            redirect('account/lists');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error input-xlarge error">', '</div>');
        
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('full_name', 'full name', 'required');

        $data["status"] = "";
        if ($this->form_validation->run() == TRUE)
        {
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $full_name = $this->input->post("full_name");
            $role = $this->input->post("role");
            $is_lock = $this->input->post("is_lock");
            $is_lock = ($is_lock == 'on') ? 1 : 0;

            $page_access = $this->input->post('page_access');

            $data_page = NULL;
            if($page_access){
                $data_page = implode(",", $page_access);
            }

            $is_user = false;
            if($row->username != $username){
                $is_user  = $this->admin_mod->get_byusername($username);
            }

            //Jika email belum ada di database
            if(!$is_user)
            {
                $data_post = array (
                    'username' => $username,
                    'full_name' => $full_name,
                    'role' => $role,
                    'is_lock' => $is_lock,
                    'page_access' => $data_page
                );

                if(!empty ($password)){
                    $data_post['password'] = $this->_encode_password($password);
                }

                $this->admin_mod->update($data_post, $row->id);

                redirect('account/lists');
            }
            else
            {
                $data["status"] = "username";
            }
        }
        $data['row'] = $row;
        $data['page'] = 'admin';
        $data['page'] = $this->admin_mod->get_page();
        
        $this->load->view('account_edit',$data);
    }

    function login()
    {
        $this->_is_login();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert error top-20 alert-error">', '</div>');
        
        $this->form_validation->set_rules(en_username(), 'username', 'trim|required');
        $this->form_validation->set_rules(en_password(), 'password', 'required');
        $data["msg"] = "";

        if ($this->form_validation->run() == TRUE)
        {
            $username = $this->input->post(en_username());
            $pass = $this->input->post(en_password());

            $user = $this->admin_mod->get_bylogin($username,$this->_encode_password($pass));
            if($user)
            {
                if($user->is_lock == 0)
                {
                    $data_session = array(
                            'en_username' => $user->username,
                            'en_user_id' => $user->id,
                            'en_full_name' => $user->full_name,
                            'en_lastlogin' => $user->last_loggedin_date,
                            'en_role' => $user->role,
                            'en_is_logged_in' => true
                    );
                    $this->set_session($data_session);

                    $url = $this->input->get("url");
                    if(!empty ($url)){
                        redirect($url);
                    }
                    else{
                        $this->_redirect_home();
                    }
                }
                $data["msg"] = "Akun anda saat ini sedang dalam masalah.";
            }else{
                $data["msg"] = "Username atau password anda salah";
            }

            $count_login = $this->session->userdata('blocked_sessions') + 1;
            if($count_login >= _xml('max_login'))
            {
                $this->load->model('blocked_mod');

                $seconds = 60*60* _xml('en_hours');
                $unlock_date = date('Y-m-d H:i:s', time() + $seconds);

                $post_data = array(
                    "username" => $username,
                    "password" => $pass
                );
                $add_data = array(
                    'ip_address' => $this->_ip_address,
                    'user_agent' => $this->_user_agent,
                    'post_data' => json_encode($post_data),
                    'agent' => $this->_agent,
                    'created' => date_now(true),
                    'platform' => $this->_platform,
                    'unlock_date' => $unlock_date,
                    'is_deleted' => 0
                );

                $is_id = $this->blocked_mod->add($add_data);
                if($is_id){
                    $en_session = array(
                        'blocked_sessions' => 0
                    );
                    $this->set_session($en_session);
                    redirect($this->_redirect_blocked());
                }
            }
            else{
                $en_session = array(
                    'blocked_sessions' => $count_login
                );
                $this->set_session($en_session);
            }
        }

        $this->load->view('account_login',$data);
    }

    function logout()
    {
        $this->_is_logged_in();

        $data_session = array(
                'en_username' => '',
                'en_user_id' => 0,
                'en_full_name' => '',
                'en_lastlogin' => '',
                'en_role' => '',
                'en_is_logged_in' => false
        );
        $this->session->unset_userdata($data_session); //Unset SESSION DATA
        redirect('/');
    }

    function profile()
    {
        $this->_is_logged_in();

        $data['row'] = $this->admin_mod->get_byuid(user_id());
        $data['page'] = 'profile';
        $this->load->view('account_profile',$data);
    }

    function change_password()
    {
        $this->_is_logged_in();

        $user = $this->admin_mod->get_byuid(user_id());

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error input-xlarge error">', '</div>');

        $this->form_validation->set_rules('current', 'Current password', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');

        $data["status"] = "";
        if ($this->form_validation->run() == TRUE)
        {
            $current = $this->input->post("current");
            $password = $this->input->post("password");
            $is_true = $user->password == $this->_encode_password($current) ? TRUE : FALSE;

            if($is_true)
            {
                $data_update = array(
                    'password' => $this->_encode_password($password)
                );

                $this->admin_mod->update($data_update,$user->id);
                $data['status'] = "success";
            }
            else{
                $data['status'] = "error";
            }
        }

        $data['page'] = 'profile';
        $this->load->view('account_change_password',$data);
    }
    
    private function _encode_password($string)
    {
        $string .= _xml('encryption_key');
	// Return the SHA-1 encryption
        return sha1($string);
    }
}