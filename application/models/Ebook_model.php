<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebook_model extends CI_Model {

    private $table = 'books';

    public function __construct()
    {
        parent::__construct();
    }

    // Get all books that are not soft-deleted
    public function get_all_books()
    {
        $this->db->where('deleted_at', NULL);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    // Get a single book by its ID that is not soft-deleted
    public function get_book_by_id($id)
    {
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get_where($this->table, array('book_id' => $id));
        return $query->row_array();
    }

    public function get_book_with_uploader_info($id)
    {
        $this->db->select('books.*, users.username, users.avatar_file, users.full_name, users.donation_target, donation_options.name as donation_option_name');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id');
        $this->db->join('donation_options', 'donation_options.option_id = users.donation_option_id', 'left');
        $this->db->where('books.book_id', $id);
        $this->db->where('books.deleted_at', NULL);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Insert a new book record
    public function insert_book($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update a book record
    public function update_book($id, $data)
    {
        $this->db->where('book_id', $id);
        return $this->db->update($this->table, $data);
    }

    // Soft delete a book record by setting the deleted_at timestamp
    public function soft_delete_book($id)
    {
        $this->db->where('book_id', $id);
        return $this->db->update($this->table, array('deleted_at' => date('Y-m-d H:i:s')));
    }

    public function get_books_by_user_id($user_id, $limit = NULL, $offset = NULL)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('deleted_at', NULL);
        if ($limit !== NULL && $offset !== NULL) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function count_books_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('deleted_at', NULL);
        return $this->db->count_all_results($this->table);
    }

    public function get_access_by_user($user_id, $book_id)
    {
        $this->db->where('borrower_user_id', $user_id);
        $this->db->where('book_id', $book_id);
        $query = $this->db->get('book_access_transactions');
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return true;
        }
    }

}