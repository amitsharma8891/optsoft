<?php

class Clinics extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $is_loggedin = $this->session->userdata('isLoggedIn');
        if (!$is_loggedin)
            redirect(SITE_URL . 'login');
    }

    public function index() {
        $data = array();
        $this->load->model('admin/clinic');
        $data['doctor'] = $this->clinic->get_doctors();
        $data['country'] = $this->clinic->get_country();
        $data['slot_interval'] = $this->clinic->get_slot_interval();

        $this->load->view('admin/add_clinic', $data);
    }

    public function save_clinic() {
        $save_data = array();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('doctor', 'Doctor', 'required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[clinic.name]');

//        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required|is_unique[clinic.start_date]');
        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required|callback_check_for_date[' . $this->input->post('start_date') . ']');
        $this->form_validation->set_rules('end_date', 'End Date', 'trim|required|is_unique[clinic.end_date]');
//        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required|regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]'); 
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
//            redirect($_SERVER['http_referer']);
//            redirect(SITE_URL.'add-clinic');
            $this->index();
//            $this->load->view('admin/add_clinic', $data);
        } else {
            $type = 'clinic';
            $save_data['name'] = $this->input->post('name');
            $save_data['start_date'] = date('Y-m-d', strtotime($this->input->post('start_date')));
            $save_data['end_date'] = date('Y-m-d', strtotime($this->input->post('end_date')));
            $save_data['doctor_id'] = $this->input->post('doctor');
            $save_data['country_id'] = $this->input->post('country');
            $save_data['state_id'] = $this->input->post('state');
            $save_data['slot_interval'] = $this->input->post('slot_interval');
            $this->load->model('admin/clinic');
            $clinic_id = $this->clinic->save($type, $save_data);
            if ($clinic_id != 0)
                $this->clinic->save_clinic_doctor($clinic_id, $this->input->post('doctor'));
            redirect(SITE_URL . 'dashboard');
        }
    }

    public function edit_clinic($id) {
        $this->load->model('admin/clinic');
        $type = 'clinic';
        $data['clinic'] = $this->clinic->get_data($id, $type);
        $data['doctor'] = $this->clinic->get_doctors();
        $data['country'] = $this->clinic->get_country();
        $data['slot_interval'] = $this->clinic->get_slot_interval();
        $data['state'] = $this->clinic->get_states($data['clinic']['0']['country_id']);
        $this->load->view('admin/edit_clinic', $data);
    }

    public function update_clinic($id) {
        $update_data = array();
        $this->load->library('form_validation');
        $this->load->model('admin/clinic');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('doctor', 'Doctor', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
//            redirect($_SERVER['http_referer']);
            $this->edit_clinic($id);
//            $this->load->view('admin/add_clinic', $data);
        } else {
            $type = 'clinic';
            $data['clinic'] = $this->clinic->get_data($id, $type);
            $update_data['name'] = $this->input->post('name');
            $update_data['start_date'] = date('Y-m-d', strtotime($this->input->post('start_date')));
            $update_data['end_date'] = date('Y-m-d', strtotime($this->input->post('end_date')));
            $update_data['doctor'] = $this->input->post('doctor');
            $update_data['slot_interval'] = $this->input->post('slot_interval');

            $this->clinic->update($id, $type, $update_data);
            $this->clinic->update_clinic_doctor($id, $data['clinic']['0']['doctor_id'], $this->input->post('doctor'));
            redirect(SITE_URL . 'dashboard');
        }
    }

    public function get_states_by_country() {
        $this->load->model('admin/clinic');
        $country_id = $_POST['country_id'];
        $data['state'] = $this->clinic->get_states($country_id);
//        print_r($data);
        echo json_encode($data);
    }
    public function get_currency_by_country() {
        $this->load->model('admin/clinic');
        $country_id = $_POST['country_id'];
        $data['state'] = $this->clinic->get_currency($country_id);
//        print_r($data);
        echo json_encode($data);
    }

    public function delete_clinic($id) {
        $this->load->model('admin/clinic');
        $type = 'clinic';
        $this->clinic->delete($id, $type);
        redirect(SITE_URL . 'dashboard');
    }

    public function check_for_date($start_date) {
//        $this->load->model('admin/clinic');
//        if ($this->clinic->check_for_date($start_date)) {
////            $this->form_validation->set_message('check_for_date', 'clinic is already registered on this date');
//            return true;
//        } else {
//            return false;
//        }
    }

//    public function save_new_clinic() {
//        
//    }
}

?>
