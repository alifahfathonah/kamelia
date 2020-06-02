<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{

	// konstruktor, method atau fungsi yang pertama kali dipanggil
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
        // cek, udah login belum
        if (!$this->user_model->isNotLogin()) {
            // kalo udah, cek role nya. kalo 1(admin) redirect ke /admin
            if ($this->session->userdata('role') == '1'){
                redirect(site_url('admin'));
            }
            // kalo role 2(kom) redirect ke /home
            else {
                redirect(site_url('home'));
            }
        }
    }
	
	public function index(){
        return show_404();
    }
    
    public function gen(){
        $this->user_model->generateAdmin();
        // echo "Admin created! <br> <a href='"+site_url('/')+"'>Click here</a>";
        echo "Hah";
    }

    public function login(){
        // jika form login disubmit
        if ($this->input->post()) {
			// validasi input lewat doLogin di models/user_model.php
            if ($this->user_model->doLogin()) {
				// ambil role
                $role = $this->session->userdata('role');
				// jika role = 1 ke halaman admin
                if ($role === '1') {
                    redirect(site_url('/admin'));
				} 
				// jika role = 2 ke halaman subadmin
				elseif ($role === '2') {
					redirect(site_url('/home'));
				} 
				// jika ga ada gagal, balik ke login
				else {
                    redirect(site_url('login'));
                }
			} 
			// jika data ga ada, gagal login, balik ke login
			else {
                $this->session->set_flashdata('msg', 'Username or Password is Wrong');
				redirect(site_url('login'));
            }

        }
        // jika tidak ada yang disubmit, menampilkan:
        $this->load->view("auth/login.php");
    }
}
