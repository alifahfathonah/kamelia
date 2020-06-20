<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller {
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
        if ($this->session->userdata('role') == '1'){
            // kalo role 1(admin) redirect ke /admin
            redirect(site_url('admin'));
        }
    }

    public function index(){
        // menampilkan halaman index subadmin
        $data['kegiatan'] = $this->kegiatan_model->kegiatanAll();
        $this->load->view("home/index.php", $data);
    }

    public function kegiatanList(){
        $kegiatan = $this->kegiatan_model;

        // ambil id user yang login
        $logged_in_user = $this->session->userdata('userid');
        $data["kegiatan"] = $kegiatan->kegiatanByOwner($logged_in_user);
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
            // di redirect ke halaman home kegiatan list
            redirect(site_url('home/kegiatan'));
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
        if (!isset($id)) redirect('home/kegiatan');

        // membuat objek dari kegiatan_model di $kegiatan
        $kegiatan = $this->kegiatan_model;
        // ambil id user yang login
        $logged_in_user = $this->session->userdata('userid');
        // ambil data kegiatan berdasarkan id dan yang dipunyai user || prevent IDOR attack
        $data["kegiatan"] = $kegiatan->getByIdOwner($id, $logged_in_user);
        // jika user akan edit kegiatan orang lain akan ditolak dan di redirect ke halaman kegiatan
        if ($data["kegiatan"] == null) redirect('home/kegiatan');

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
            redirect(site_url('home/kegiatan'));
        }

        // jenis ini kan dari table yang lain, perlu diambil dulu datanya untuk ditampilkan jadi bentuk select option
        $data["jenis"] = $kegiatan->jenis();
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"] = $this->session->userdata('role');

        if (!$data["kegiatan"]) show_404();
        
        $this->load->view("kegiatan/editkegiatan.php", $data);
    }

    public function updateProfile()
    {
        // ambil id user yang sedang login
        $id = $this->session->userdata('userid');
        // membuat objek dari user_model di $user
        $user = $this->user_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($user->rulesUpdate());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run()) {
            // update data menggunakan method atau fungsi dari model user
            $user->update($id);
            // tambahkan session user_updated kalo sudah berhasil menambahkan user
            $this->session->set_flashdata('user_updated', 'Berhasil disunting');
            // di redirect ke halaman admin user list
            redirect(site_url('home'));
        }

        // ambil data user berdasarkan id
        $data["user"] = $user->getById($id);
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"] = $this->session->userdata('role');

        if (!$data["user"]) {
            show_404();
        }

        $this->load->view("home/editprofile.php", $data);
    }

    public function logout(){
		// menghapus session
        $this->session->sess_destroy();
        redirect(site_url('/'));
    }
}
