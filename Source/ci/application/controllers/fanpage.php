<?php
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUserPage;

class Fanpage extends GB_Controller
{
    private $page_id = '121809317986153';
    private $page_session = null;
    private $page_token = '';
    
    function __construct() {
        parent::__construct();
        //***Load Libraries
        $this->load->library('my_upload');
        
        define('FB_APP_ID', '695082060564419');
        define('FB_APP_SECRET', '093b0b371673a8b831dcc87d62fee7b0');

        FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);
        $page_session = new FacebookSession('CAAJ4LGdPR8MBAHDVTTZBs7pEmPSukvJnecEnv2My8N5ajccWwAGCBE437IsqSXoFTEpXNYgafHKc38TSBRZCJZALTOIo2CQ3YQ4gdgWR2AgtPrt84tpfdBYVi6ZCO07mEZCkCNTQbEGI2Mx34EhzEhKoBHWlW1aG0IwUKKCzebZCP3abSV15JZB');
        $this->page_session = $page_session->getLongLivedSession();
    }
    function index() {
        //$this->schedule_publish_form();
        $this->load->view('layout');
    }
    function schedule_publish_form() {
        $this->load->view('post_fanpage');
    }
    
    function schedule_publish_photo_form($type) {
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
    
    function instant_publish($content) {
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
    
    function schedule_publish() {
        
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
}

