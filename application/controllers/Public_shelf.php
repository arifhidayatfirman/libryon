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
        $this->db->select('books.*, users.username, users.avatar_file');
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

        $is_exlusive = ($data['book']['access_type'] == 'EXCLUSIVE');
        if ($is_exlusive) {
            // Check if user was uploader
            $acccess = ($this->session->userdata('user_id') == $data['book']['user_id']);
            if(!$acccess)
                $acccess = $this->Ebook_model->get_access_by_user($this->session->userdata('user_id'), $id);
        } else {
            $acccess = true;
        }

        //Check If Occupied
        $current_time = date('Y-m-d H:i:s');
        $data_books_ts = $this->db->select('occupied_user_ts, occupied_by_user_id')
                                      ->from('books')
                                      ->where('book_id', $id)
                                      ->where('occupied_by_user_id !=', $this->session->userdata('user_id'))
                                      ->get()
                                      ->row();
        if(!empty($data_books_ts)) {
            if (strtotime($current_time) - strtotime($data_books_ts->occupied_user_ts) <= 300) {
                $data_occupied_user = $this->db->select('username')
                                              ->from('users')
                                              ->where('user_id', $data_books_ts->occupied_by_user_id)
                                              ->get()
                                              ->row();
                $msg = ' The book is currently being read by <a><strong>'.$data_occupied_user->username . '</strong></a>';
            }
        }

        if(!empty($this->session->userdata('user_id'))) {
            $data['enc_book_id'] = $this->encryptString($data['book']['book_id'], '@libryon');
            $data['enc_user_id'] = $this->encryptString($this->session->userdata('user_id'), '@libryon');
        } else {
            $data['enc_book_id'] = '';
            $data['enc_user_id'] = '';
        }
        $data['has_access'] = $acccess;
        $data['occupy_msg'] = isset($msg) ? $msg : '';
        $data['title'] = $data['book']['title'];
        $this->load->view('public/ebook_view', $data);
    }

    public function search() {
        $query = $this->input->get('q');
        $this->db->select('books.*, users.username, users.avatar_file');
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

    function updateReadingStatus() {
        header('Content-Type: application/json');

        $book_id = $this->decryptString($this->input->post('id'), '@libryon');
        $user_id = $this->decryptString($this->input->post('kd'), '@libryon');

        $current_time = date('Y-m-d H:i:s');
        $data_books_ts = $this->db->select('occupied_user_ts, occupied_by_user_id')
                                      ->from('books')
                                      ->where('book_id', $book_id)
                                      ->where('occupied_by_user_id !=', $user_id)
                                      ->get()
                                      ->row();
        if(!empty($data_books_ts)) {
            if (strtotime($current_time) - strtotime($data_books_ts->occupied_user_ts) <= 300) {
                $data_occupied_user = $this->db->select('username')
                                              ->from('users')
                                              ->where('user_id', $data_books_ts->occupied_by_user_id)
                                              ->get()
                                              ->row();
                echo json_encode(['success' => false, 'message' => 'The book is currently being read by '.$data_occupied_user->username.'. Please try again later.'] );
                return;
            }
        }

        $data = array(
            'occupied_by_user_id' => $user_id,
            'occupied_user_ts' => date('Y-m-d H:i:s'),
        );
        $this->db->where('book_id', $book_id);
        $this->db->update('books', $data);

        echo json_encode(['success' => true] );
    }

    function encryptString($data, $key) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    function decryptString($encryptedData, $key) {
        $data = base64_decode($encryptedData);
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);
        return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
    }

}