<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_shelf extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        create_placeholder_image();
    }

    public function index() {
        // Join with users table to get uploader's username
        $this->db->select('books.*, users.username, books.access_type');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left'); 
        $this->db->where('books.deleted_at IS NULL'); // Assuming soft deletes
        $query = $this->db->get();
        $data['books'] = $query->result_array();
        $this->load->view('public/ebook_catalog', $data);
    }

    public function view($id)
    {
        $data['book'] = $this->Ebook_model->get_book_with_uploader_info($id);

        if (empty($data['book'])) {
            show_404();
        }

        $data['title'] = $data['book']['title'];
        $this->load->view('public/ebook_view', $data);
    }

    public function search() {
        $query = $this->input->get('q');
        $this->db->select('books.*, users.username, books.access_type');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left');
        $this->db->like('title', $query);
        $this->db->or_like('author', $query);
        $this->db->or_like('description', $query);
        $this->db->where('books.deleted_at IS NULL');
        $data['books'] = $this->db->get()->result_array();
        $data['query'] = $query;
        $this->load->view('public/ebook_catalog', $data);
    }

}