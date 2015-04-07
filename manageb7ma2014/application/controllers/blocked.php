<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocked extends CI_Controller {

    function Blocked()
    {
        parent::__construct();
    }

    function index()
    {
        show_error('Anda bisa login kembali '._xml('en_hours').' jam kemudian.!');
    }
}