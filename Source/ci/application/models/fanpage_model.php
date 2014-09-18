<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fanpage_model extends CI_Model
{
    /*
     * @Param: user_id
     * @Return: Array
     * @Index: 
     * - id, user_id, fanpage_id, name, long_lived_access_token, cover
     */
    function get_page_list($user_id) {
        $query = $this->db->select('pages.fanpage_id, pages.cover, pages.name')
                ->from('user_page')
                ->join('pages', 'pages.fanpage_id = user_page.fanpage_id')
                ->where('user_page.user_id', $user_id)
                ->get();
        return $query->result_array();
    }
    
    /*
     * @Param: $_POST
     * @Return: bool
     */
    function add_fanpage($page, $user_id) {
        
        if ( !$this->check_exist_pages_table($page['id']) ) {
            $data = array(
                'fanpage_id' => $page['id'],
                'name' => $page['name'],
                'long_lived_access_token' => $page['access_token'],
                'cover' => $page['cover'],
            );

            //***Add a record to pages table
            if (!$this->db->insert('pages', $data)) {
                return false;
            }           
        }
        
        //***Add a record to user_page table
        if ( !$this->set_fanpage_to_user($page['id'], $user_id ) ) {
            return false;
        }
        return true;
    }
    
    /*
     * Remove a record in user_page table
     * @Param: string
     * @Return: bool
     */
    function delete_fanpage($fanpage_id) {
        if ( !$this->db->delete('mytable', array('fanpage_id' => $fanpage_id)))
        {
            return false;
        }
        return true;
    }
    
    function check_exist_pages_table($page_id) {
        $query = $this->db->get_where('pages', array('fanpage_id' => $page_id))->result();
        if (empty($query)) {
            return FALSE;
        }
        return TRUE;
    }
    
    /*
     * Check exist in user_page table
     */
    function check_exist($page_id, $user_id) {
        $query = $this->db->get_where('user_page', array('fanpage_id' => $page_id, 'user_id' => $user_id))->result();
        if (empty($query)) {
            return FALSE;
        }
        return TRUE;
    }
    
    function set_fanpage_to_user($page_id, $user_id) {
        $data = array(
            'fanpage_id' => $page_id,
            'user_id' => $user_id,
        );
        //***Add a record to user_page table
        if (!$this->db->insert('user_page', $data)) {
            return false;
        }
        return true;        
    }
}
