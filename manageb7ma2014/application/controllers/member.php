<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

    function Member()
    {
        parent::__construct();

        $this->_is_logged_in();
        $this->load->model('user_mod');
        $this->load->model('log_mod');
    }

    function index()
    {
        $this->_is_page_access('member');

        $this->load->library('pagination');

        $where = null;
        $sort_data = FALSE;
        $url = '';
        $field = $this->input->get('field');
        $sort = $this->input->get('sort');
        $name = $this->input->get('name');
        $id = $this->input->get('per_page');
        
        if(!empty ($name))
        {
            $where = array("user_accounts.name like '%".mysql_real_escape_string($name)."%'"=> NULL);
            $url .= 'name='.$name;
        }

        if(!empty ($field) and !empty ($sort))
        {
            $sort = $sort=='asc' ? 'ASC' : 'DESC';
            $sort_data = array('user_accounts.'.$field,$sort);

            $url .= empty ($url) ? '' : '&';
            $url .= 'name='.$name;
        }

        $config['base_url'] = base_url().'report?'.$url;
        $config['total_rows'] = $this->user_mod->get_members(true,$where);
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
        $data['rows'] = $this->user_mod->get_members(false,$where,true,$skip,$take,$sort_data);
        $data['categories'] = $this->log_mod->get_category();
        $data['page'] = 'manage';
        $data['field'] = $field.'-'.$sort;

        $this->load->view('member',$data);
    }

    function print_data()
    {
        $this->_is_page_access('member_print');

        $start_date = $this->input->post("start_date");
        $end_date = $this->input->post("end_date");
        $category = $this->input->post("category");
        $is_detail = $this->input->post("is_detail");
        $is_detail = $is_detail=='on' ? TRUE : FALSE;

        if(!empty ($start_date) && !empty ($end_date))
        {
            $data_rows = FALSE;
            $rows = $this->log_mod->get_report_peruser($is_detail,$start_date,$end_date,$category);
            if($is_detail)
            {
                if($rows)
                {
                    $data_rows = array();
                    foreach ($rows as $r)
                    {
                        $data_rows[$r['user_id']]['name'] = $r['user_name'];
                        $data_rows[$r['user_id']]['data'][] = $r;
                    }
                }
            }
            else{
                $data_rows = $rows;
            }

            //print_r($data_rows);exit;

            $data['rows'] = $data_rows;
            $data['page'] = 'manage';
            $data['date'] = format_date($start_date,'F d, Y H:i').' s/d '.format_date($start_date,'F d, Y H:i');
            $data['category'] = $this->log_mod->data_category(FALSE,$category);
            $data['is_detail'] = $is_detail;
            $this->load->view('member_print',$data);
        }
        else{
           show_error('Form tidak boleh kosong!');
        }
    }
}