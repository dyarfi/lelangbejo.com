<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends MY_Controller {

    var $facebook_callback_url;
    var $facebook_app_id;
    var $facebook_app_secret;
    var $facebook_page_id;
    
    /**
     * Controller constructor
     */
    function __construct()
    {
        parent::__construct();
        // Loading facebook configuration.
        $this->config->load('facebook');
        
        // Loading User Model
        $this->load->model('user_mod');
        $this->load->model('log_mod');
        $this->load->model('point_mod');
        $this->load->model('item_mod');
        
        $this->facebook_callback_url = base_url();
        $this->facebook_app_id = $this->config->item('facebook_app_id');
        $this->facebook_app_secret = $this->config->item('facebook_app_secret');
        $this->facebook_page_id = $this->config->item('facebook_page_id');
    }
	
    /**
     * Here comes authentication process begin.
     * @access	public
     * @return	void
     */
    public function auth()
    {
        $app_id = $this->facebook_app_id;
        $app_secret = $this->facebook_app_secret;
        $url = $this->input->get('url');
        $my_url = $this->facebook_callback_url . 'facebook/auth';
        
        if(!empty($url)){
            $my_url .= '?url='.$url;
        }

        if(empty($_REQUEST["code"]))
        {
            $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url) . "&scope=email,user_birthday,user_location,publish_stream";
            echo("<script>top.location.href='" . $dialog_url . "'</script>");
            exit;
        } 
        else
        {
            $context = stream_context_create(array(
                'http' => array(
                   'ignore_errors'=>true,
                   'method'=>'GET'
                 )
              ));
            $token_url = "https://graph.facebook.com/oauth/access_token?" . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url) . "&client_secret=" . $app_secret . "&code=" . $_REQUEST["code"];

            // convert response
            //$params = $this->get_curl($token_url);

            $response = file_get_contents($token_url,FALSE,$context);
            $params = null;
            parse_str($response, $params);
            $graph_url = "https://graph.facebook.com/me?access_token=" . $params['access_token'];
            $user = json_decode(file_get_contents($graph_url,FALSE,$context));
            

            if(isset($user->email))
            {
                $fb_id = $user->id;
                $fb_email = $user->email;
                $fb_token = $params['access_token'];
                $cekuserfb = $this->user_mod->check_user_fb($fb_id);

                if($cekuserfb)
                {
                    //user FB exist on database
                    if(!$cekuserfb->is_lock)
                    {
                        //Set SESSION DATA
                        $data_session = array(
                                'email' => $cekuserfb->email,
                                'user_id' => $cekuserfb->id,
                                'name' => $cekuserfb->name,
                                'lastlogin' => $cekuserfb->last_loggedin_date,
                                'fb_token' => $fb_token,
                                'is_logged_in' => TRUE,
                                'tw_token' => $cekuserfb->twitter_tokenaccess,
                                'tw_secret' => $cekuserfb->twitter_tokensecret
                        );
                        $this->set_session($data_session);

                        //Update Facebook ID & Token
                        $data_update = array(
                            'facebook_token' => $fb_token
                        );
                        $this->user_mod->update($data_update,$cekuserfb->id);

                        //Set LOG Activiy
                        $data_log = array(
                            'user_id' => $cekuserfb->id,
                            'category' => $this->log_mod->login,
                            'message' => 'Login dengan facebook connect',
                            'agent' => $this->_agent,
                            'platform' => $this->_platform,
                            'ip_address' => $this->_ip_address,
                            'user_agent' => $this->_user_agent,
                            'created' => date_now_id(TRUE)
                        );
                        $this->log_mod->add($data_log);

                        $this->redirect_member($url);
                    }
                    else
                    {
                        redirect('blocked');
                    }
                } 
                else
                {
                    //user FB doesn't exist
                    $fb_fname = $user->first_name;
                    $fb_lname = $user->last_name;
                    $fb_bday = $user->birthday;
                    $fb_gender = $user->gender;
                    $full_name = $fb_fname.' '.$fb_lname;

                    $birth = explode('/', $fb_bday);
                    $dateofbirth = $birth[2].'-'.$birth[0].'-'.$birth[1];
                    $gender = ($fb_gender == 'male') ? 'm' : 'f';
                    $date_now = date_now_id(TRUE);
                    $file_name = NULL;

                    //Get Photo Profile
                    $pic_url = "https://graph.facebook.com/me/picture?type=normal&access_token=". $fb_token;
                    $fb_pic = file_get_contents($pic_url);
                    if($fb_pic)
                    {
                        $file_name = $fb_id.'.jpg';
                        file_put_contents(xml('dir_media').$file_name, $fb_pic);
                    }

                    //Encode password
                    $encpasswd = $this->encode_password($fb_id);
                    
                    //New Registration
                    $data_add = array(
                            'name' => $full_name,
                            'email' => $fb_email,
                            'password' => $encpasswd,
                            'birthday' => $dateofbirth,
                            'gender' => $gender,
                            'facebook_id' => $fb_id,
                            'facebook_token' => $fb_token,
                            'avatar_file' => $file_name,
                            'last_loggedin_date' => $date_now,
                            'created' => $date_now
                    );

                    $is_id = $this->user_mod->add($data_add);
                    if($is_id)
                    {
                        $message = 'Register menggunakan facebook connect';

                        //Set SESSION DATA
                        $data_session = array(
                                'email' => $fb_email,
                                'user_id' => $is_id,
                                'name' => $full_name,
                                'lastlogin' => $date_now,
                                'is_logged_in' => TRUE,
                                'tw_token' => NULL,
                                'tw_secret' => NULL
                        );
                        $this->set_session($data_session);

                        //Set LOG Activiy
                        $data_log = array(
                            'user_id' => $is_id,
                            'category' => $this->log_mod->register,
                            'message' => $message,
                            'agent' => $this->_agent,
                            'platform' => $this->_platform,
                            'ip_address' => $this->_ip_address,
                            'user_agent' => $this->_user_agent,
                            'created' => $date_now
                        );
                        $this->log_mod->add($data_log);

                        //Set Point
                        $data_point = array(
                            'user_id' => $is_id,
                            'description' => xml('point_label_register'),
                            'point' => xml('point_register'),
                            'is_credit' => 1,
                            'type' => $this->point_mod->register,
                            'created' => $date_now,
                            'message' => $message
                        );
                        $this->point_mod->add($data_point);

                        //Update last points
                        $this->user_mod->update_point(xml('point_register'),$is_id);

                        $this->redirect_member($url);
                    }
                    else
                    {
                        echo '<h3>Maaf terjadi kesalahan pada server kami, silahkan lakukan pendaftaran ulang. <a href="'.$my_url.'">Facebook Connect</a></h3>';
                        exit;
                    }
                }
            } 
            else
            {
                redirect('/');
            }
        }
    }

    public function share()
    {
        $this->is_logged_in();

        //Jika user tidak ditemukan pada database
        $user = $this->user_mod->get_byuid(user_id());
        if(!$user){
            redirect('logout');
        }

        $fb_id = $user->facebook_id;
        $fb_token = $user->facebook_token;
        $user_id = $user->id;

        if(!empty ($fb_id) and !empty ($fb_token))
        {
            $category = $this->log_mod->facebook;
            $total_day = $this->log_mod->get_total_share_byday($user_id,$category);
            //echo $total_day ."-". xml('max_per_day');exit;

            if($total_day < xml('max_per_day'))
            {
                $message = xml('share_facebook');//.$user->last_points;
                $date_now = date_now_id(TRUE);
                $picture_url = base_url().xml('dir_media')."banner_fb.png";

                $param = array(
                    'access_token' => $fb_token,
                    'message' => $message,
                    'picture' => $picture_url
                );

                $post = $this->facebook_post($param);

                if($post)
                {
                    $message = 'Post to Wall Facebook';

                    //Set LOG Activiy
                    $data_log = array(
                        'user_id' => $user_id,
                        'category' => $this->log_mod->facebook,
                        'message' => $message,
                        'agent' => $this->_agent,
                        'platform' => $this->_platform,
                        'ip_address' => $this->_ip_address,
                        'user_agent' => $this->_user_agent,
                        'created' => $date_now
                    );
                    $this->log_mod->add($data_log);

                    /*
                     * Memasukan point dari share ke facebook
                     */
                    $type = $this->point_mod->facebook;
                    $error = $this->is_set_point_byshare($type);
                    if($error == 'OK')
                    {
                        $point_facebook = xml('point_facebook');
                        //Set Point
                        $data_point = array(
                            'user_id' => $user_id,
                            'description' => xml('point_label_facebook'),
                            'point' => $point_facebook,
                            'is_credit' => 1,
                            'type' => $type,
                            'created' => $date_now,
                            'message' => $message
                        );
                        $this->point_mod->add($data_point);

                        //Update last points
                        $last_points = $user->last_points + $point_facebook;
                        $this->user_mod->update_point($last_points,$user_id);
                        
                        redirect('dompet?success='.$point_facebook);
                    }
                    else{
                        redirect('dompet?error='.$error);
                    }
                }

                redirect('dompet?error=Terdapat masalah pada koneksi ke facebook. Silahkan ulangi!');
            }
            else{
                redirect('dompet?action=fb-max-per-day');
            }
        }
        else{
            redirect('facebook/connect/share');
        }
    }

    public function connect($page='share')
    {
        $this->is_logged_in();

        //Jika user tidak ditemukan pada database
        $user = $this->user_mod->get_byuid(user_id());
        if(!$user){
            redirect('logout');
        }
        
        $app_id = $this->facebook_app_id;
        $app_secret = $this->facebook_app_secret;
        $my_url = $this->facebook_callback_url . 'facebook/connect/'.$page;

        if(empty($_REQUEST["code"]))
        {
            $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url) . "&scope=email,user_birthday,user_location,publish_stream";
            echo("<script>top.location.href='" . $dialog_url . "'</script>");
            exit;
        } 
        else
        {
            $token_url = "https://graph.facebook.com/oauth/access_token?" . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url) . "&client_secret=" . $app_secret . "&code=" . $_REQUEST["code"];
            $response = file_get_contents($token_url);
            $params = null;
            parse_str($response, $params);
            $graph_url = "https://graph.facebook.com/me?access_token=" . $params['access_token'];
            $user_fb = json_decode(file_get_contents($graph_url));
            $fb_id = $user_fb->id;
            $fb_token = $params['access_token'];

            //Update Facebook ID & Token
            $data_update = array(
                'facebook_token' => $fb_token,
                'facebook_id' => $fb_id
            );
            $this->user_mod->update($data_update,$user->id);

            redirect('facebook/'.$page);
        }
    }

    public function friend()
    {
        //Cek user login
        $this->is_logged_in();

        //Jika user tidak ditemukan pada database
        $user = $this->user_mod->get_byuid(user_id());
        if(!$user){
            redirect('logout');
        }

        $fb_id = $user->facebook_id;
        $fb_token = $user->facebook_token;
        $user_id = $user->id;

        if(!empty ($fb_id) and !empty ($fb_token))
        {
            $friends = $this->user_mod->get_friends($user_id);
            if(!$friends)
            {
                //Store ke Database
                $this->store_friends($user_id,$fb_token);

                //Get dari database
                $friends = $this->user_mod->get_friends($user_id);
            }

            $data['user'] = $user;
            $data['rows'] = $friends;
            $data['err'] = $this->input->get('err');
            $data['success'] = $this->input->get('success');

            $this->load->view('friend',$data);
        }
        else{
            redirect('facebook/connect/friend');
        }
    }

    public function invite()
    {
        //Facebook Friend
        $friend_fb_id = $this->input->get('facebook_id');
        //Harus ada teman yang diundang
        if(empty($friend_fb_id)){
            redirect('facebook/friend?err=Silahkan pilih temanmu!');
        }
        
        $friend_fb_ids = implode(",", $friend_fb_id);
        //Harus ada teman yang diundang
        if(empty($friend_fb_ids)){
            redirect('facebook/friend?err=Silahkan pilih temanmu!');
        }
        
        //100003534268438 - 269
        $this->is_logged_in();

        //Jika user tidak ditemukan pada database
        $user = $this->user_mod->get_byuid(user_id());
        if(!$user){
            redirect('logout');
        }

        $url_err = '';
        $fb_id = $user->facebook_id;
        $fb_token = $user->facebook_token;
        $user_id = $user->id;
        $page_id = $this->facebook_page_id;

        //Jika user tidak ditemukan pada database
        $rows = $this->user_mod->get_friends($user_id,$friend_fb_id);
        //Kamu hanya bisa mengajak maksimal 10 orang teman setiap harinya
        
        //print_r($rows);exit;
        if($rows)
        {
            //Undang teman hanya berlaku 1x dalam 1 hari dan maksimal 10 teman
            $row_day = $this->user_mod->check_invite_byday($user_id);
            if(!$row_day && count($rows) < 10)
            {
                $point_invitation = 0;
                $facebook_ids = array();
                foreach ($rows as $r){
                    $facebook_ids[] = $r['facebook_id'];
                    $point_invitation++;
                }
                $tags_facebook_ids = implode(",", $facebook_ids);
                
                //echo $tags_facebook_ids . " - ".$point_invitation;exit;
                
                $message = xml('share_facebook_invite');
                $date_now = date_now_id(TRUE);
                $picture_url = base_url().xml('dir_media')."banner_fb.png";

                $param = array(
                    'access_token' => $fb_token,
                    'message' => $message,
                    'tags' => $tags_facebook_ids,
                    'place' => $page_id,
                    'picture' => $picture_url
                );

                $post = $this->facebook_post($param);
                if($post)
                {
                    //Update status
                    foreach ($rows as $r){
                        $update_friend = array('invited'=>1,'invited_date'=>$date_now);
                        $this->user_mod->update_friend($update_friend,$r['id']);
                    }

                    $message = "Post to FB Friends’ wall, Facebook ID [".$tags_facebook_ids."]";

                    //Set LOG Activiy
                    $data_log = array(
                        'user_id' => $user_id,
                        'category' => $this->log_mod->invitation,
                        'message' => $message,
                        'agent' => $this->_agent,
                        'platform' => $this->_platform,
                        'ip_address' => $this->_ip_address,
                        'user_agent' => $this->_user_agent,
                        'created' => $date_now
                    );
                    $this->log_mod->add($data_log);

                    /*
                     * Memasukan point dari undangan wall ke facebook (tags)
                     */
                    $type = $this->point_mod->invitation;
                    $error = $this->is_set_point_byshare($type);
                    if($error == "OK")
                    {
                        //Set Point
                        $data_point = array(
                            'user_id' => $user_id,
                            'description' => xml('point_label_invitation'),
                            'point' => $point_invitation,
                            'is_credit' => 1,
                            'type' => $type,
                            'created' => $date_now,
                            'message' => $message
                        );
                        $this->point_mod->add($data_point);

                        //Update last points
                        $last_points = $user->last_points + $point_invitation;
                        $this->user_mod->update_point($last_points,$user_id);
                        
                        $url_err = ("?success=".$point_invitation);
                    }
                    else{
                        $url_err = ("?err=".$error);
                    }
                }
                else{
                    $url_err = ("?err=Terdapat masalah pada koneksi ke facebook. Silahkan ulangi!");
                }
            }
            else{
                $url_err = ("?err=Kamu hanya bisa mengajak maksimal 10 orang teman setiap harinya!");
            }
        }
        else{
            $url_err = ("?err=Teman yang anda cari tidak ditemukan!");
        }

        redirect('facebook/friend'.$url_err);
    }

    private function store_friends($user_id=0,$fb_token=FALSE)
    {
        $this->load->library('fb');

        if($fb_token)
        {
            //Store friend ke database
            $return = $this->fb->friend($fb_token);
            if($return)
            {
                foreach ($return->data as $r)
                {
                    $data_add = array(
                        'user_id' => $user_id,
                        'facebook_id' => $r->id,
                        'facebook_name' => $r->name
                    );
                    $this->user_mod->add_friend($data_add);
                }
            }
        }
    }

    private function is_set_point_byshare($type=NULL)
    {
        $date_now = date_now_id(TRUE);
        $user_id = user_id();
        $return = FALSE;
        $max_per_period = xml('max_per_period');
        $max_per_day = xml('max_per_day');
        
        if($max_per_period > 0)
        {
            //Cek jumlah share lebih kecil dari 10
            $total = $this->point_mod->get_total_share_byperiod($user_id,$type);
            if($total < $max_per_period)
            {
                //Cek hari ini belum perah share ke facebook
                $total_day = $this->point_mod->get_total_share_byday($user_id,$type);
                if($total_day < $max_per_day)
                {
                    $return = "OK";
                }
                else{
                    $return = "Kamu hanya bisa mengumpulkan maksimal ". $max_per_day ." koin per harinya!";
                }
            }
            else{
                $return = "Kamu hanya bisa mengumpulkan maksimal ". $max_per_period ." koin!";
            }
        }
        else{
            //Cek hari ini belum perah share ke facebook
            $total_day = $this->point_mod->get_total_share_byday($user_id,$type);
            if($total_day < $max_per_day)
            {
                $return = "OK";
            }
            else{
                $return = "Kamu hanya bisa mengumpulkan maksimal ". $max_per_day ." koin per harinya!";
            }
        }

        return $return;
    }
    
    private function get_curl($token_url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $token_url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $response = curl_exec($ch);   

        // convert response
        $params = json_decode($response);

        curl_close($ch);
        
        return $params;
    }
}