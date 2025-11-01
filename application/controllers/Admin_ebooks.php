<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ebooks extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ebook_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Ebook List';
        $data['books'] = $this->Ebook_model->get_all_books();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/ebook_list', $data);
        $this->load->view('admin/templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Add New Ebook';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/ebook_form');
        $this->load->view('admin/templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('language', 'Language', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $data['title'] = 'Add New Ebook';
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/ebook_form');
            $this->load->view('admin/templates/footer');
        } else {
            // Config for cover image
            $config_cover['upload_path']   = './img/covers/';
            $config_cover['allowed_types'] = 'gif|jpg|png|jpeg';
            $config_cover['encrypt_name']  = TRUE;

            $this->load->library('upload', $config_cover);
            $this->upload->initialize($config_cover);

            if (!$this->upload->do_upload('cover_image_file')) {
                $this->session->set_flashdata('error', 'Cover Image Upload Error: ' . $this->upload->display_errors());
                redirect('admin_ebooks/create');
                return;
            }
            $cover_data = $this->upload->data();

            // Config for ebook file
            $config_ebook['upload_path']   = './uploads/ebooks/';
            $config_ebook['allowed_types'] = 'pdf';
            $config_ebook['encrypt_name']  = TRUE;

            $this->upload->initialize($config_ebook);

            if (!$this->upload->do_upload('file_name')) {
                // If ebook upload fails, delete the already uploaded cover image
                unlink($cover_data['full_path']);
                $this->session->set_flashdata('error', 'Ebook File Upload Error: ' . $this->upload->display_errors());
                redirect('admin_ebooks/create');
                return;
            }
            $ebook_data = $this->upload->data();

            // Both files uploaded successfully, now insert into DB
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title'),
                'author' => $this->input->post('author'),
                'description' => $this->input->post('description'),
                'language' => $this->input->post('language'),
                'access_type' => $this->input->post('access_type'),
                'donation_info' => $this->input->post('donation_info'),
                'cover_image_file' => $cover_data['file_name'],
                'file_name' => $ebook_data['file_name'],
                'mime_type' => $ebook_data['file_type'],
                'file_size' => $ebook_data['file_size'],
                'upload_date' => date('Y-m-d H:i:s')
            );

            $this->Ebook_model->insert_book($data);
            $this->session->set_flashdata('success', 'Ebook added successfully!');
            redirect('admin_ebooks');
        }
    }

    public function edit($id)
    {
        $data['book'] = $this->Ebook_model->get_book_by_id($id);

        if (empty($data['book'])) {
            show_404();
        }

        $data['title'] = 'Edit Ebook';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/ebook_form', $data);
        $this->load->view('admin/templates/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('language', 'Language', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $data['book'] = $this->Ebook_model->get_book_by_id($id);
            $data['title'] = 'Edit Ebook';
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/ebook_form', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $data = array(
                'title' => $this->input->post('title'),
                'author' => $this->input->post('author'),
                'description' => $this->input->post('description'),
                'language' => $this->input->post('language'),
                'access_type' => $this->input->post('access_type'),
                'donation_info' => $this->input->post('donation_info'),
            );

            $this->Ebook_model->update_book($id, $data);
            $this->session->set_flashdata('success', 'Ebook updated successfully!');
            redirect('admin_ebooks');
        }
    }

    public function delete($id)
    {
        $book = $this->Ebook_model->get_book_by_id($id);
        if (isset($book['book_id'])) {
            // Delete files from server
            if (file_exists('./img/covers/' . $book['cover_image_file'])) {
                unlink('./img/covers/' . $book['cover_image_file']);
            }
            if (file_exists('./uploads/ebooks/' . $book['file_name'])) {
                unlink('./uploads/ebooks/' . $book['file_name']);
            }
            
            // Soft delete from database
            $this->Ebook_model->soft_delete_book($id);
            $this->session->set_flashdata('success', 'Ebook deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Ebook not found.');
        }
        redirect('admin_ebooks');
    }
}
