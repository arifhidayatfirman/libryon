<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_by_username($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array();
    }

    public function get_user_by_id($user_id)
    {
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        return $query->row_array();
    }

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update_user($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', $data);
    }

}
