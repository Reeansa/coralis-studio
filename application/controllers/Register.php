<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model', 'users');
    }

    public function index()
    {
        $data = [
            'title' => 'register pages',
            'content' => 'pages/register',
        ];
        $this->load->view('template', $data);
    }

    public function process()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('profile_picture', 'Photo Profile', 'callback_upload_check');

        if ($this->form_validation->run() === FALSE) {
            redirect('register');
        } else {
            // Configurasi upload file
            $config['upload_path'] = './assets/images/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_picture')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('pages/register', $error);
            } else {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];

                $data = [
                    'email' => $this->input->post('email'),
                    'name' => $this->input->post('name'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'profile_picture' => $file_name,
                ];

                $this->users->create($data);
                $this->session->set_flashdata('success', 'Successfully registered, please login!');
                redirect('login');
            }
        }
    }

    public function upload_check($str)
    {
        if (empty($_FILES['profile_picture']['name'])) {
            $this->form_validation->set_message('upload_check', 'The Photo Profile field is required.');
            return false;
        } else {
            return true;
        }
    }

}
