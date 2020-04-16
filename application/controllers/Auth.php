<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{

	// konstruktor, method atau fungsi yang pertama kali dipanggil
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
	}
	
	public function index(){
		echo "Ha";
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
                    redirect(site_url('auth/login'));
                }
			} 
			// jika data ga ada, gagal login, balik ke login
			else {
                echo $this->session->set_flashdata('msg', 'Username or Password is Wrong');
                redirect('auth/login');
            }

        }
        // jika tidak ada yang disubmit, menampilkan:
        $this->load->view("auth/login.php");
    }

    public function logout(){
		// menghapus session
        $this->session->sess_destroy();
        redirect('/');
    }
}
