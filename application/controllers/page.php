<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {

    function Page()
    {
        parent::__construct();
    }
    
    function lelang()
    {
        $this->load->view('page_lelang');
    }
    
    function koin()
    {
        $this->load->view('page_koin');
    }
    
    function syarat()
    {
        $this->load->view('page_syarat');
    }
    
    function kebijakan()
    {
        $this->load->view('page_kebijakan');
    }
    
    function lokasi_penjualan()
    {
        $this->load->view('page_lokasi');
    }
    
    function cara_lelang()
    {
        $this->load->view('page_cara_lelang');
    }
}