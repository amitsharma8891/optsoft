<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $is_loggedin = $this->session->userdata('isLoggedIn');
//        if (!$is_loggedin)
//            redirect(SITE_URL . 'login');
    }

    public function index() {
        $this->load->view('admin/login');
    }

    public function signup() {
        $this->load->view('admin/signup');
    }

    public function signup_user() {
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/signup');
        } else {
            $username = $this->input->post('username');
            $password1 = $this->input->post('password');
            $salt = $this->config->item('encryption_key');
            $start_hash = sha1($salt . $password1);
            $end_hash = sha1($password1 . $salt);
            $hashed = sha1($start_hash . $password1 . $end_hash);
            $password = sha1($hashed);
            $user_type = $this->input->post('type');
            $this->load->model('admin/users');
            $this->users->save_login_user($username, $password, $user_type);
            redirect(SITE_URL . 'admin/login/login');
//            }
        }
    }

    public function username_exists($username) {
        $this->load->model('admin/users');
        $this->load->library('form_validation');
        if ($this->users->username_exists($username)) {
            $this->form_validation->set_message('username_exists', 'User Name already Exists');
            return FALSE;
        }
    }

    public function authenticate() {
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->helper('security');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/login');
        } else {
            $username = $this->input->post('username');
            $password1 = $this->input->post('password');
            $password = do_hash($password1, 'md5'); // MD5 
            $user_type = 'admin';
            $this->load->model('admin/user');
            $data = $this->user->get_auth_users($username, $password, $user_type);

            if ($data == true) {
//                $this->load->view('admin/index');
                $this->session->set_userdata('isLoggedIn', 1);
                $this->session->set_userdata('loggedin_user', $data[0]['id']);
                if ($this->session->userdata('isLoggedIn') == 1) {
                    redirect(SITE_URL . 'dashboard');
//                    $this->view_dashboard();
                }
            } else {
                $view["message"] = 'Authentication failed. Please login ';
                $this->load->view("admin/login", $view);
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('isLoggedIn');
        $this->session->unset_userdata('loggedin_user');
         redirect(SITE_URL . 'login');
    }

    public function view_dashboard() {
        $is_loggedin = $this->session->userdata('isLoggedIn');
        if ($is_loggedin == 1) {
            $data = array();
            $this->load->model('admin/clinic');
            $data['clinic'] = $this->clinic->get_clinics();
            $data['doctor'] = $this->clinic->get_doctors();
            $this->load->view('admin/dashboard', $data);
        } else {
//            $this->index();
             redirect(SITE_URL . 'login');
        }
    }

}

?>
