<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {

    function Report()
    {
        parent::__construct();

        $this->_is_logged_in();
        $this->load->model('log_mod');
    }

    function index()
    {
        $this->_is_page_access('report');

        $this->load->library('pagination');

        $where = null;
        $url = '';
        $category = $this->input->get('category');
        $id = $this->input->get('per_page');
        
        if(!empty ($category)){
            $where = array("category"=> $category);
            $url .= 'category='.$category;
        }

        $config['base_url'] = base_url().'report?'.$url;
        $config['total_rows'] = $this->log_mod->get_logs(true,$where);
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
        $data['rows'] = $this->log_mod->get_logs(false,$where,true,$skip,$take);
        $data['categories'] = $this->log_mod->get_category();
        $data['category'] = $category;
        $data['page'] = 'manage';

        $this->load->view('report',$data);
    }

    function print_data()
    {
        $this->_is_page_access('report_print');

        $start_date = $this->input->post("start_date");
        $end_date = $this->input->post("end_date");
        $category = $this->input->post("category");
        $is_detail = $this->input->post("is_detail");
        $is_detail = $is_detail=='on' ? TRUE : FALSE;

        if(!empty ($start_date) && !empty ($end_date))
        {
            $data_rows = FALSE;
            $rows = $this->log_mod->get_report_perday($is_detail,$start_date,$end_date,$category);
            if($is_detail)
            {
                if($rows)
                {
                    $data_rows = array();
                    foreach ($rows as $r)
                    {
                        $data_rows[$r['date']][] = $r;
                    }
                }
            }
            else{
                $data_rows = $rows;
            }

            $data['rows'] = $data_rows;
            $data['page'] = 'manage';
            $data['date'] = format_date($start_date,'F d, Y H:i').' s/d '.format_date($start_date,'F d, Y H:i');
            $data['category'] = $this->log_mod->data_category(FALSE,$category);
            $data['is_detail'] = $is_detail;
            $this->load->view('report_print',$data);
        }
        else{
           show_error('Form tidak boleh kosong!');
        }
    }
}