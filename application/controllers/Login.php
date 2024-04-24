<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model', 'users');
    }

    public function index()
    {
        $data = [
            'title' => 'login pages',
            'content' => 'pages/login',
        ];
        $this->load->view('template', $data);
    }

    public function process()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            redirect('login');
        } else {
            $data = [
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            ];

            $user_id = $this->users->login_process($data);

            if ($user_id) {
                $this->session->set_userdata('id', $user_id);
                redirect('profile');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('profile');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        redirect('login');
    }

}
