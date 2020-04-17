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
        // menampilkan halaman index admin
        $this->load->view("admin/index.php");
    }

    public function logout(){
		// menghapus session
        $this->session->sess_destroy();
        redirect(site_url('/'));
    }

    public function addUser(){
        // membuat objek dari user_model di $user 
        $user = $this->user_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($user->rules());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run())
        {
            // save data menggunakan method atau fungsi dari model user
            $user->save();
            // tambahkan session user_added kalo sudah berhasil menambahkan user
            $this->session->set_flashdata('user_added', 'Berhasil ditambahkan');
            // di redirect ke halaman admin index
            redirect(site_url('admin'));
        }
        // jika pertama kali buka akan menampilkan halaman adduser.php
        $this->load->view("admin/adduser.php");
    }
}