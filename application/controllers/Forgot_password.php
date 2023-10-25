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
        $this->load->helper('email');
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



            // $this->email->from('gestopajonas@gmail.com', 'Site Admin');
            // $this->email->to($this->input->post('txtEmail'));

            // $this->email->subject('Reset Password');
            // $this->email->message('To reset your password, please click this link: ' . 'http://localhost:8080/forgot_password/reset/' . md5($this->input->post('txtEmail')));

            // $this->email->send();
            $data['title'] = 'Reset Password Link Sent';
            $data['message'] = 'Please check your email for the reset password link';
            $data['link'] = 'http://localhost:8080/forgot_password/reset/' . md5($this->input->post('txtEmail'));
            $this->load->view('forgot_password_link_sent', $data);
        } else {
            $this->index();
        }
    }

    public function check_email($email)
    {



        if ($this->forgot_password_model->get_customer($email)) {
            return true;
        } else {
            $this->form_validation->set_message('check_email', 'The %s entered does not exist!');
            return false;
        }
    }

    public function reset($encrypted_email)
    {

        

        $user = $this->forgot_password_model->find_customer($encrypted_email);

        if ($user) {

            if ($this->uri->segment(4) == 'verify') {

                $this->form_validation->set_rules('txtpass', 'New Password', 'required');
                $this->form_validation->set_rules('txtrepass', 'Re-type Password', 'required|matches[txtpass]');
            }

            if ($this->form_validation->run()) {

                $this->forgot_password_model->update_password($user['cust_id']);

                $data['title'] = 'Password Changed Successfully';
                $data['message'] = 'You may now login with your new password';

                $this->load->view('forgot_password_success', $data);
            } else {

                $data['title'] = 'Reset Password';
                $this->load->view('forgot_password_reset', $data);
            }
        } else {

            show_404();
        }
    }

    // public function send_mail($email)
    // {

    //     $this->load->helper('email');

    //     $this->load->library('email');

    //     if (valid_email($email)) {

    //         $this->email->from('slayugan@domain.com', 'Leon Dustin');

    //         $this->email->to($email);

    //         $this->email->subject('Sending Email Example');

    //         $this->email->message('<h1>Hello World!</h1><p>Love and peace from the Philippines</p>');

    //         if (!$this->email->send()) {

    //             echo "Email not sent\n" . $this->email->print_debugger();
    //         } else {

    //             echo "Email was successfully sent to $email";
    //         }
    //     } else {

    //         echo "Email is not correct. Please try again.";
    //     }
    // }
}
