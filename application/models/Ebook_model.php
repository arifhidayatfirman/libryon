<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebook_model extends CI_Model {

    private $table = 'books';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get all books that are not soft-deleted
    public function get_all_books()
    {
        $this->db->where('deleted_at', NULL);
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
}
