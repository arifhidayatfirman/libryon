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
        $data['books'] = $this->Ebook_model->get_all_books();
        $this->load->view('public/ebook_catalog', $data);
    }

}