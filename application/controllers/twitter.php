<?php
/**
 * Twitter OAuth library.
 * Requirements: enabled Session library, enabled URL helper
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Twitter extends MY_Controller {
    /**
     * TwitterOauth class instance.
     */
    private $connection;

    /**
     * Controller constructor
     */
    function __construct()
    {
        parent::__construct();
        // Loading TwitterOauth library. Delete this line if you choose autoload method.
        $this->load->library('twitteroauth');
        
        // Loading twitter configuration.
        $this->config->load('twitter');

        // Loading User Model
        $this->load->model('user_mod');
        $this->load->model('log_mod');
        $this->load->model('point_mod');
        $this->load->model('item_mod');
	
		//Set item active
        $this->item_active = $this->item_mod->get_item_active();
		
        // User must Logged in
        $this->is_logged_in();

        if($this->session->userdata('tw_token') && $this->session->userdata('tw_secret'))
        {
            // If user already logged in
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('tw_token'),  $this->session->userdata('tw_secret'));
        }
        elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
        {
            // If user in process of authentication
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
        }
        else
        {
            // Unknown user
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
        }
    }

    /**
     * Here comes authentication process begin.
     * @access	public
     * @return	void
     */
    public function auth()
    {
        if($this->session->userdata('tw_token') && $this->session->userdata('tw_secret'))
        {
            // User is already authenticated.
            redirect('dompet');
        }
        else
        {
            // Making a request for request_token
            $request_token = $this->connection->getRequestToken(site_url('twitter/callback'));

            $this->session->set_userdata('request_token', $request_token['oauth_token']);
            $this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);

            if($this->connection->http_code == 200)
            {
                $url = $this->connection->getAuthorizeURL($request_token);
                redirect($url);
            }
            else
            {
                $this->reset_session();
                exit('An error occured. Make sure to put your error notification code here.');
            }
        }
    }

    /**
     * Callback function, landing page for twitter.
     * @access	public
     * @return	void
     */
    public function callback()
    {
        if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
        {
            $this->reset_session();
            redirect(site_url('twitter/auth'));
        }
        else
        {
            $access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));

            if ($this->connection->http_code == 200)
            {
                $user_info = $this->connection->get('account/verify_credentials');
                $user_id = user_id();
                // Let's find the user by its ID
                $result = $this->user_mod->get_user_twid($user_info->id,$user_id);

                // If not, let's add it to the database
                if(!$result){
                    // Update the tokens
                    $data_users = array(
                        'twitter_id' => $user_info->id,
                        'twitter_screenname' => $user_info->screen_name,
                        'twitter_tokenaccess' => $access_token['oauth_token'],
                        'twitter_tokensecret' => $access_token['oauth_token_secret']
                    );

                    $this->user_mod->update($data_users,$user_id);

                    $this->session->set_userdata('tw_token', $access_token['oauth_token']);
                    $this->session->set_userdata('tw_secret', $access_token['oauth_token_secret']);

                    $this->session->unset_userdata('request_token');
                    $this->session->unset_userdata('request_token_secret');

                    redirect('twitter/share');
                } 
                else
                {
                    $this->reset_session();
                    exit('Akun twitter kamu hanya bisa dipakai dalam satu akun di website ini.');
                }
            }
            else
            {
                $this->reset_session();
                exit('An error occured. Add your notification code here.');
            }
        }
    }

    public function share()
    {
        //Jika user tidak ditemukan pada database
        $user = $this->user_mod->get_byuid(user_id());
        if(!$user){
            redirect('logout');
        }

        $user_id = $user->id;
		
		$message = sprintf(xml('share_twitter'), strtoupper($this->item_active->name));//.$user->last_points;

        if($this->session->userdata('tw_token') && $this->session->userdata('tw_secret'))
        {
            $content = $this->connection->get('account/verify_credentials');
            if(isset($content->errors))
            {
                // Most probably, authentication problems. Begin authentication process again.
                $this->reset_session();
                redirect(site_url('twitter/auth'));
            }
            else
            {
                $type = $this->point_mod->twitter;
                $category = $this->log_mod->twitter;
                $total_day = $this->log_mod->get_total_share_byday($user_id,$category);
                //echo $total_day ."-". xml('max_per_day');exit;
                
                if($total_day < xml('max_per_day'))
                {
                    $data = array(
                            'status' => $message
                    );
                    $result = $this->connection->post('statuses/update', $data);

                    if(!isset($result->errors))
                    {
                        //Set log
                        $message = 'Post to Wall Twitter';
                        $date_now = date_now_id(TRUE);

                        //Set LOG Activiy
                        $data_log = array(
                            'user_id' => $user_id,
                            'category' => $this->log_mod->twitter,
                            'message' => $message,
                            'agent' => $this->_agent,
                            'platform' => $this->_platform,
                            'ip_address' => $this->_ip_address,
                            'user_agent' => $this->_user_agent,
                            'created' => $date_now
                        );
                        $this->log_mod->add($data_log);

                        /*
                         * Memasukan point dari share ke twitter
                         */
                        $error = $this->is_set_point_byshare($type);
                        if($error == 'OK')
                        {
                            //Set Point
                            $data_point = array(
                                'user_id' => $user_id,
                                'description' => xml('point_label_twitter'),
                                'point' => xml('point_twitter'),
                                'is_credit' => 1,
                                'type' => $type,
                                'created' => $date_now,
                                'message' => $message
                            );
                            $this->point_mod->add($data_point);

                            //Update last points
                            $last_points = $user->last_points + xml('point_twitter');
                            $this->user_mod->update_point($last_points,$user_id);
                            
                            redirect('dompet?success='.xml('point_twitter'));
                        }
                        else{
                            redirect('dompet?error='.$error);
                        }
                    }
                    redirect('dompet?error=Terdapat masalah pada koneksi ke twitter. Silahkan ulangi!');
                }
                else{
                    redirect('dompet?action=tw-max-per-day');
                }
            }
        }
        else
        {
            $this->reset_session();
            redirect(site_url('twitter/auth'));
        }
    }

    /**
     * Reset session data
     * @access	private
     * @return	void
     */
    private function reset_session()
    {
        $this->session->unset_userdata('tw_token');
        $this->session->unset_userdata('tw_secret');
        $this->session->unset_userdata('request_token');
        $this->session->unset_userdata('request_token_secret');
        $this->session->unset_userdata('twitter_user_id');
        $this->session->unset_userdata('twitter_screen_name');
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

        /*
        //Cek periode item (ada atau tidak)
        $item = $this->item_mod->get_item_active();
        if($item)
        {
            //Cek finish dan datetime
            if((!$item->is_finish) && ($date_now >= $item->start_date) && ($date_now <= $item->end_date))
            {
                //Cek jumlah share lebih kecil dari 10
                $total = $this->point_mod->get_total_share_byperiod($user_id,$type, $item->start_date, $item->end_date);
                if($total < xml('max_per_period'))
                {
                    //Cek hari ini belum perah share ke twitter
                    $total_day = $this->point_mod->get_total_share_byday($user_id,$type);
                    //echo $total_day ."-". xml('max_per_day');exit;
                    if($total_day < xml('max_per_day'))
                    {
                        $return = TRUE;
                    }
                }
            }
        }
        */
        return $return;
    }
}

/* End of file twitter.php */
/* Location: ./application/controllers/twitter.php */