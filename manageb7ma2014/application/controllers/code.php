<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code extends MY_Controller {

    function Code()
    {
        parent::__construct();

        $this->_is_logged_in();
        $this->load->model('code_mod');
        $this->load->model('bid_mod');
        $this->load->model('notification_mod');
        $this->load->model('point_mod');
        $this->load->model('user_mod');
    }

    function index()
    {
        $this->_is_page_access('code');

        $this->load->library('pagination');

        $where = null;
        $name = $this->input->get('code');
        $action = $this->input->get('action');
        $id = $this->input->get('per_page');
        $url = '';

        if(!empty ($name)){
            $where = array("codes.code like '%".mysql_real_escape_string($name)."%'"=> '');
            $url .= 'code='.$name;
        }
        
        if(!empty ($action)){
            $where = array("codes.approved"=> $action);
            $url = empty($url) ? '' : '&';
            $url .= 'action='.$action;
        }

        $config['base_url'] = base_url().'code?'.$url;
        $config['total_rows'] = $this->code_mod->get_codes(true,$where);
        $config['per_page'] = 10;
        $config['cur_page'] = empty($id) ? 0 : $id;
        $config['page_query_string'] = TRUE;
        foreach ($this->_set_pagination() as $key=>$val){
            $config[$key] = $val;
        }
        $this->pagination->initialize($config);

        $skip = $config['cur_page'];
        $take = $config['per_page'];

        $data['pagination'] = $this->pagination->create_links();
        $data['rows'] = $this->code_mod->get_codes(false,$where,true,$skip,$take);
        $data['page'] = 'manage';
        $data['action'] = $action;
        $this->load->view('code',$data);
    }
    
    
    function edit($id=0)
    {
        $row = $this->code_mod->get($id);
        if(!$row){
            redirect('code');
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
        $this->form_validation->set_rules('approved', 'approved', 'required');
        $this->form_validation->set_rules('point_code', 'koin', 'required|numeric');

        if ($this->form_validation->run() == TRUE)
        {
            $this->_is_page_access('code_edit');
            
            //print_r($row);echo 'Disini';exit;
            if($row->approved == 'Unapproved')
            {
                $date_now = date_now_id(true);
                $point_code = $this->input->post('point_code');

                //Update
                $update_data = array(
                    'approved' => 'Approved',
                    'approved_date' => $date_now,
                    'approved_by' => user_id(),
                    'koin' => $point_code
                );
                $this->code_mod->update($update_data,$row->id);

                //Send notification
                $subject = "Transaksi Kode";
                $send_date = date_now();//Tanggal notifikasi dikirimkan ke user
                $message_notification = "POIN kamu bertambah ".$point_code.". Cek total POIN kamu di DOMPET.";
                $message = 'Submit Transaction Code ('. $row->code .')';
                $user_id = $row->created_by;

                $data_notif = array(
                    'user_id' => $user_id,
                    'user_email' => $row->user_email,
                    'user_name' => $row->user_name,
                    'subject' => $subject,
                    'message' => $message_notification,
                    'created' => $date_now,
                    'send_date' => $send_date
                );
                $this->notification_mod->add($data_notif);

                //Set Point
                $data_point = array(
                    'user_id' => $user_id,
                    'description' => $subject,
                    'point' => $point_code,
                    'is_credit' => 1,
                    'type' => 'code',
                    'created' => $date_now,
                    'message' => $message
                );
                $this->point_mod->add($data_point);

                //Update last points
                $last_points = $row->last_points + $point_code;
                $this->user_mod->update_point($last_points,$user_id);
            }
            redirect('code?action=Unapproved');
        }
        
        $data['row'] = $row;
        $data['page'] = 'manage';
        $this->load->view('code_edit',$data);
    }
    
    function rejected($id=0)
    {
        $this->_is_page_access('code_edit');
        
        $row = $this->code_mod->get($id);
        if(!$row){
            redirect('code');
        }
        
        //Harus belum pernah diperiksa
        if($row->approved != 'Unapproved'){
            redirect('code?action=Unapproved');
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('rejected', 'rejected', 'required');
        $this->form_validation->set_rules('message', 'message', '');
        
        if ($this->form_validation->run() == TRUE)
        {
            $date_now = date_now_id(true);
            $message = $this->input->post('message');

            //Update data
            $update_data = array(
                'approved' => 'Rejected',
                'approved_date' => $date_now,
                'approved_by' => user_id(),
                'logs' => $message
            );
            $this->code_mod->update($update_data,$row->id);

            //Send notification
            $subject = "Transaksi Kode [Rejected]";
            $send_date = date_now();//Tanggal notifikasi dikirimkan ke user
            $message_notification = !empty($message) ? $message : "Kode Transaksi [". $row->code ."] kamu ditolak karena tidak sesuai dengan persyaratan.";
            $user_id = $row->created_by;

            $data_notif = array(
                'user_id' => $user_id,
                'user_email' => $row->user_email,
                'user_name' => $row->user_name,
                'subject' => $subject,
                'message' => $message_notification,
                'created' => $date_now,
                'send_date' => $send_date
            );
            $this->notification_mod->add($data_notif);

            redirect('code?action=Unapproved');
        }
        
        $data['row'] = $row;
        $data['page'] = 'manage';
        $this->load->view('code_rejected',$data);
    }
}