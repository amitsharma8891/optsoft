<?php

class user extends CI_Model {

    public function save_user($firstname, $lastname, $email, $profile_pic,$address, $age) {
        $this->load->helper('url');
        $this->load->database();
//        echo $firstname.'hello'.' ';
        $this->first_name = $firstname;
        $this->last_name = $lastname;
        $this->email = $email;
        $this->profile_pic = $profile_pic;
        $this->address = $address;
        $this->age = $age;
        $this->db->insert('user', $this);
        
    }

     public function get_registered_user($limit,$start) {
        $this->load->helper('url');
        $this->load->database();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
//         $this->db->last_query();
        return $result = $query->result_array();
    }
    public function record_count(){
          return $this->db->count_all("user");
    }
}


?>
