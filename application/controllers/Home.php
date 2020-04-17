<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // load model
        $this->load->model("user_model");
        // cek, udah login belum
        if ($this->user_model->isNotLogin()) {
            // kalo belum login, redirect ke /auth/login
            redirect(site_url('auth/login'));
        }
        // cek role
        if ($this->session->userdata('role') == '1'){
            // kalo role 1(admin) redirect ke /admin
            redirect(site_url('admin'));
        }
    }

    public function index(){
        echo "Welcome, ".$this->session->userdata('username');
    }

    public function logout(){
		// menghapus session
        $this->session->sess_destroy();
        redirect(site_url('/'));
    }
}
