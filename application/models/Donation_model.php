<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_options()
    {
        $query = $this->db->get_where('donation_options', array('is_active' => 1));
        return $query->result_array();
    }
}
