<?php

class Doctors extends CI_Controller {

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
        $is_loggedin = $this->session->userdata('isLoggedIn');
        if ($is_loggedin == 1) {
            $this->load->view('admin/add_doctor');
        } else {
            redirect(SITE_URL . 'login');
        }
    }

    public function save_doctor() {
        $save_data = array();
        $data = array();
        $type = 'doctor';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('qualification', 'Qualification', 'required');
        $save_data['name'] = $this->input->post('name');
        $save_data['qualification'] = $this->input->post('qualification');
        $config['upload_path'] = "./uploads/doctor_images";
        $config['allowed_types'] = "*";
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (empty($_FILES['pic']['name'])) {

            $this->form_validation->set_rules('pic', 'pic', 'required');
        }
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $this->load->view('admin/add_doctor', $data);
//            redirect(SITE_URL.'admin/file/add/'.$company_id.'/'.$filetype_id);
        } else {
            if ($this->upload->do_upload('pic')) {
                $data = $this->upload->data();
            } else {
                $this->upload->display_errors();
            }
            if (isset($data))
                $save_data['image_name'] = $data['file_name'];

            $this->load->model('admin/clinic');
            $result = $this->clinic->save($type, $save_data);
            if ($result) {
                redirect(SITE_URL . 'dashboard');
            }
        }
    }

    public function edit_doctor($id) {
        $this->load->model('admin/clinic');
        $type = 'doctor';
        $data['doctor'] = $this->clinic->get_data($id, $type);
        $this->load->view('admin/edit_doctor', $data);
    }

    public function update_doctor($id) {
        $this->load->model('admin/clinic');
        $type = 'doctor';
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('qualification', 'Qualification', 'required');
        $update_data['name'] = $this->input->post('name');
        $update_data['qualification'] = $this->input->post('qualification');
        $update_data['pic'] = $this->input->post('old_pic');
        if (!empty($_FILES['pic']['name'])) {
            unlink(SITE_UPLOADS_URL . "uploads/doctor_images/" . $this->input->post('old_pic'));
            $config['upload_path'] = "./uploads/doctor_images/";
            $config['allowed_types'] = "*";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('pic')) {
                $data = $this->upload->data();
            } else {
                $this->upload->display_errors();
            }
            $update_data['pic'] = $data['file_name'];
        }
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            $this->edit_doctor($id);
        } else {
            $data['doctor'] = $this->clinic->update($id, $type, $update_data);
            redirect(SITE_URL . 'dashboard');
        }
    }

    public function delete_doctor($id) {
        $this->load->model('admin/clinic');
        $type = 'doctor';
        $file = $this->clinic->get_filename($id);
        $this->clinic->delete($id, $type);
        unlink(SITE_UPLOADS_URL . "uploads/doctor_images/" . $file[0]['image']);
        redirect(SITE_URL . 'dashboard');
    }

}

?>
