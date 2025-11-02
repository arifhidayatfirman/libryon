<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        create_placeholder_image();
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('admin_ebooks');
        }
        $this->load->view('auth/login');
    }

    public function process_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_username($username);

            if ($user && password_verify($password, $user['password'])) {
                $session_data = array(
                    'user_id'  => $user['user_id'],
                    'username' => $user['username'],
                    'email'    => $user['email'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                redirect('admin_ebooks');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('admin_ebooks');
        }
        $this->load->view('auth/register');
    }

    public function process_registration()
    {
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register');
        } else {
            $username = $this->input->post('username');
            $storage_path = 'user_storage/' . $username . '_' . time();

            // Create user directory
            if (!is_dir('./uploads/user_storage')) {
                mkdir('./uploads/user_storage', 0755, TRUE);
            }

            if (!mkdir('./uploads/' . $storage_path, 0755, TRUE)) {
                $this->session->set_flashdata('error', 'Could not create user storage. Please contact admin.');
                $this->load->view('auth/register');
                return;
            }

            // Profile picture upload
            $profile_picture = '';
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['name'] != '') {
                $config['upload_path'] = './uploads/' . $storage_path;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('profile_picture')) {
                    $upload_data = $this->upload->data();
                    $profile_picture = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    $this->load->view('auth/register');
                    return;
                }
            }

            $data = array(
                'full_name' => $this->input->post('full_name'),
                'username'  => $username,
                'email'     => $this->input->post('email'),
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'storage_path' => $storage_path,
                'profile_picture' => $profile_picture,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            if ($this->User_model->insert_user($data)) {
                $this->session->set_flashdata('success', 'Registration successful! Please log in.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
                $this->load->view('auth/register');
            }
        }
    }

    public function profile()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        if (empty($data['user'])) {
            show_404();
        }

        $data['title'] = 'User Profile';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('auth/profile', $data);
        $this->load->view('admin/templates/footer');
    }

    public function change_password()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $data['title'] = 'Change Password';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('auth/change_password', $data);
        $this->load->view('admin/templates/footer');
    }

    public function ewallet_config()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->model('Donation_model');
        $data['options'] = $this->Donation_model->get_all_options();

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        $this->form_validation->set_rules('donation_option_id', 'Donation Option', 'required');
        $this->form_validation->set_rules('donation_target', 'Donation Target', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'E-Wallet Configuration';
            $this->load->view('admin/templates/header', $data);
            $this->load->view('auth/ewallet_config', $data);
            $this->load->view('admin/templates/footer');
        } else {
            $user_id = $this->session->userdata('user_id');
            $update_data = array(
                'donation_option_id' => $this->input->post('donation_option_id'),
                'donation_target' => $this->input->post('donation_target')
            );

            if ($this->User_model->update_user($user_id, $update_data)) {
                $this->session->set_flashdata('success', 'E-wallet information updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to update e-wallet information.');
            }
            redirect('auth/ewallet_config');
        }
    }
}