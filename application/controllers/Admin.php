<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        // load model
        $this->load->model("user_model");
        $this->load->library('form_validation');
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
        $this->load->view("admin/index.php");
    }

    public function logout(){
		// menghapus session
        $this->session->sess_destroy();
        redirect(site_url('/'));
    }

    public function addUser(){
        $user = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($this->form_validation->run())
        {
            $user->save();
            $this->session->set_flashdata('user_added', 'Berhasil ditambahkan');
            redirect(site_url('admin'));
        }
        $this->load->view("admin/adduser.php");
    }
}