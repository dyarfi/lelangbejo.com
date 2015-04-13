<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    var $item_active;
    var $is_item_active;
    
    function Home()
    {
        parent::__construct();
        
        //Load model
        $this->load->model('item_mod');
        $this->load->model('user_mod');
        $this->load->model('point_mod');
        $this->load->model('code_mod');
        $this->load->model('log_mod');
        $this->load->model('bid_mod');
        $this->load->model('notification_mod');
        
        //Set item active
        $this->item_active = $this->item_mod->get_item_active();
        $this->is_item_active = $this->is_item_active();
		//print_r(user_id());
    }

    function index()
    {
        //Jika user tidak menggunakan ssl
        $this->force_ssl();
        
        $data['item'] = $this->item_active;
        $data['is_item_active'] = $this->is_item_active;
        
        $this->load->view('home',$data);
    }
/*    
    function page()
    {
        //Jika user tidak menggunakan ssl
        $this->force_ssl('home/page');
        
        $data['item'] = $this->item_active;
        $data['is_item_active'] = $this->is_item_active;
        
        $this->load->view('home',$data);
    }
*/  
    public function step1()
    {
        //Cek item masih aktif atau tidak
        $this->check_item();
        
        //Cek user login
        $this->is_logged_in();
        
        //Jika user tidak ditemukan pada database
        $user = $this->get_user();
        
        //Next Step 3 (Karena user sebelumnya sudah mengisi data lengkapnya)
        if(!empty($user->name) && !empty($user->email) && !empty($user->phone) && !empty($user->address)){
            redirect('step3');
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'No. Tlp', 'required|numeric|min_length[10]');
        $this->form_validation->set_rules('address', 'Alamat', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE)
        {
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');

            $is_active = FALSE;
            //Cek apakah email sudah dipakai apa belum
            if($email != $user->email){
                $is_active = $this->user_mod->get_byemail($email);
            }
            
            //Jika email valid
            if(!$is_active)
            {
                $data_update = array(
                    'email' => $email,
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address
                );
                
                $status = TRUE;
                $is_upload = FALSE;
                if(!empty($_FILES["file_upload"]["tmp_name"]))
                {
                    $file = $this->upload_avatar($user->facebook_id);
                    if($file['status']){
                        $data_update['avatar_file'] = $file['file_name'];
                        $is_upload = TRUE;
                    }
                    else{
                        $data['error'] = $file['msg'];
                    }
                    $status = $file['status'];
                }

                //Jika upload avatar berhasil
                if($status)
                {
                    $this->user_mod->update($data_update,$user->id);
                    if($is_upload){
                        if(!empty ($user->avatar_file)){
                            $path = xml('dir_media').$user->avatar_file;
                            if(file_exists($path))
                                unlink($path);
                        }
                    }
                    redirect('step2');
                }
            }
            else{
                $data['error'] = "Silahkan gunakan email yang lain!";
            }
        }
        
        $data['item'] = $this->item_active;
        $data['user'] = $user;
        
        $this->load->view('step1',$data);
    }
    
    public function step2()
    {
        //Cek item masih aktif atau tidak
        $this->check_item();
        
        //Cek user login
        $this->is_logged_in();
        
        //Jika user tidak ditemukan pada database
        $user = $this->get_user();
        
        $data['item'] = $this->item_active;
        $data['next'] = ($user->last_points >= xml('point_bidding')) ? TRUE : FALSE;
        
        $this->load->view('step2',$data);
    }
    
    public function step3()
    {
        //Cek item masih aktif atau tidak
        $this->check_item();
        
        //Cek user login
        $this->is_logged_in();
        
        //Jika user tidak ditemukan pada database
        $user = $this->get_user();
        
        //Next Step 4 (Jika koin sudah cukup atau lebih besar dari 20)
        //if(($user->last_points >= xml('point_bidding'))){
            //redirect('step4');
        //}
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        
        $this->form_validation->set_rules('code', 'Kode', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE)
        {
            $code = $this->input->post('code');
            $code = str_replace("-", "", $code);
            
            if(!empty($_FILES["file_upload"]["tmp_name"]))
            {
                $row = $this->code_mod->get($code);
                if(!$row)
                {
                    $file = $this->upload_code($user->id);
                    if($file['status'])
                    {
                        //Store ke database
                        if($this->set_transaction_code($code,$user->id,$file['file_name'])){
                            //Jika sudah berhasil arahkan ke dompet
                            redirect('step3?upload=1');
                        }
                        else{
                            $path = xml('dir_media').$file['file_name'];
                            if(file_exists($path))
                                unlink($path);
                            
                            $data['error'] = "Maaf ada masalah dengan server kami, silahkan masukkan ulang code!";
                        }
                    }
                    else{
                        $data['error'] = $file['msg'];
                    }
                }
                else{
                    $data['error'] = "Kode sudah pernah kamu masukan sebelumnya";
                }
            }
            else{
                $data['error'] = "Silahkan upload foto bon pembelian [format: jpg, png, gif]";
            }
        }
        
        $point = $this->input->get('point');
        if($point == 'no'){
            $data['error'] = '
                <img class="img-responsive" src="'.base_url().'assets/img/koin-maaf.png" alt="koin tidak cukup">
            ';
        }
        
        $data['user'] = $user;
        $data['item'] = $this->item_active;
        $data['upload'] = $this->input->get('upload');
        
        $this->load->view('step3',$data);
    }
    
    public function step4()
    {
		//Default from from 
		//print_r($_GET['price']);
		//$_POST['price'] = $_POST['price'] ? $_POST['price'] : $_GET['price'];
		
		if ($this->input->get('price')) {
			$_POST['price'] = $this->input->post('price') ? $this->input->post('price') :  $this->input->get('price');
		} 
		
		//Cek item masih aktif atau tidak
        $this->check_item();
        
        //Cek user login
        $this->is_logged_in();
        
        //Jika user tidak ditemukan pada database
        $user = $this->get_user();
        
        //Cek last points harus lebih besar dari point untuk bidding
        if($user->last_points < xml('point_bidding')){
            redirect('step3?point=no');
        }
		
        //print_r($this->input->get_post('price'));
		//exit;
		
        //Item
        $item = $this->item_active;
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        
        $this->form_validation->set_rules('price', 'Rp', 'required|numeric|xss_clean');

        if ($this->form_validation->run() == TRUE)
        {
            $price = $this->input->post('price');

            //Cek Minimum and Maximum
            if($price >= $item->price_start AND $price <= $item->price_end)
            {
                //Set log
                $message = 'Submit Bidding ('. $price .')';
                $date_now = date_now_id(TRUE);
                $user_id = $user->id;
                $item_id = $item->id;
                $type = $this->point_mod->bidding;
                $point_bidding = xml('point_bidding');
                $subject = "LELANG";
                $item_name = $item->name;

                //Set Bidding
                $data_bid = array(
                    'user_id' => $user_id,
                    'item_id' => $item_id,
                    'price' => $price,
                    'created' => $date_now
                );
                $bidding_id = $this->bid_mod->add($data_bid);
                //Cek store bidding
                if($bidding_id)
                {
                    //Set notification [menggunakan cron job] untuk harga yang tidak unik. Pada H+1 setelah bid
                    if($this->is_not_unique($price))
                    {
                        $now = date_now(TRUE);//Date UTC
                        $date = strtotime('+1 days', strtotime($now));//H+1
                        $send_date = date('Y-m-d',$date);//Tanggal notifikasi dikirimkan ke user
                        $message_notification = "Harga (Rp ". number_format($price, 0, '', '.') .") Konco Bejo pada ".$item_name." tidak unik, silahkan masukan harga yang lain.";
                        
                        $data_notif = array(
                            'user_id' => $user_id,
                            'user_email' => $user->email,
                            'user_name' => $user->name,
                            'subject' => $subject,
                            'message' => $message_notification,
                            'created' => $date_now,
                            'send_date' => $send_date
                        );
                        $this->notification_mod->add($data_notif);
                    }
                    
                    //Set Point
                    $data_point = array(
                        'user_id' => $user_id,
                        'description' => xml('point_label_bidding'),
                        'point' => $point_bidding,
                        'is_credit' => '0',
                        'type' => $type,
                        'created' => $date_now,
                        'message' => $message
                    );
                    $point_id = $this->point_mod->add($data_point);

                    //Store ke database
                    if($point_id)
                    {
                        //Set LOG Activiy
                        $data_log = array(
                            'user_id' => $user_id,
                            'category' => $this->log_mod->bidding,
                            'message' => $message,
                            'agent' => $this->_agent,
                            'platform' => $this->_platform,
                            'ip_address' => $this->_ip_address,
                            'user_agent' => $this->_user_agent,
                            'created' => $date_now
                        );
                        $this->log_mod->add($data_log);

                        //Update last points
                        $last_points = $user->last_points - $point_bidding;
                        $this->user_mod->update_point($last_points,$user_id);
                    }
                    $data['success'] = TRUE;
                }
                else{
                    $data['error'] = "Maaf ada masalah dengan server kami, silahkan masukkan ulang nominal!";
                }

                //Cek apakah nominal sudah pernah digunakan pada item ini dan jika ada maka user dikirimkan notifikasi
                if($bidding_id)
                {
                    $users = $this->bid_mod->get_user_group($item->id,$price,$bidding_id);
                    if($users)
                    {
                        $date_now = date_now_id(TRUE);
                        $send_date = date_now();//Date UTC
                        $message = "Harga (Rp ". number_format($price, 0, '', '.') .") Konco Bejo pada ".$item_name." tidak lagi unik, karena ada user lain yang memasukan harga yang sama.";
                        
                        foreach ($users as $r)
                        {
                            $user_id = $r['user_id'];
                            $user_email = $r['user_email'];
                            $user_name = $r['user_name'];
                            
                            //Set Notification [menggunakan cron job]
                            $data_notif = array(
                                'user_id' => $user_id,
                                'user_email' => $user_email,
                                'user_name' => $user_name,
                                'subject' => $subject,
                                'message' => $message,
                                'created' => $date_now,
                                'send_date' => $send_date
                            );
                            $this->notification_mod->add($data_notif);
                        }
                    }
                }
            }
            else{
                $data['error'] = "Minimum bid Rp ".number_format($item->price_start,0,'','.')." – Maximum Bid Rp ".number_format($item->price_end,0,'','.');
            }
        }
        
        $data['user'] = $user;
        $data['item'] = $item;
        
        $this->load->view('step4',$data);
    }
    
    public function dompet()
    {
        $action = $this->input->get('action');
        $error = $this->input->get('error');
        $success = $this->input->get('success');
        
        //Cek user login
        $this->is_logged_in();
        
        //Jika user tidak ditemukan pada database
        $user = $this->get_user();
        
        $where = array(
            'user_id' => $user->id
        );
        $sort = array(
            'filed' => 'created',
            'sort' => 'desc'
        );
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        
        $this->form_validation->set_rules('code', 'Kode', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE)
        {
            $code = $this->input->post('code');
            $code = str_replace("-", "", $code);
            //print_r($_FILES);exit;
            if(!empty($_FILES["file_upload"]["tmp_name"]))
            {
                $row = $this->code_mod->get($code);
                if(!$row)
                {
                    $file = $this->upload_code($user->id);
                    if($file['status'])
                    {
                        //Store ke database
                        if($this->set_transaction_code($code,$user->id,$file['file_name'])){
                            //Jika sudah berhasil arahkan ke dompet
                            redirect('dompet?upload=1');
                        }
                        else{
                            $path = xml('dir_media').$file['file_name'];
                            if(file_exists($path))
                                unlink($path);
                            
                            $data['error'] = "Maaf ada masalah dengan server kami, silahkan masukkan ulang code!";
                        }
                    }
                    else{
                        $data['error'] = $file['msg'];
                    }
                }
                else{
                    $data['error'] = "Kode sudah pernah kamu masukan sebelumnya";
                }
            }
            else{
                $data['error'] = "Silahkan upload foto bon pembelian [format: jpg, png, gif]";
            }
        }
        
        //Ketika ada error message
        if(!empty($error)){
            $data['error'] = $error;
        }
        if($action == 'tw-max-per-day'){
            $data['error'] = "Kamu hanya bisa melakukan SHARE pada Twitter maksimal 1 kali setiap harinya";
        }
        if($action == 'fb-max-per-day'){
            $data['error'] = "*Kamu hanya bisa melakukan SHARE Facebook maksimal 1 kali setiap harinya";
        }
        //Jika share success dan dapat koin
        if(!empty ($success) && $success > 0){
            $data['success'] = $success;
        }
        
        $data['user'] = $user;
        $data['rows'] = $this->point_mod->get_rows(FALSE,$where,TRUE,0,50,$sort);
        $data['upload'] = $this->input->get('upload');
        
        $this->load->view('dompet',$data);
    }
    
    public function items()
    {
        $data['rows'] = $this->item_mod->get_rows();
        $this->load->view('items',$data);
    }
    
    public function detail_item($item_id=0)
    {
        $row = $this->item_mod->get($item_id);
        if(!$row){
            redirect('notfound');
        }
        
        $data['item'] = $row;
        $data['rows'] = $this->bid_mod->get_users($row->id);

        $this->load->view('item_detail',$data);
    }
    
	// Page not blocked	
    function blocked()
    {
        echo '<h2>Maaf, user anda saat ini dalam masalah.</h2>';
        exit;
    }

	// Page not found
    function notfound()
    {
        echo '<h2>Maaf, halaman yang anda cari tidak ditemukan.</h2>';
        exit;
    }
	
	// Page gagal
	function gagal() {
		$data = array();
        $this->load->view('page_gagal',$data);
    }
	
	// Page berhasil
	function berhasil() {
		$data = array();
		$this->load->view('page_berhasil',$data);
	}
	
	function bidding () {
	
	
		//Cek item masih aktif atau tidak
        //$this->check_item();
        
        //Jika user tidak ditemukan pada database
        //$user = $this->get_user();
		
		// Set defaults 
		$result = array();
		
		// Default data setup
	    $fields	= array(
			    //'session'		=> '',
			    'price'		=> '');

	    $errors	= $fields;
		
		// Load validation
		$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="error"><i class="glyphicon glyphicon-alert"></i>&nbsp;&nbsp;', '</p>');
		
		// Set validation config
		$config = array(
				array('field' => 'price', 
					  'label' => 'Nilai Bejomu', 
					  'rules' => 'trim|required|xss_clean|numeric|callback_is_not_unique_cb[price]|max_length[25]'),	
				//array('field' => 'session', 
					 // 'label' => 'Session', 
					  // 'rules' => 'trim|required|xss_clean|max_length[32]')
		 );

		// Set rules to form validation
		$this->form_validation->set_rules($config);

		// Run validation for checking
		if ($this->form_validation->run() === FALSE) {

				 // Set error fields
			    $errors = array();
			    foreach(array_keys($fields) as $error) {
				    $errors[$error] = form_error($error);
			    }

			    // Set previous post merge to default
			    $fields = array_merge($fields, $this->input->post());	

		} else {
		
				/*
				$posts = array(
				    // Primary Accounts
				    'id' => $id,
				    'group_id' => $this->input->post('group_id'),
				    'username' => $this->input->post('username'),
				    'email' => $this->input->post('email'),
				    'backend_access' => $this->input->post('backend_access'),
				    'full_backend_access' => $this->input->post('full_backend_access'),
				    'status' => $this->input->post('status'),
				    // Profile Accounts
				    'gender'	=> $this->input->post('gender'),				
				    'first_name'	=> $this->input->post('first_name'),
				    'last_name'	=> $this->input->post('last_name'),				
				    'birthday'	=> $this->input->post('birthday'),
				    'phone'		=> $this->input->post('phone'),	
				    'mobile_phone'	=> $this->input->post('mobile_phone'),				
				    'fax'		=> $this->input->post('fax'),
				    'website'	=> $this->input->post('website'),
				    'about'		=> $this->input->post('about'),
				    'division'	=> $this->input->post('division')
			    );
				*/

			    // Set data to add to database
			    // $this->Users->updateUser($posts);

			    // Set message
			    //$this->session->set_flashdata('message','User updated');

			    // Redirect after add
			    //redirect(ADMIN. $this->controller . '/index');
				
				//$data['code']		= '1';
				//$data['message'] 	= 'Success';
				//$data['text']		= $this->get_user();
				
				// $this->input->post('bidding')
				//echo json_encode($data,1);
					
				$this->session->set_userdata('bidding', $this->input->post('price'));
				
				$data['code'] = user_id() ? 1 : 'must_login';
				
		
		}
		
		$data['fields'] = $fields;
		
		$data['errors'] = $errors;
		
		echo json_encode($data,1);
		
		//redirect('home');
	}
    
    private function is_item_active()
    {
        $date_now = date_now_id(TRUE);
        $return = FALSE;

        //Cek periode item (ada atau tidak)
        $item = $this->item_active;
        if($item){
            //Cek datetime apa kah sudah aktif apa belum
            if(($date_now >= $item->start_date) && ($date_now <= $item->end_date)){
                $return = TRUE;
            }
        }

        return $return;
    }
    
    private function check_item()
    {
        //Cek periode item (ada atau tidak)
        $item = $this->item_active;
        if(!$item){
            //redirect('/');
        }
        
        //Cek datetime apa kah sudah aktif apa belum
        if(!$this->is_item_active()){
            //redirect('/');
        }
        
        //Cek item sudah laku apa belum
        if($item->is_finish){
            //redirect('/');
        }
    }

    private function get_user()
    {
        $user = $this->user_mod->get_byuid(user_id());
		
        if(!$user){
            redirect('logout');
        }
        
        return $user;
    }
    
    private function upload_avatar($facebook_id=FALSE)
    {
        $config['file_name']	= ($facebook_id) ? $facebook_id : time();
        $config['upload_path'] = xml('dir_media');
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size']	= '2000';
        //$config['max_width'] = 400;
        //$config['max_height'] = 400;
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_upload')) 
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
    
    /*
     * $code : Kode Transaksi (string)
     * $user : User pengguna (array class)
     * $row : Data Kode yang diambil dari database berdasarkan $code (array class)
     */
    private function set_transaction_code($code,$user_id,$file_name)
    {
        //Set log
        $message = 'Submit Transaction Code ('. $code .')';
        $date_now = date_now_id(TRUE);
        
        //Set CODE
        $data_code = array(
            'code' => $code,
            'file_upload' => $file_name,
            'created' => $date_now,
            'created_by' => $user_id,
            'approved' => 'Unapproved'
        );
        $code_id = $this->code_mod->add($data_code);

        //Store ke database
        if($code_id)
        {
            //Set LOG Activiy
            $data_log = array(
                'user_id' => $user_id,
                'category' => $this->log_mod->code,
                'message' => $message,
                'agent' => $this->_agent,
                'platform' => $this->_platform,
                'ip_address' => $this->_ip_address,
                'user_agent' => $this->_user_agent,
                'created' => $date_now
            );
            $this->log_mod->add($data_log);
            
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    // -------------- CALLBACK METHODS -------------- //

    // Match Unique for price
    public function is_not_unique_cb($price) {		
		
		$return = true;
        $length = strlen($price);
        
        //Rp 10.000
        if($length == 5)
        {
            $price1 = substr($price, 1);//0000
            $price2 = substr($price, 2);//000
            if(($price1 == '0000') OR ($price2 == '000')){
				$this->form_validation->set_message('is_not_unique_cb', 'Tidak unik jooo harganya');
                $return = false;
            }
        }
        
        //Rp 100.000
        if($length == 6)
        {
            $price1 = substr($price, 1);//00000
            $price2 = substr($price, 2);//0000
            $price3 = substr($price, 3);//000
            if(($price1 == '00000') OR ($price2 == '0000') OR ($price3 == '000')){
				$this->form_validation->set_message('is_not_unique_cb', 'Tidak unik jooo harganya');
                $return = false;
            }
        }
        
        //Rp 1.000.000
        if($length >= 7)
        {
            $price1 = substr($price, 1);//000000
            $price2 = substr($price, 2);//00000
            $price3 = substr($price, 3);//0000
            $price4 = substr($price, 4);//000
            if(($price1 == '000000') OR ($price2 == '00000') OR ($price3 == '0000') OR ($price4 == '000')){
				$this->form_validation->set_message('is_not_unique_cb', 'Tidak unik jooo harganya');
                $return = false;
            }
        }
        
        return $return;

    }
	
    private function is_not_unique($price=0)
    {
	
        $return = FALSE;
        $length = strlen($price);
        
        //Rp 10.000
        if($length == 5)
        {
            $price1 = substr($price, 1);//0000
            $price2 = substr($price, 2);//000
            if(($price1 == '0000') OR ($price2 == '000')){
                $return = TRUE;
            }
        }
        
        //Rp 100.000
        if($length == 6)
        {
            $price1 = substr($price, 1);//00000
            $price2 = substr($price, 2);//0000
            $price3 = substr($price, 3);//000
            if(($price1 == '00000') OR ($price2 == '0000') OR ($price3 == '000')){
                $return = TRUE;
            }
        }
        
        //Rp 1.000.000
        if($length == 7)
        {
            $price1 = substr($price, 1);//000000
            $price2 = substr($price, 2);//00000
            $price3 = substr($price, 3);//0000
            $price4 = substr($price, 4);//000
            if(($price1 == '000000') OR ($price2 == '00000') OR ($price3 == '0000') OR ($price4 == '000')){
                $return = TRUE;
            }
        }
        
        return $return;
    }
    
    private function upload_code($user_id=0)
    {
        $config['file_name']	= 'CODE-'.$user_id.'-'.time();
        $config['upload_path'] = xml('dir_media');
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['max_size']	= '2000';
        //$config['max_width'] = 400;
        //$config['max_height'] = 400;
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_upload')) 
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
    
    private function force_ssl($page=FALSE)
    {
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
            if($page){
                redirect(base_url($page));
            }else {
                redirect(base_url());
            }
        }
    }
}