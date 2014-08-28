<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class My_upload extends CI_Controller
{
    public $full_path = '';
    public $errors = '';
    function __construct() {
        parent::__construct();
        //*** Setting and load Upload library
        $config['upload_path'] = FCPATH. 'assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
    }
    
    public function upload_photo() {
        if ( ! $this->upload->do_upload('image'))
        {
            $this->error = $this->upload->display_errors();
            return false;
        }
        
        $data = array('upload_data' => $this->upload->data());
        $r = $this->upload->data();
        $this->full_path = $r['full_path'];
        return true;
    }
}


