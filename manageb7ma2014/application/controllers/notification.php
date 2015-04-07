<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MY_Controller {

    function Notification()
    {
        parent::__construct();

        //Check login
        $this->_is_logged_in();
        //Check page access
        $this->_is_page_access('notification');
        //Include model
        $this->load->model('user_mod');
        $this->load->model('notification_mod');
    }

    function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('message', 'message', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            $message = $this->input->post("message");
            $subject = $this->input->post("subject");
            $user = $this->input->post("user");
            $where = array();
            
            if($user == 'last_point_max'){
                $where["last_points>20"] = NULL;
            }
            if($user == 'last_point_min'){
                $where["last_points<20"] = NULL;
            }
            if($user == 'lock'){
                $where["is_lock"] = 1;
            }

            $users = $this->user_mod->get_members(FALSE,$where);
            /*
            print_r($where);
            print_r($users);
            exit;
            */
            
            $total = 0;
            if($users)
            {
                //Tanggal notifikasi harus dikirim ke user dan dimasukan ke inbox
                $date_now = date_now();

                //Tanggal now indonesia
                $date_now_id = date_now(TRUE);
                $date_now_id = strtotime('+7 hours', strtotime($date_now_id));
                $date_now_id = date('Y-m-d H:i:s',$date_now_id);

                foreach ($users as $r)
                {
                    $data = array(
                        'user_id' => $r['id'],
                        'user_email' => $r['email'],
                        'user_name' => $r['name'],
                        'subject' => $subject,
                        'message' => $message,
                        'send_date' => $date_now,
                        'created' => $date_now_id
                    );

                    $is_id = $this->notification_mod->add($data);
                    if($is_id){
                        $total++;
                    }
                }
            }
            redirect('notification?success=yes&users='.$total);
        }
        $data['page'] = 'manage';
        $data['success'] = $this->input->get('success');
        $data['users'] = $this->input->get('users');
        $this->load->view('notification',$data);
    }
}