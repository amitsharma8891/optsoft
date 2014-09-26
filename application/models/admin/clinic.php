<?php

class clinic extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
    }

    public function get_registered_user($limit, $start) {
//        echo $limit.' ';
//        echo $start.' ';
//        die;
        $this->load->helper('url');
        $this->load->database();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
//       echo  $this->db->last_query();
        return $result = $query->result_array();
    }

    public function record_count() {
        return $this->db->count_all("user");
    }

    public function save($type, $save_data) {
        $clinic_id = 0;
        if ($type == 'clinic') {
            $this->name = $save_data['name'];
            $this->start_date = $save_data['start_date'];
            $this->end_date = $save_data['end_date'];
            $this->country_id = $save_data['country_id'];
            $this->doctor_id = $save_data['doctor_id'];
            $this->state_id = $save_data['state_id'];
            $this->created_user = $this->session->userdata('loggedin_user');
            $this->slot_interval = $save_data['slot_interval'];
            ;
//            $this->db->insert('clinic', $this);
//            $clinic_id = $this->db->insert_id();
//            $this->load->model('admin/clinic');
//            $this->clinic->save_clinic_doctor($clinic_id, $save_data['doctor_id']);
            if ($this->db->insert('clinic', $this)) {
                $clinic_id = $this->db->insert_id();
                $this->db->trans_complete();
                return $clinic_id;
            } else {
                return false;
            }
//            $this->save_clinic_doctor($clinic_id, $doctor_id);
        } else if ($type == 'doctor') {
            $this->name = $save_data['name'];
            $this->qualification = $save_data['qualification'];
            $this->image = $save_data['image_name'];
            $this->created_user = $this->session->userdata('loggedin_user');
            if ($this->db->insert('doctor', $this)) {
                return true;
            } else {
                return false;
            }
        }
//        $this->save_clinic_doctor($clinic_id, $doctor_id);
    }

    public function get_clinics() {
        $this->db->select('cl.*,c.*,s.*,d.name as doctor_name');
        $this->db->from('clinic as cl');
        $this->db->join('country as c', 'c.country_id=cl.country_id');
        $this->db->join('state as s', 's.state_id=cl.state_id', 'left outer');
        $this->db->join('doctor as d', 'cl.doctor_id=d.id', 'left outer');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_doctors() {
        $this->db->select('*');
        $this->db->from('doctor');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_data($id, $type) {
        $this->db->select('*');
        $this->db->from($type);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function update($id, $type, $update_data) {
        if ($type == 'clinic') {
            $data = array(
                'name' => $update_data['name'],
                'start_date' => $update_data['start_date'],
                'end_date' => $update_data['end_date'],
                'doctor_id' => $update_data['doctor'],
                'slot_interval' => $update_data['slot_interval']
            );
            $this->db->where('id', $id);
            $this->db->update($type, $data);
        } else if ($type == 'doctor') {
            $data = array(
                'name' => $update_data['name'],
                'qualification' => $update_data['qualification'],
                'image' => $update_data['pic']
//                'end_date' => $update_data['end_date']
            );
            $this->db->where('id', $id);
            $this->db->update($type, $data);
        }
    }

    public function get_country() {
        $this->db->select('*');
        $this->db->from('country');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_states($country_id) {
        $this->db->select('*');
        $this->db->from('state');
        $this->db->where('country_code', $country_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_currency($country_id) {
        $this->db->select('*');
        $this->db->from('currency');
        $this->db->where('country_code', $country_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_all_states() {
        $this->db->select('*');
        $this->db->from('state');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_slot_interval() {
        $this->db->select('*');
        $this->db->from('slot_interval');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function delete($id, $type) {
        $this->db->where('clinic_id', $id);
        $this->db->delete('clinic_doctor');
        $this->db->where('id', $id);
        $this->db->delete($type);
    }

    public function save_clinic_doctor($clinic_id, $doctor_id) {
        $this->load->database();
        $data = array('clinic_id' => $clinic_id,
            'doctor_id' => $doctor_id,
            'created_user' => $this->session->userdata('loggedin_user'));
        if ($this->db->insert('clinic_doctor', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_clinic_doctor($clinic_id, $old_doctor_id, $new_doctor_id) {
        $data = array(
            'doctor_id' => $new_doctor_id,
            'clinic_id' => $clinic_id,
            'created_user' => $this->session->userdata('loggedin_user')
        );

        $this->db->where('clinic_id', $clinic_id);
        $this->db->where('doctor_id', $old_doctor_id);
        $this->db->delete('clinic_doctor');
        $this->db->insert('clinic_doctor', $data);
    }

    public function check_for_date($start_date) {
        $start_date = date('Y-m-d', strtotime($start_date));
        $this->db->select('*');
        $this->db->from('clinic');
        $this->db->where('id', 2);
//        echo $this->db->last_query();
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    public function get_filename($id) {
        $this->db->select('*');
        $this->db->from('doctor');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_single_clinic($clinic_id) {
        $this->db->select('*');
        $this->db->from('clinic');
        $this->db->where('id', $clinic_id);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

}

?>