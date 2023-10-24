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
}
