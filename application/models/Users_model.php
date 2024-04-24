<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function create($data)
  {
    return $this->db->insert('users', $data);
  }

  public function getById($id)
  {
    return $this->db->get_where('users', ['id' => $id])->row_array();
  }

  public function getByEmail($email) {
    return $this->db->get_where('users', ['email' => $email])->row_array();
  }

  public function reset_token($user, $reset_token) {
    return $this->db->update('users', ['reset_token' => $reset_token], ['id' => $user]);
  }

  public function get_token($reset_token) {
    return $this->db->get_where('users', array('reset_token' => $reset_token))->row_array();
  }

  public function login_process($data)
  {
    $user = $this->db->get_where('users', ['email' => $data['email']])->row_array();
    if ($user && password_verify($data['password'], $user['password'])) {
      $this->session->set_userdata('id', $user['id']);
      return $user['id'];
    }
    return false;
  }

  public function update($password, $reset_token) {
    return $this->db->update('users', ['password' => $password, 'reset_token' => null], ['reset_token' => $reset_token]);
  }
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */