<?php 

class user extends CI_Model {

    public function get_registered_user($limit,$start) {
//        echo $limit.' ';
//        echo $start.' ';
//        die;
        $this->load->helper('url');
        $this->load->database();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
//       echo  $this->db->last_query();
        return $result = $query->result_array();
    }
      public function get_auth_users($username, $password, $user_type) {

        // Prep the query
        $this->load->helper('url');
        $this->load->database();
        $this->db->select('*');
        $this->db->from('user');

        $this->db->where('name', $username);
        $this->db->where('password', $password);
        $this->db->where('user_type', $user_type);
        // Run the query

        $query = $this->db->get();
//        echo $this->db->last_query();
//        print_r($query);
        $result = $query->result_array();
//        print_r($result);

        if (!empty($result)) {
            return $result;
        } else {
            return $result;
        }
        // Let's check if there are any results
    }
       public function record_count(){
          return $this->db->count_all("user");
    }

}
?>
