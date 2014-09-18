<?php
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUserPage;

class Fanpage extends GB_Controller
{
    private $page_id = '';
    private $page_session = null;
    private $page_token = '';
    
    function __construct() {
        parent::__construct();
        
        //***Load models
        $this->load->model('fanpage_model');
        //***Load Libraries
        $this->load->library('my_upload');

        FacebookSession::setDefaultApplication($this->config->item('appid'), $this->config->item('appsecret'));
        //$page_session = new FacebookSession('CAAJ4LGdPR8MBAHDVTTZBs7pEmPSukvJnecEnv2My8N5ajccWwAGCBE437IsqSXoFTEpXNYgafHKc38TSBRZCJZALTOIo2CQ3YQ4gdgWR2AgtPrt84tpfdBYVi6ZCO07mEZCkCNTQbEGI2Mx34EhzEhKoBHWlW1aG0IwUKKCzebZCP3abSV15JZB');
        //$this->page_session = $page_session->getLongLivedSession();
    }
    public function index() {
        try 
        {
            //*** Get Page list of user
            $data['page_list'] = array();
            $data['user_pages'] = array();
            $data['page_list'] = $this->fanpage_model->get_page_list($this->session->userdata('user_id')); //List of fanpage added to DB of a user
            $data['user_pages'] = $this->get_user_page_using_api(); //Facebook pages of a user. These pages are not havent't added to DB
            
            $this->load->view('user_dashboard', $data);         
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function schedule_publish_form() {
        $this->load->view('post_fanpage');
    }
    
    public function schedule_publish_photo_form($type) {
        switch ($type) {
            case 'url': 
                $data['action'] = 'fanpage/schedule_publish_photo';
                $this->load->view('post_photo_url',$data);
                break;
            case 'local':
                $data['action'] = 'fanpage/schedule_publish_photo_from_local';
                $this->load->view('post_photo_local',$data);
                break;
        }
    }    
    
    public function instant_publish($content) {
        //Check if post time is valid: >= now + 10 minutes
        
        if ($this->input->post('submit') == null) {
            return $result;
        }
        
        if (isset($this->page_session)) { // Login successful 
            //*** Call api
            $arr = $this->get_param();
            try {

                 $request = new FacebookRequest(
                        $this->page_session,
                        'POST',
                        '/'.$this->page_id.'/feed',
                        array (
                          'message' => $arr['message'],
                          'published' => true,
                        )
                    );
                    $response = $request->execute();

                    /* handle the result */
                    echo "Post successfully";

            } catch(FacebookRequestException $e) {
                    echo "Exception occured, code: " . $e->getCode();
                    echo " with message: " . $e->getMessage();

            } catch (Exception $ex) {
                    echo 'Error '. $ex->getMessage();
            }
        } else {
            echo 'Not logged <br/>';
            $login_url = $helper->getLoginUrl(array('publish_actions'));
            echo "<a href='". $login_url. "'>Login with facebook</a>";            
        }        
    }
    
    public function schedule_publish() {
        
        //Check if post time is valid: >= now + 10 minutes
        
        if ($this->input->post('submit') == null) {
            return $result;
        }
        
        if (isset($this->page_session)) { // Login successful 
            //*** Call api
            $arr = $this->get_param();
            try {

                 $request = new FacebookRequest(
                        $this->page_session,
                        'POST',
                        '/'.$this->page_id.'/feed',
                        array (
                          'message' => $arr['message'],
                          'scheduled_publish_time'=> $arr['datetime'],
                          'published' => false,
                        )
                    );
                    $response = $request->execute();

                    /* handle the result */
                    echo "Post successfully";

            } catch(FacebookRequestException $e) {
                    echo "Exception occured, code: " . $e->getCode();
                    echo " with message: " . $e->getMessage();

            } catch (Exception $ex) {
                    echo 'Error '. $ex->getMessage();
            }
        } else {
            echo 'Not logged <br/>';
            $login_url = $helper->getLoginUrl(array('publish_actions'));
            echo "<a href='". $login_url. "'>Login with facebook</a>";            
        }
    }
    
    public function schedule_publish_photo() {
        //Check if post time is valid: >= now + 10 minutes
        
        if ($this->input->post('submit') == null) {
            return $result;
        }
        
        if (isset($this->page_session)) { // Login successful 
            //*** Call api
            $arr = $this->get_param();
            try {

                 $request = new FacebookRequest(
                        $this->page_session,
                        'POST',
                        '/'.$this->page_id.'/photos',
                        array (
                            'message' => $arr['message'],
                            'scheduled_publish_time'=> $arr['datetime'],
                            'published' => false,
                            'url'      => $arr['image'],
                        ) 
                    );
                    $response = $request->execute();

                    /* handle the result */
                    echo "Post successfully";

            } catch(FacebookRequestException $e) {
                    echo "Exception occured, code: " . $e->getCode();
                    echo " with message: " . $e->getMessage();

            } catch (Exception $ex) {
                    echo 'Error '. $ex->getMessage();
            }
        } else {
            echo 'Not logged <br/>';
            $login_url = $helper->getLoginUrl(array('publish_actions'));
            echo "<a href='". $login_url. "'>Login with facebook</a>";            
        }        
    }
    
    public function schedule_publish_photo_from_local() {
        //Check if post time is valid: >= now + 10 minutes
        
        if ($this->input->post('submit') == null) {
            return $result;
        }
        if (!$this->my_upload->upload_photo()) {
            //Faile
            echo $this->my_upload->errors;
            return;
        }
        if (isset($this->page_session)) { // Login successful 
            //*** Call api
            $arr = $this->get_param();
            try {

                 $request = new FacebookRequest(
                        $this->page_session,
                        'POST',
                        '/'.$this->page_id.'/photos',
                        array (
                            'message' => $arr['message'],
                            'scheduled_publish_time'=> $arr['datetime'],
                            'published' => $arr['publish'],
                            'source' => new CURLFile($this->my_upload->full_path, 'image/png'),
                        )
                    );
                    $response = $request->execute();

                    /* handle the result */
                    echo "Post successfully";

            } catch(FacebookRequestException $e) {
                    echo "Exception occured, code: " . $e->getCode();
                    echo " with message: " . $e->getMessage();

            } catch (Exception $ex) {
                    echo 'Error '. $ex->getMessage();
            }
        } else {
            echo 'Not logged <br/>';
            $login_url = $helper->getLoginUrl(array('publish_actions'));
            echo "<a href='". $login_url. "'>Login with facebook</a>";            
        }
    }
    
    public function add_fanpage() {
        try {
            if ($this->input->post('submit')) {
                $page_id = $this->input->post('fanpage');
                if ($this->fanpage_model->add_fanpage($this->get_fanpage($page_id), $this->session->userdata('user_id'))) {
                    //Set flash session
                    $this->session->set_flashdata('success', 'Added');
                    redirect('fanpage/index');
                }
                
                $this->session->set_flashdata('error', 'Errors');
                redirect('fanpage/index');
            }
            show_404();
        } catch (Exception $ex) {
            $this->session->set_flashdata('error', 'Errors');
            redirect('fanpage/index');
        }
    }
    /*
     * @Param: string
     * @Return void
     */
    public function delete_fanpage($fanpage_id) {
        try {
            
            if ($this->fanpage_model->delete_fanpage($fanpage_id)) {
                $this->session->set_flashdata('success',REMOVED_FANPAGE);
            }else {
                $this->session->set_flashdata('error',ERROR_REMOVED_FANPAGE);
            }
            $this->load->view('fanpage/index');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    //*** Private function
    private function get_param() {
        $result = array();
        $date = new DateTime($this->input->post('time'), new DateTimeZone('Asia/Bangkok'));
        
        $result['message'] = $this->input->post('message');
        $result['datetime'] = $date->getTimestamp();
        
        if($this->input->post('image') != null) {
            $result['image'] = $this->input->post('image');
        }
        
        if($this->input->post('publish') != null) {
            $result['publish'] = $this->input->post('publish');
        }
        
        return $result;
    }
    
    /*
     * Get list of User's pages using FB api
     * These pages haven't added to DB
     * @Return: array
     */
    private function get_user_page_using_api() {
        $result = array();
        $user_session = new FacebookSession($this->session->userdata('user_token'));
        
        //*** Check if invalid
        if ($user_session->validate()) {
            $request = (
                    new FacebookRequest($user_session, 
                    'GET', 
                    '/me/accounts',
                    array('name', 'id', 'access_token',)
                ))->execute();
            $response = $request->getGraphObject();
            
            //*** Get array of Page objects
            $pages = $response->getPropertyAsArray('data');
            foreach ($pages as $item) {
                $item = $item->asArray(); //Convert oject to array
                if (in_array('CREATE_CONTENT', $item['perms'])) {
                    //*** Check if fanpage has added in DB
                    if ( !$this->fanpage_model->check_exist($item['id'], $this->session->userdata('user_id'))) {
                        $result[] = array(
                            'name' => $item['name'],
                            'id' => $item['id'],
                            'access_token' => $item['access_token'],
                        );
                    }
                }
                
            }
        }
        return $result;
    }
    
    private function get_fanpage($page_id) {
        $pages = $this->get_user_page_using_api();
        foreach ($pages as $item) {
            if ($page_id == $item['id']) {
                $item['cover'] = $this->get_page_cover_url($item['id']);
                return $item;
            }
        }
        return null;
    }
    
    //***API Facebook
    private function get_page_cover_url($page_id) {
        $user_session = new FacebookSession($this->session->userdata('user_token'));
        
        if ($user_session->validate()) {
            $request = (new FacebookRequest($user_session, 'GET', '/'. $page_id))->execute();
            $response = $request->getGraphObject()->asArray();
            
            if (isset($response['cover'])) {
                return $response['cover']->source;
            }else {
                return '';
            }
        }        
    }
    
    //*** TEST
    function test() {
        echo "<pre>";
        echo __CLASS__ .'->'. __FUNCTION__;
        $r = $this->get_user_page_using_api('121809317986153');
        print_r($r);
    }
}

