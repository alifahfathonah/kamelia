<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model("user_model");
        $this->load->model("kegiatan_model");
        $this->load->model("artikel_model");
        $this->load->library('form_validation');
        // cek, udah login belum
        if ($this->user_model->isNotLogin()) {
            // kalo belum login, redirect ke /login
            redirect(site_url('login'));
        }
        // cek role
        if ($this->session->userdata('role') == '2') {
            // kalo role 2(home) redirect ke /home
            redirect(site_url('home'));
        }
    }

    public function index()
    {
        // menampilkan halaman index admin
        $this->load->view("admin/index.php");
    }

    public function logout()
    {
        // menghapus session
        $this->session->sess_destroy();
        redirect(site_url('/'));
    }

    public function user()
    {
        $data["role"] = $this->session->userdata('role');
        // membuat objek dari user_model di $user
        $users = $this->user_model;
        // ambil semua data user
        $data['users'] = $users->getAll();

        $this->load->view("admin/userlist.php", $data);
    }

    public function addUser()
    {
        // membuat objek dari user_model di $user
        $user = $this->user_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($user->rules());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run()) {
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

    public function updateUser($id)
    {
        // jika $id tidak diisi akan di redirect ke halaman daftar user
        if (!isset($id)) {
            redirect('admin/user');
        }

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
            redirect(site_url('admin/user'));
        }

        // ambil data user berdasarkan id
        $data["user"] = $user->getById($id);
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"] = $this->session->userdata('role');

        if (!$data["user"]) {
            show_404();
        }

        $this->load->view("admin/edituser.php", $data);
    }

    public function kegiatanList()
    {
        $kegiatan         = $this->kegiatan_model;
        $data["kegiatan"] = $kegiatan->kegiatanAll();
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"]          = $this->session->userdata('role');
        $data["kegiatanModel"] = $kegiatan;
        $this->load->view("kegiatan/index.php", $data);
    }

    public function addKegiatan()
    {
        // membuat objek dari kegiatan_model di $kegiatan
        $kegiatan = $this->kegiatan_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($kegiatan->rules());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run()) {
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

    public function updateKegiatan($id)
    {
        // jika $id tidak diisi akan di redirect ke halaman daftar kegiatan
        if (!isset($id)) {
            redirect('admin/kegiatan');
        }

        // membuat objek dari kegiatan_model di $kegiatan
        $kegiatan = $this->kegiatan_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($kegiatan->rules());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run()) {
            // update data menggunakan method atau fungsi dari model kegiatan
            $kegiatan->update($id);
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

        if (!$data["kegiatan"]) {
            show_404();
        }

        $this->load->view("kegiatan/editkegiatan.php", $data);
    }

    public function addReview($id)
    {
        // membuat objek dari kegiatan_model di $kegiatan
        $kegiatan = $this->kegiatan_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($kegiatan->rulesReview());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run()) {
            // update data menggunakan method atau fungsi dari model kegiatan
            $kegiatan->review($id);
            // tambahkan session kegiatan_updated kalo sudah berhasil menambahkan kegiatan
            $this->session->set_flashdata('review_added', 'Review ditambahkan');
            // di redirect ke halaman admin kegiatan list
            redirect(site_url('admin/kegiatan'));
        }
        // ambil data kegiatan
        $data["review"] = $kegiatan->getById($id);
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"] = $this->session->userdata('role');

        $this->load->view("kegiatan/addreview.php", $data);
    }

    public function addJenis()
    {
        // membuat objek dari kegiatan_model di $kegiatan
        $kegiatan = $this->kegiatan_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($kegiatan->rulesJenis());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run()) {
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

    // Artikel thing
    public function artikelList()
    {
        // membuat objek dari artikel_model di $artikel
        $artikel = $this->artikel_model;
        // load view dan menampilkan data
        $data["artikel"] = $artikel->all();
        $data["role"]    = $this->session->userdata('role');
        $this->load->view("artikel/index.php", $data);

    }
    public function addArtikel()
    {
        // membuat objek dari artikel_model di $artikel
        $artikel = $this->artikel_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($artikel->rules());
        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run()) {
            // save data menggunakan method atau fungsi dari model artikel
            $artikel->save();
            // tambahkan session artikel_added kalo sudah berhasil menambahkan artikel
            $this->session->set_flashdata('artikel_added', 'Berhasil ditambahkan');
            // di redirect ke halaman list artikel admin
            redirect(site_url('admin/artikel'));
        }
        // jika pertama kali buka akan menampilkan halaman addkegiatan.php dan mengirim data yang akan digunakan di view
        $this->load->view("artikel/add.php");
    }

    public function updateArtikel($id)
    {
        // jika $id tidak diisi akan di redirect ke halaman daftar artikel
        if (!isset($id)) {
            redirect('admin/artikel');
        }

        // membuat objek dari artikel_model di $artikel
        $artikel = $this->artikel_model;
        // menginisiasi validation
        $validation = $this->form_validation;
        // validasi data
        $validation->set_rules($artikel->rules());

        // cek jika berhasil input atau sudah di post
        if ($this->form_validation->run()) {
            // update data menggunakan method atau fungsi dari model artikel
            $artikel->update($id);
            // tambahkan session artikel_updated kalo sudah berhasil menambahkan artikel
            $this->session->set_flashdata('artikel_updated', 'Berhasil disunting');
            // di redirect ke halaman admin artikel list
            redirect(site_url('admin/artikel'));
        }

        // ambil data artikel berdasarkan id
        $data["artikel"] = $artikel->getById($id);
        // inisiasi 'role' untuk tahu yang login role sebagai admin atau user biasa
        $data["role"] = $this->session->userdata('role');

        if (!$data["artikel"]) {
            show_404();
        }

        $this->load->view("artikel/edit.php", $data);
    }

    public function deleteArtikel($id)
    {
        // membuat objek dari artikel_model di $artikel
        $artikel = $this->artikel_model;
        // menghapus data
        $artikel->delete($id);

        // tambahkan session artikel_updated kalo sudah berhasil menambahkan artikel
        $this->session->set_flashdata('artikel_deleted', 'Berhasil dihapus');
        // di redirect ke halaman admin artikel list
        redirect(site_url('admin/artikel'));
    }
}
