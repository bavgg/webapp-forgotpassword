<?php

class Forgot_password extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("form");
        $this->load->library("form_validation");
        $this->load->library('email');
        $this->load->model('forgot_password_model');
    }

    public function index()
    {
        $data['title'] = 'Forgot Password';
        $this->load->view('forgot_password', $data);
    }

    public function verify()
    {

        $this->form_validation->set_rules('txtEmail', 'Email Address', 'required|trim|valid_email|callback_check_email');

        if ($this->form_validation->run()) {

           

            $this->email->from('admin@domain.com', 'Site Admin');
            $this->email->to($this->input->post('txtEmail'));

            $this->email->subject('Reset Password');
            $this->email->message('To reset your password, please click this link: ' . 'http://localhost:8080/forgot_password/reset/' . md5($this->input->post('txtEmail')));

            $this->email->send();
            $data['title'] = 'Reset Password Link Sent';
            $data['message'] = 'Please check your email for the reset password link';
            $this->load->view('forgot_password_link_sent', $data);
            
        } else {
            $this->index();
        }
    }

    public function check_email($email) {

        
        
        if($this->forgot_password_model->get_customer($email)) {
          return true;
        } else {
          $this->form_validation->set_message('check_email', 'The %s entered does not exist!');
          return false;
        }
      
      }
}
