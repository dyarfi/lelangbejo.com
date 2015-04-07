<?php 
class Fb {

    public $graph_url = 'https://graph.facebook.com/';
    public $status = false;

    function __construct()
    {
            // Do nothing
    }

    function post_wall($params = array())
    {
        // If its an array (instead of a query string) then format it correctly
        if (is_array($params))
        {
                $params = http_build_query($params, NULL, '&');
        }
        try
        {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->graph_url . 'me/feed');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_exec($ch);

                $response = curl_getinfo($ch);
                curl_close($ch);
                if(is_array($response))
                {
                    if($response['http_code'] == '200')
                    {
                        $this->status = true;
                    }
                }
        }catch (Exception $e) {}

        return $this->status;
    }

    function friend($access_token=FALSE)
    {
        // If its an array (instead of a query string) then format it correctly
        if ($access_token)
        {
            $graph_url = $this->graph_url."me/friends?access_token=" . $access_token;
            $response = file_get_contents($graph_url);
            $response = json_decode($response);
            if(count($response->data))
            {
                $this->status = $response;
            }
        }

        return $this->status;
    }
}
?>