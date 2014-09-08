<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fanpage_model extends CI_Model
{
    /*
     * @Param: user_id
     * @Return: Array
     */
    function get_page_list($user_id) {
        $query = $this->db->select('*')
                ->from('user_page')
                ->join('pages', 'pages.id = user_page.page_id')
                ->where('user_page.user_id', $user_id)
                ->get();
        return $query->result_array();
    }
    
    /*
     * @Param: $_POST
     * @Return: bool
     */
    function add_fanpage($page, $user_id) {

        echo "<pre>";
        print_r($this->session->all_userdata());
        exit;
        $data = array(
            'fanpage_id' => $page['id'],
            'name' => $page['name'],
            'long_lived_access_token' => $page['access_token'],
            'cover' => '',
        );

        if (!$this->db->insert('pages', $data)) {
            return false;
        }
        
        //***Add a record to user_page table
        $page_id = $this->db->insert_id();
        
        
        if ( !$this->set_fanpage_to_user($this->db->insert_id(),$user_id ) ) {
            return false;
        }        
        
        return true;
    }
    
    function check_exist($page_id) {
        $query = $this->db->get_where('pages', array('fanpage_id' => $page_id))->result();
        if (empty($query)) {
            return FALSE;
        }
        return TRUE;
    }
    
    function set_fanpage_to_user($page_id, $user_id) {
        $data = array(
            'page_id' => $page_id,
            'user_id' => $user_id,
        );

        if (!$this->db->insert('user_page', $data)) {
            return false;
        }
        return true;        
    }
}
