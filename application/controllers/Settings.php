<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Settings extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('users_model', 'users');
  }

  public function index()
  {
    $data = [
      'title' => 'Send Email to Reset Password',
      'content' => 'pages/settings/send_reset_password'
    ];
    $this->load->view('template', $data);
  }

  public function forgot_password()
  {
    $this->form_validation->set_rules('email', 'Email', 'required');

    if ($this->form_validation->run() === FALSE) {
      redirect('Settings');
    } else {
      $email = $this->input->post('email');
      $user = $this->users->getByEmail($email);
      $name = $user['name'];


      if ($user) {
        $reset_token = bin2hex(random_bytes(16));
        $this->users->reset_token($user['id'], $reset_token);

        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '20104102@ittelkom-pwt.ac.id';
        $mail->Password = '!SGReean2D!';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('20104102@ittelkom-pwt.ac.id', 'Raihan Febriyansah');
        $mail->addAddress($email, $name);
        $mail->addReplyTo('20104102@ittelkom-pwt.ac.id');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset Your Password';
        $reset_link = site_url('settings/reset_password/' . $reset_token);
        $email_content = '<p>Please click the following link to reset your password: ' . $reset_link . '</p>';
        $mail->Body = $email_content;

        if ($mail->send()) {
          $this->session->set_flashdata('success', 'Password reset link sent to your email.');
        } else {
          $this->session->set_flashdata('error', 'Failed to send email.');
        }
        redirect('settings');
      } else {
        $this->session->set_flashdata('error', 'Invalid email address.');
        redirect('settings');
      }
    }
  }
  public function reset_password($reset_token)
  {
    $user = $this->users->get_token($reset_token);

    if ($user) {
      $data = [
        'title' => 'Reset Password',
        'content' => 'pages/settings/reset_password',
        'token' => $reset_token,
      ];
      $this->load->view('template', $data);
    } else {
      $this->session->set_flashdata('error', 'Invalid reset token.');
      redirect('login');
    }
  }

  public function process_reset_password()
  {
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

    if ($this->form_validation->run() === FALSE) {
      redirect('settings/reset_password ' . $this->input->post('token'));
    } else {
      $reset_token = $this->input->post('token');
      $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

      $this->users->update($password, $reset_token);

      $this->session->set_flashdata('success', 'Password reset successful. Please login with your new password.');
      redirect('login');
    }
  }
}


/* End of file User.php */
/* Location: ./application/controllers/User.php */