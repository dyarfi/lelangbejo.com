<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends MY_Controller {

    function Item()
    {
        parent::__construct();

        $this->_is_logged_in();
        $this->load->model('item_mod');
        $this->load->model('bid_mod');
    }

    function index()
    {
        $this->_is_page_access('item');

        $this->load->library('pagination');

        $where = null;
        $name = $this->input->get('name');
        $id = $this->input->get('per_page');
        $url = '';

        if(!empty ($name)){
            $where = array("items.name like '%".$name."%'"=> '');
            $url .= 'name='.$name;
        }

        $config['base_url'] = base_url().'item?'.$url;
        $config['total_rows'] = $this->item_mod->get_items(true,$where);
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
        $data['rows'] = $this->item_mod->get_items(false,$where,true,$skip,$take);
        $data['page'] = 'manage';
        $this->load->view('item',$data);
    }

    function add()
    {
        $this->_is_page_access('item_add');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error input-xxlarge error">', '</div>');
        
        $this->form_validation->set_rules('name', 'Item name', 'required');
        $this->form_validation->set_rules('start_date', 'Start date', 'required');
        $this->form_validation->set_rules('end_date', 'End date', 'required');
        $this->form_validation->set_rules('price_start', 'Min price', 'required|numeric');
        $this->form_validation->set_rules('price_end', 'Max price', 'required|numeric');
        $this->form_validation->set_rules('headline', 'Headline', 'required');
        $this->form_validation->set_rules('body', 'Body text', 'required');
        $this->form_validation->set_rules('detail', 'Detail item', 'required');
        $this->form_validation->set_rules('delivery', 'Delivery info', 'required');		        $this->form_validation->set_rules('share_text', 'Share text', 'required');
        if ($this->form_validation->run() == TRUE)
        {
            $name = $this->input->post("name");
            $start_date = $this->input->post("start_date");
            $end_date = $this->input->post("end_date");
            $price_start = $this->input->post("price_start");
            $price_end = $this->input->post("price_end");
            $headline = $this->input->post("headline");
            $body = $this->input->post("body");
            $detail = $this->input->post("detail");
            $delivery = $this->input->post("delivery");						$share_text = $this->input->post("share_text");
            $add_data = array(
                'name' => $name,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'price_start' => $price_start,
                'price_end' => $price_end,
                'headline' => $headline,
                'body' => $body,
                'detail' => $detail,
                'delivery' => $delivery,				                'share_text' => $share_text,
                'created_by' => user_id(),
                'created' => date_now(true)
            );

            $is_id = $this->item_mod->add($add_data);
            if($is_id)
            {
                $file_name = str_pad($is_id,5,"0",STR_PAD_LEFT);
                $file = $this->img_upload($file_name);
                if($file['status'])
                {
                    $update_data = array(
                        'file_name' => $file['file_name']
                    );

                    $this->item_mod->update($update_data,$is_id);
                }
                
                $file_name2 = $file_name.'-2';
                $file2 = $this->img_upload($file_name2,'file_upload2');
                if($file2['status'])
                {
                    $update_data = array(
                        'file_name2' => $file2['file_name']
                    );

                    $this->item_mod->update($update_data,$is_id);
                }
                
                redirect('item');
            }
            $data['err'] = 'Terjadi kesalahan pada server, silahkan ulangi pengisian datanya!';
        }
        $data['page'] = 'manage';
        $this->load->view('item_add',$data);
    }

    function edit($id=0)
    {
        $this->_is_page_access('item_edit');

        $row = $this->item_mod->get($id);
        if(!$row){
            redirect('item');
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error input-xxlarge error">', '</div>');

        $this->form_validation->set_rules('name', 'Item name', 'required');
        $this->form_validation->set_rules('start_date', 'Start date', 'required');
        $this->form_validation->set_rules('end_date', 'End date', 'required');
        $this->form_validation->set_rules('price_start', 'Min price', 'required|numeric');
        $this->form_validation->set_rules('price_end', 'Max price', 'required|numeric');
        $this->form_validation->set_rules('headline', 'Headline', 'required');
        $this->form_validation->set_rules('body', 'Body text', 'required');
        $this->form_validation->set_rules('detail', 'Detail item', 'required');
        $this->form_validation->set_rules('delivery', 'Delivery info', 'required');				$this->form_validation->set_rules('share_text', 'Share text', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            if(!$row->is_finish){
                $name = $this->input->post("name");
                $start_date = $this->input->post("start_date");
                $end_date = $this->input->post("end_date");
                $price_start = $this->input->post("price_start");
                $price_end = $this->input->post("price_end");
                $headline = $this->input->post("headline");
                $body = $this->input->post("body");
                $detail = $this->input->post("detail");
                $delivery = $this->input->post("delivery");
				$share_text = $this->input->post("share_text");
                $update_data = array(
                    'name' => $name,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'price_start' => $price_start,
                    'price_end' => $price_end,
                    'headline' => $headline,
                    'body' => $body,
                    'detail' => $detail,
                    'delivery' => $delivery,										'share_text' => $share_text,
                    'modified_by' => user_id(),
                    'modified' => date_now(true)
                );

                $status = true;
                if(!empty($_FILES["file_upload"]["tmp_name"]))
                {
                    $file_name = str_pad($row->id,5,"0",STR_PAD_LEFT);
                    $file = $this->img_upload($file_name);
                    if($file['status'])
                    {
                        $update_data['file_name'] = $file['file_name'];
                    }else{
                        $status = false;
                        $data['err'] = $file['msg'];
                    }
                }
                
                if(!empty($_FILES["file_upload2"]["tmp_name"]))
                {
                    $file_name = str_pad($row->id,5,"0",STR_PAD_LEFT).'-2';
                    $file = $this->img_upload($file_name,'file_upload2');
                    if($file['status']){
                        $update_data['file_name2'] = $file['file_name'];
                    }
                }
                
                if($status){
                    $this->item_mod->update($update_data,$row->id);
                    redirect('item');
                }
            }
        }
        
        if($row->is_finish){
            $data['err'] = "Item sudah terjual dan sudah tidak dapat di update!";
        }
        
        $data['row'] = $row;
        $data['page'] = 'manage';
        $this->load->view('item_edit',$data);
    }

    function setting()
    {
        $this->_is_page_access('item_edit');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error input-xxlarge error">', '</div>');

        $this->form_validation->set_rules('item', 'Item', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            $item_id = $this->input->post("item");

            $update_data = array(
                'is_active' => 1,
                'modified_by' => user_id(),
                'modified' => date_now(true)
            );

            $this->item_mod->update_active();
            $this->item_mod->update($update_data,$item_id);
            redirect('item');
        }
        $data['rows'] = $this->item_mod->get_items();
        $data['page'] = 'manage';
        $this->load->view('item_setting',$data);
    }
    
    function set($id=0)
    {
        $this->_is_page_access('item_set');

        $row = $this->item_mod->get($id);
        if(!$row){
            redirect('item');
        }

        if($row->is_finish){
            redirect('item/view/'.$row->id);
        }

        if($this->input->post('bidding_id'))
        {
            $bidding_id = $this->input->post("bidding_id");
            $row_bid = $this->bid_mod->get($bidding_id);
            if($row_bid)
            {
                $data_update = array(
                    'bidding_id' => $bidding_id,
                    'user_id' => $row_bid->user_id,
                    'is_finish' => 1,
                    'modified' => date_now(TRUE),
                    'modified_by' => user_id()
                );
                $this->item_mod->update($data_update,$row->id);
                
                redirect('item/view/'.$row->id);
            }
        }
        $where = array('bidding.item_id' => $row->id);

        $data['row'] = $row;
        $data['rows'] = $this->bid_mod->get_rows(FALSE,$where);
        $data['page'] = 'manage';
        $this->load->view('item_set',$data);
    }
    
    function delete($id=0)
    {
        $this->_is_page_access('item_delete');

        $row = $this->item_mod->get($id);
        if(!$row){
            redirect('item');
        }
        
        $this->item_mod->delete($row->id);
        
        redirect('item');
    }
    
    function view($id=0)
    {
        $this->_is_page_access('item');

        $row = $this->item_mod->get($id);
        if(!$row){
            redirect('item');
        }

        if(!$row->is_finish){
            redirect('item/set/'.$row->id);
        }

        $where = array('bidding.item_id' => $row->id);

        $data['row'] = $row;
        $data['rows'] = $this->bid_mod->get_rows(FALSE,$where);
        $data['page'] = 'manage';
        $this->load->view('item_view',$data);
    }
}