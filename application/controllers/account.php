<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

    function Account()
    {
        parent::__construct();
        
        //Load model
        $this->load->model('user_mod');
        $this->load->model('bid_mod');
        $this->load->model('inbox_mod');
        
        //Cek user login
        $this->is_logged_in();
    }

    function logout()
    {
        $data_session = array(
                'email' => '',
                'user_id' => 0,
                'name' => '',
                'lastlogin' => '',
                'is_logged_in' => false,
                'tw_token' => '',
                'tw_secret' => ''
        );
        $this->session->unset_userdata($data_session);
        redirect('/');
    }
    
    function profile()
    {
        $user = $this->get_user();
        
        $data['user'] = $user;
        $this->load->view('profile',$data);
    }
    
    function bidding()
    {
        $user = $this->get_user();
        $rows = FALSE;
        $where = array('bidding.user_id' => $user->id);
        
        $rows_bidding = $this->bid_mod->get_rows(FALSE,$where);
        if($rows_bidding)
        {
            $rows = array();
            foreach ($rows_bidding as $r)
            {
                $rows[$r['item_id']]['id'] = $r['item_id'];
                $rows[$r['item_id']]['name'] = $r['item_name'];
                $rows[$r['item_id']]['data'][] = $r;
            }
        }
        //print_r($rows);exit;
        
        $data['user'] = $user;
        $data['rows'] = $rows;
        
        $this->load->view('bidding',$data);
    }
    
    public function inbox()
    {
        $user = $this->get_user();
        
        $where = array('user_id' => $user->id);
        
        $data['user'] = $user;
        $data['rows'] = $this->inbox_mod->get_rows(FALSE,$where,TRUE,0,50);
        $this->load->view('inbox',$data);
    }

    private function get_user()
    {
        $user = $this->user_mod->get_byuid(user_id());
        if(!$user){
            redirect('logout');
        }
        
        return $user;
    }
}