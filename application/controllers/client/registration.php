<?php

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
//        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('client/registration');
    }

    public function user_test() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'Firstname', 'required');
        $this->form_validation->set_rules('last_name', 'Lastname', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('age', 'age', 'required');
        //$this->form_validation->set_rules('profile_pic', 'Profile pic', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('client/registration');
        } else {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $address = $this->input->post('address');
            $email = $this->input->post('email');
//        $this->load->library('form_validation');

            $profile_pic = $this->input->post('profile_pic');
            $config['upload_path'] = "./uploads/";
//        $config['allowed_types'] = "";
            //$config['max_size'] = "0";
            //$config['max_width'] = "0";
            //$config['max_height'] = "0";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
//        $this->upload->do_upload('profile_pic');        
            if ($this->upload->do_upload('profile_pic')) {
                //echo 'success';
                $data = $this->upload->data();
//            print_r($data);
            } else {
                //echo 'failed';
//            echo $this->upload->display_errors();
            }
//        $error_msg['error_msg']='hi';
//        die;
            if (isset($data))
                $file_name = $data['file_name'];
            $age = $this->input->post('age');
//         if(is_numeric($age)){
//         }else{
//             $error_msg='Age should be numeric';
//         }
//         $this->load->view('welcome_messages', $error_msg);
            $this->load->model('client/user');
            $this->user->save_user($first_name, $last_name, $email, $profile_pic, $address, $age);
//        $this->load->view('registered_user');
            $this->load->model('admin/user');
            $data['result'] = $this->user->get_registered_user();
            $this->load->view('admin/registered_user', $data);
//        redirect(SITE_URL . 'welcome/registered_user');
        }
    }

    public function save_user_ajax() {
        //$data=$_POST['data'];
    }

}

?>