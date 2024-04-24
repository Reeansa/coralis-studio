<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Users_model', 'users');
  }

  public function index()
  {
    if (!$this->session->userdata('id')) {
      redirect('login');
    }
    $data = [
      'user' => $this->users->getById($this->session->userdata('id')),
      'title' => 'Profile',
      'content' => 'pages/profile',
    ];
    
    $this->load->view('template', $data);
  }
}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */