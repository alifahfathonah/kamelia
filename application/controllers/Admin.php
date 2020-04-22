<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        // load model
        $this->load->model("user_model");
        $this->load->model("kegiatan_model");
        $this->load->library('form_validation');
        // cek, udah login belum
        if ($this->user_model->isNotLogin()) {
            // kalo belum login, redirect ke /login
            redirect(site_url('login'));
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

    public function user(){
        echo 'hai user';
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

    public function kegiatan(){
        echo 'hai kegiatan';
    }

    public function addKegiatan(){
        // membuat objek dari kegiatan_model di $kegiatan
        $kegiatan = $this->kegiatan_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($kegiatan->rules());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run())
        {
            // save data menggunakan method atau fungsi dari model kegiatan
            $kegiatan->save();
            // tambahkan session kegiatan_added kalo sudah berhasil menambahkan kegiatan
            $this->session->set_flashdata('kegiatan_added', 'Berhasil ditambahkan');
            // di redirect ke halaman admin index
            redirect(site_url('admin'));
        }
        // load fungsi untuk pake 'date'
        $this->load->helper('date');
        // inisiasi data yang bakal dikirim ke view
        $data["date"] = mdate("%Y-%m-%d %h:%i %A");
        // jenis ini kan dari table yang lain, perlu diambil dulu datanya untuk ditampilkan jadi bentuk select option
        $data["jenis"] = $kegiatan->jenis();
        $data["role"] = $this->session->userdata('role');
        // jika pertama kali buka akan menampilkan halaman addkegiatan.php dan mengirim data yang akan digunakan di view
        $this->load->view("kegiatan/addkegiatan.php", $data);
    }

    public function addJenis(){
        // membuat objek dari kegiatan_model di $kegiatan
        $kegiatan = $this->kegiatan_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($kegiatan->rulesJenis());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run())
        {
            // save data menggunakan method atau fungsi dari model kegiatan
            $kegiatan->saveJenis();
            // tambahkan session kegiatan_added kalo sudah berhasil menambahkan kegiatan
            $this->session->set_flashdata('jenis_added', 'Berhasil ditambahkan');
            // di redirect ke halaman admin index
            redirect(site_url('admin'));
        }
        // jika pertama kali buka akan menampilkan halaman addkegiatan.php dan mengirim data yang akan digunakan di view
        $this->load->view("admin/addjenis.php");
    }
}