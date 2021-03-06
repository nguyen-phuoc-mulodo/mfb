<?php
/*
 * Rewrite base controller for using Facebook SDK in Codeigniter
 * @Author: EchPay - GeekBoy Team
 * @Date: Jul 31,2014
 * @Version: 1.0
 */

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

class GB_Controller extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        session_start();
        
        //*** Initializing facebook app
        FacebookSession::setDefaultApplication($this->config->item('appid'), $this->config->item('appsecret'));
        
        //*** Check login
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }        
    }

    /*
     * Write log when there is an error
     */
    public function log()
    {
        
    }

}