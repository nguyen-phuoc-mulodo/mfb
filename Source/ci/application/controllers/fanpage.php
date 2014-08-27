<?php
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUserPage;

class Fanpage extends GB_Controller
{
    private $page_id = '676020879146272';
    
    function index() {
        $page_token = 'CAAJ4LGdPR8MBAK8ZA6glUFtrVOET7NMFqcR88YEQIdydp8o4ugUpkZAJJFZBodv1Rz8iYDQKhCeyxm3VIHhK8K0Llkm7WOhLe5uiObm57TpmPxRXdb4CSJRlMZAuUYj6vBx6VXrhApyMLAOsvDxZBcZBVTG1tOZAPKt7ZBxbmIcGc8XCagrZAqVa7pfdANJknCDIZD';
        $page_session = new FacebookSession($page_token);
        return $page_session->getLongLivedSession()->getAccessToken();
    }
    
    function instant_publish($content) {
        
    }
    
    function schedule_publish($content, $post_time) {
        $token = $this->index();
        $page_session = new FacebookSession($token);
        
        //Check if post time is valid: >= now + 10 minutes
        
        if(false) {
            // Not valid
        }
        
        //*** Call api
        try {
            
             $request = new FacebookRequest(
                    $page_session,
                    'POST',
                    '/'.$this->page_id.'/feed',
                    array (
                      'message' => $content,
                      'scheduled_publish_time'=> $post_time,
                      'published' => false,
                    )
                );
                $response = $request->execute();
                $graphObject = $response->getGraphObject(Facebook\GraphPage::className());
                
                /* handle the result */
                echo "Posted with id: ". $graphObject->getProperty('id');

        } catch(FacebookRequestException $e) {
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();

        } catch (Exception $ex) {
                echo 'Error '. $ex->getMessage();
        }    
    }
    
    private function get_param() {
        $result = array();
        
        if (!isset($post)) {
            return $result;
        }
        
//        foreach() {
//            
//        }
        return $result;
    }
}

