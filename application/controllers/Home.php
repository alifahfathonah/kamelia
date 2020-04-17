<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // load model
        $this->load->model("user_model");
        // kalo ga login, langsung di redirect ke halaman login
        if ($this->user_model->isNotLogin()) redirect(site_url('auth/login'));
        // kalo login tapi role nya ga 2(kom), langsung di redirect ke halaman login
        if ($this->session->userdata('role') != '2') redirect(site_url('auth/login'));
    }

    public function index(){
        echo "Welcome, ".$this->session->userdata('username');
    }

    public function logout(){
		// menghapus session
        $this->session->sess_destroy();
        redirect('/');
    }
}
