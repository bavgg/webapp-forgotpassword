<?php

class forgot_password_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_customer($email)
    {
        $query = $this->db->get_where('customers', array('cust_email' => $email));
        return $query->row_array();
    }

    public function find_customer($encrypted_email)
    {

        $query = $this->db->get_where('customers', array('md5(cust_email)' => $encrypted_email));

        return $query->row_array();
    }

    public function update_password($cust_id)
    {

        $new_password = md5($this->input->post('txtpass'));

        $this->db->where('cust_id', $cust_id);
        return $this->db->update('users', array('user_pass' => $new_password));
    }
}
