<?php

class users extends CI_Model {

    public function save_login_user($username, $password, $user_type) {
        $this->load->helper('url');
        $this->load->database();
//        echo $firstname.'hello'.' ';
        $this->username = $username;
        $this->password = $password;
        $this->user_type = $user_type;

        $this->db->insert('users', $this);
    }

    public function get_auth_users($username, $password, $user_type) {

        // Prep the query
        $this->load->helper('url');
        $this->load->database();
        $this->db->select('*');
        $this->db->from('users');

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('user_type', $user_type);
        // Run the query

        $query = $this->db->get();
//        echo $this->db->last_query();
//        print_r($query);
        $result = $query->result_array();
//        print_r($result);

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
        // Let's check if there are any results
    }

    public function username_exists($username) {
        $this->load->helper('url');
        $this->load->database();
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $query = $this->db->get();
//        echo $this->db->last_query();
//        print_r($query);
        $result = $query->result_array();
        if (!empty($result)) {

            return true;
        } else {
            return false;
        }
    }

}

?>