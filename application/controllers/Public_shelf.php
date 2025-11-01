<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_shelf extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ebook_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        // Join with users table to get uploader's username
        $this->db->select('books.*, users.username');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left'); 
        $this->db->where('books.deleted_at IS NULL'); // Assuming soft deletes
        $query = $this->db->get();
        $data['books'] = $query->result_array();
        $this->load->view('public/ebook_catalog', $data);
    }

    public function view($id)
    {
        $data['book'] = $this->Ebook_model->get_book_by_id($id);

        if (empty($data['book'])) {
            show_404();
        }

        $data['title'] = $data['book']['title'];
        $this->load->view('public/ebook_view', $data);
    }

}