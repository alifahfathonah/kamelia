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
        $data["role"] = $this->session->userdata('role');
        // membuat objek dari user_model di $user 
        $users = $this->user_model;
        // ambil semua data user
        $data['users'] = $users->getAll();

        $this->load->view("admin/userlist.php", $data);
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

    public function kegiatanList(){
        $kegiatan = $this->kegiatan_model;
        $data["kegiatan"] = $kegiatan->kegiatanAll();
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"] = $this->session->userdata('role');
        $this->load->view("kegiatan/index.php", $data);
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
            // di redirect ke halaman admin kegiatan list
            redirect(site_url('admin/kegiatan'));
        }
        // load fungsi untuk pake 'date'
        $this->load->helper('date');
        // inisiasi data yang bakal dikirim ke view
        $data["date"] = mdate("%Y-%m-%d %h:%i %A");
        // jenis ini kan dari table yang lain, perlu diambil dulu datanya untuk ditampilkan jadi bentuk select option
        $data["jenis"] = $kegiatan->jenis();
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"] = $this->session->userdata('role');
        // jika pertama kali buka akan menampilkan halaman addkegiatan.php dan mengirim data yang akan digunakan di view
        $this->load->view("kegiatan/addkegiatan.php", $data);
    }

    public function updateKegiatan($id){
        // jika $id tidak diisi akan di redirect ke halaman daftar kegiatan
        if (!isset($id)) redirect('admin/kegiatan');
        
        // membuat objek dari kegiatan_model di $kegiatan
        $kegiatan = $this->kegiatan_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($kegiatan->rules());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run())
        {
            // update data menggunakan method atau fungsi dari model kegiatan
            $kegiatan->update();
            // tambahkan session kegiatan_updated kalo sudah berhasil menambahkan kegiatan
            $this->session->set_flashdata('kegiatan_updated', 'Berhasil disunting');
            // di redirect ke halaman admin kegiatan list
            redirect(site_url('admin/kegiatan'));
        }

        // ambil data kegiatan berdasarkan id
        $data["kegiatan"] = $kegiatan->getById($id);
        // jenis ini kan dari table yang lain, perlu diambil dulu datanya untuk ditampilkan jadi bentuk select option
        $data["jenis"] = $kegiatan->jenis();
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"] = $this->session->userdata('role');

        if (!$data["kegiatan"]) show_404();
        
        $this->load->view("kegiatan/editkegiatan.php", $data);
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