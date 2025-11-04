<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_profile extends CI_Controller {

    const EBOOKS_PER_PAGE = 6; // Define how many ebooks to load per page

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Ebook_model');
        $this->load->helper('url'); // Load URL helper for base_url()
        $this->load->helper('text'); // Load text helper for word_limiter()
    }

    public function view($username)
    {
        $user = $this->User_model->get_user_by_username($username);

        if (empty($user)) {
            show_404();
        }

        $data['user'] = $user;
        // Load initial set of ebooks
        $data['ebooks'] = $this->Ebook_model->get_books_by_user_id($user['user_id'], self::EBOOKS_PER_PAGE, 0);
        $data['total_ebooks'] = $this->Ebook_model->count_books_by_user_id($user['user_id']);

        $this->load->view('public/public_profile', $data);
    }

    public function load_more_ebooks($username)
    {
        $offset = $this->input->get('offset');
        $user = $this->User_model->get_user_by_username($username);

        if (empty($user)) {
            echo json_encode(['ebooks' => [], 'has_more' => false]);
            return;
        }

        $ebooks = $this->Ebook_model->get_books_by_user_id($user['user_id'], self::EBOOKS_PER_PAGE, $offset);
        $total_ebooks = $this->Ebook_model->count_books_by_user_id($user['user_id']);

        $has_more = ($offset + self::EBOOKS_PER_PAGE) < $total_ebooks;

        // Prepare ebooks data for JSON response, including full URLs for images and read button
        $formatted_ebooks = [];
        foreach ($ebooks as $ebook) {
            $ebook['cover_image_url'] = !empty($ebook['cover_image']) ? base_url('uploads/covers/' . $ebook['cover_image']) : base_url('assets/img/default_book_cover.png');
            $ebook['read_url'] = base_url('public_shelf/view/' . $ebook['book_id']);
            $ebook['description_limited'] = word_limiter($ebook['description'], 20);
            $formatted_ebooks[] = $ebook;
        }

        echo json_encode([
            'ebooks' => $formatted_ebooks,
            'has_more' => $has_more
        ]);
    }
}