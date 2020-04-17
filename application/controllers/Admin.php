<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
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
        if ($this->session->userdata('role') == '2'){
            // kalo role 2(home) redirect ke /home
            redirect(site_url('home'));
        }
    }

    public function index(){
        echo "Welcome, Admin ".$this->session->userdata('username');
    }

    public function logout(){
		// menghapus session
        $this->session->sess_destroy();
        redirect(site_url('/'));
    }

    public function
}