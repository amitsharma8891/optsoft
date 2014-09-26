<?php

class Booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('admin/clinic');
        $this->load->model('client/appointment');
    }

    public function index() {
        $data = array();
        $this->load->model('admin/clinic');
        $data['clinic_details'] = $this->clinic->get_clinics();
        $this->load->view('client/appointment_dashboard', $data);
    }

    public function getdates() {
        $this->load->model('admin/clinic');
        $this->load->model('client/appointment');
        $clinic_id = $_POST['clinic_id'];
        $data['clinic'] = $this->clinic->get_single_clinic($clinic_id);
        $start_date = date('d-m-Y', strtotime($data['clinic'][0]['start_date']));
        $end_date = date('d-m-Y', strtotime($data['clinic'][0]['end_date']));
        $date = $this->appointment->get_all_dates_between_two($start_date, $end_date);
        echo json_encode($date);
    }

    public function get_clinic_details() {
    }

}

?>
